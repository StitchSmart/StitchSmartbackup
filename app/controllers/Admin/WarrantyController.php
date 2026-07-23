<?php
require_once __DIR__ . '/../../models/Warranty.php';

class WarrantyController
{
    private Warranty $warrantyModel;

    public function __construct()
    {
        global $conn;
        $this->warrantyModel = new Warranty($conn);
    }

    public function index()
    {
        $warranties = $this->warrantyModel->getAllWarranties();
        
        $data['title'] = 'Warranties';
        $data['theme'] = $_SESSION['theme'] ?? 'theme-default';
        $data['view'] = 'admin/warranties.php';
        $data['warranties'] = $warranties;

        extract($data);
        require BASE_PATH . '/app/views/admin/layout.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = (int)$_POST['order_id'];
            $userId = !empty($_POST['user_id']) ? (int)$_POST['user_id'] : null;
            $durationDays = (int)$_POST['duration_days'];
            $terms = htmlspecialchars($_POST['terms'] ?? '');

            $code = $this->warrantyModel->createWarranty($orderId, $userId, $durationDays, $terms);
            if ($code) {
                $_SESSION['success_message'] = "Warranty card created successfully. Code: " . $code;
            } else {
                $_SESSION['error_message'] = "Failed to create warranty card.";
            }
            header('Location: ' . url('admin_warranties'));
            exit;
        }
    }

    public function claims()
    {
        $claims = $this->warrantyModel->getAllClaims();
        
        $data['title'] = 'Warranty Claims';
        $data['theme'] = $_SESSION['theme'] ?? 'theme-default';
        $data['view'] = 'admin/warranty_claims.php';
        $data['claims'] = $claims;

        extract($data);
        require BASE_PATH . '/app/views/admin/layout.php';
    }

    public function updateClaim()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $claimId = (int)$_POST['claim_id'];
            $status = $_POST['status'];
            $adminNotes = htmlspecialchars($_POST['admin_notes'] ?? '');

            if ($this->warrantyModel->updateClaimStatus($claimId, $status, $adminNotes)) {
                $_SESSION['success_message'] = "Claim status updated.";
            } else {
                $_SESSION['error_message'] = "Failed to update claim status.";
            }
            header('Location: ' . url('admin_warranty_claims'));
            exit;
        }
    }
}
