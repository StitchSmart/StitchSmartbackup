<?php
// Sends transactional email via Brevo's HTTPS API instead of raw SMTP,
// because outbound SMTP ports are blocked on the production host.
class MailService {

    private const API_URL = 'https://api.brevo.com/v3/smtp/email';

    // $attachments: list of ['path' => absolute file path, 'name' => filename]
    public static function send(string $toEmail, string $toName, string $subject, string $htmlBody, string $altBody = '', string $replyToEmail = '', string $replyToName = '', array $attachments = []): void {
        if (empty(BREVO_API_KEY)) {
            throw new \RuntimeException('Mail not configured: BREVO_API_KEY is missing');
        }

        $payload = [
            'sender'      => ['name' => BREVO_SENDER_NAME, 'email' => BREVO_SENDER_EMAIL],
            'to'          => [['email' => $toEmail, 'name' => $toName !== '' ? $toName : $toEmail]],
            'subject'     => $subject,
            'htmlContent' => $htmlBody,
        ];
        if ($altBody !== '') {
            $payload['textContent'] = $altBody;
        }
        if ($replyToEmail !== '') {
            $payload['replyTo'] = ['email' => $replyToEmail, 'name' => $replyToName !== '' ? $replyToName : $replyToEmail];
        }
        if (!empty($attachments)) {
            $payload['attachment'] = [];
            foreach ($attachments as $attachment) {
                if (!is_readable($attachment['path'])) {
                    continue;
                }
                $payload['attachment'][] = [
                    'content' => base64_encode(file_get_contents($attachment['path'])),
                    'name'    => $attachment['name'],
                ];
            }
        }

        $ch = curl_init(self::API_URL);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'api-key: ' . BREVO_API_KEY,
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException('Mail request failed: ' . $error);
        }
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode < 200 || $httpCode >= 300) {
            $decoded = json_decode((string) $response, true);
            $msg = is_array($decoded) && isset($decoded['message']) ? $decoded['message'] : ('HTTP ' . $httpCode);
            throw new \RuntimeException('Mail send failed: ' . $msg);
        }
    }
}
