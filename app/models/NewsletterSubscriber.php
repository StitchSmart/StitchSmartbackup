<?php

class NewsletterSubscriber {
    private $storagePath;

    public function __construct() {
        $this->storagePath = BASE_PATH . '/storage/newsletter_subscribers.json';
    }

    private function ensureStorage() {
        $directory = dirname($this->storagePath);
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        if (!file_exists($this->storagePath)) {
            file_put_contents($this->storagePath, json_encode([]));
        }
    }

    public function getAll() {
        $this->ensureStorage();

        $content = file_get_contents($this->storagePath);
        $data = json_decode($content, true);

        if (!is_array($data)) {
            return [];
        }

        $emails = array_filter(array_map('trim', $data));
        $emails = array_unique($emails);

        return array_values($emails);
    }

    public function exists($email) {
        $email = strtolower(trim($email));
        $subscribers = array_map('strtolower', $this->getAll());
        return in_array($email, $subscribers, true);
    }

    public function add($email) {
        $email = strtolower(trim($email));

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $subscribers = $this->getAll();
        $normalized = array_map('strtolower', $subscribers);

        if (in_array($email, $normalized, true)) {
            return false;
        }

        $subscribers[] = $email;
        return file_put_contents($this->storagePath, json_encode($subscribers, JSON_PRETTY_PRINT)) !== false;
    }
}
