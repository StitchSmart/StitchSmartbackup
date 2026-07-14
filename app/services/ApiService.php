<?php
class ApiService {

    private $chatbotUrl;
    private $similarProductsUrl;
    private $syncProductsUrl;
    private $apiToken;

    public function __construct() {
        $baseUrl = rtrim(CHATBOT_API_URL, '/');
        $this->chatbotUrl = $baseUrl . '/chat-simple';
        $this->similarProductsUrl = $baseUrl . '/similar-products';
        $this->syncProductsUrl = $baseUrl . '/sync-products';
        $this->apiToken = trim((defined('CHATBOT_API_TOKEN') ? CHATBOT_API_TOKEN : ''));
    }

    // POST to Chatbot endpoint
    public function sendMessageToChatbot($userMessage, $sessionId = 'default') {
        $sanitizedMessage = trim((string)$userMessage);
        if ($sanitizedMessage === '') {
            return ['error' => 'Message cannot be empty'];
        }
        if (strlen($sanitizedMessage) > 2000) {
            $sanitizedMessage = substr($sanitizedMessage, 0, 2000);
        }

        $sanitizedSessionId = preg_replace('/[^A-Za-z0-9_-]/', '_', (string)$sessionId);
        if ($sanitizedSessionId === '') {
            $sanitizedSessionId = 'default';
        }

        $data = [
            'query' => $sanitizedMessage,
            'session_id' => $sanitizedSessionId,
            'user_id' => 'web_user',
            'base_url' => BASE_URL
        ];
        return $this->postRequest($this->chatbotUrl, $data);
    }

    // POST to Similar Products endpoint
    public function getSimilarProducts($productId) {
        $numericProductId = (int)$productId;
        if ($numericProductId <= 0) {
            return ['error' => 'Invalid product id'];
        }

        $data = ['product_id' => (string)$numericProductId];
        return $this->postRequest($this->similarProductsUrl, $data);
    }

    // Sync all products to chatbot FAISS index automatically
    public static function syncProduct($unused = null) {
        // Load all products from DB
        require_once BASE_PATH . '/config/database.php';
        require_once BASE_PATH . '/app/models/Product.php';

        $database = new Database();
        $db = $database->connect();
        $productModel = new Product($db);
        $products = $productModel->getAllProductsForAI();

        if (empty($products)) {
            return;
        }

        $baseUrl = rtrim(CHATBOT_API_URL, '/');
        $syncUrl = $baseUrl . '/sync-products';
        $headers = ['Content-Type: application/json', 'Accept: application/json'];
        if (!empty(CHATBOT_API_TOKEN)) {
            $headers[] = 'Authorization: Bearer ' . CHATBOT_API_TOKEN;
        }

        $ch = curl_init($syncUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['products' => $products]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, CHATBOT_API_TIMEOUT);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);

        if ($error !== '') {
            error_log('Chatbot sync error: ' . $error);
            return;
        }

        if ($httpCode < 200 || $httpCode >= 300) {
            error_log('Chatbot sync failed with HTTP ' . $httpCode . ': ' . (string)$response);
        }
    }

    // Generic POST function
    private function postRequest($url, $data) {
        $parsedUrl = parse_url($url);
        if (empty($parsedUrl['scheme']) || empty($parsedUrl['host'])) {
            return ['error' => 'Invalid chatbot endpoint'];
        }
        if (!in_array($parsedUrl['scheme'], ['http', 'https'], true)) {
            return ['error' => 'Unsupported chatbot endpoint scheme'];
        }

        $headers = ['Content-Type: application/json', 'Accept: application/json'];
        if (!empty($this->apiToken)) {
            $headers[] = 'Authorization: Bearer ' . $this->apiToken;
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, CHATBOT_API_TIMEOUT);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if(curl_errno($ch)){
            $error = curl_error($ch);
            curl_close($ch);
            return ['error' => $error];
        }
        curl_close($ch);

        if ($httpCode < 200 || $httpCode >= 300) {
            return ['error' => 'Chatbot endpoint returned HTTP ' . $httpCode];
        }

        if ($response === false || $response === null) {
            return ['error' => 'Empty chatbot response'];
        }

        $decoded = json_decode($response, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return ['error' => 'Unable to parse chatbot response'];
        }
        if (!is_array($decoded)) {
            return ['error' => 'Unexpected chatbot response format'];
        }

        return $decoded;
    }
}
?>