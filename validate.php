<?php

/**
 * Sanitizes and validates invoice data
 * Returns an array with keys: 'valid' (bool), 'data' (array), 'errors' (array)
 */
function validateInvoiceData($postData, $type = 'add') {
    $errors = [];
    $data = [];

    // Validate and sanitize number
    $number = trim($postData['number'] ?? '');
    if (empty($number)) {
        $errors[] = "Invoice number is required.";
    } else {
        $data['number'] = htmlspecialchars($number, ENT_QUOTES, 'UTF-8');
    }

    // Validate and sanitize client
    $client = trim($postData['client'] ?? '');
    if (empty($client)) {
        $errors[] = "Client name is required.";
    } elseif (strlen($client) > 255) {
        $errors[] = "Client name must not exceed 255 characters.";
    } elseif (!preg_match('/^[A-Za-z ]+$/', $client)) {
        $errors[] = "Client name may only contain letters and spaces.";
    } else {
        $data['client'] = htmlspecialchars($client, ENT_QUOTES, 'UTF-8');
    }

    // Validate and sanitize email
    $email = trim($postData['email'] ?? '');
    if (empty($email)) {
        $errors[] = "Client email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Client email is not valid.";
    } else {
        $data['email'] = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    }

    // Validate amount
    if (!isset($postData['amount']) || $postData['amount'] === '') {
        $errors[] = "Amount is required.";
    } else {
        $amount = filter_var($postData['amount'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($amount === false) {
            $errors[] = "Amount must be an integer greater than 0.";
        } else {
            $data['amount'] = $amount;
        }
    }

    // Validate status
    $status = $postData['status'] ?? 'draft';
    $validStatuses = ['draft', 'pending', 'paid'];
    if (!in_array($status, $validStatuses, true)) {
        $errors[] = "Invalid status.";
    } else {
        $data['status'] = htmlspecialchars($status, ENT_QUOTES, 'UTF-8');
    }

    return [
        'valid' => count($errors) === 0,
        'data' => $data,
        'errors' => $errors
    ];
}

?>
