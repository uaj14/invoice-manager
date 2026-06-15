<?php

function getDb(): PDO {
    static $db = null;
    if ($db === null) {
        $db = new PDO('sqlite:' . __DIR__ . '/invoice_manager.sqlite');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }
    return $db;
}

function getStatuses(): array {
    $stmt = getDb()->query('SELECT status FROM statuses ORDER BY id');
    return array_column($stmt->fetchAll(), 'status');
}

function getStatusId(string $status): ?int {
    $stmt = getDb()->prepare('SELECT id FROM statuses WHERE status = ?');
    $stmt->execute([$status]);
    $id = $stmt->fetchColumn();
    return $id === false ? null : (int) $id;
}

function getInvoices(string $status = 'all'): array {
    if ($status === 'all') {
        $stmt = getDb()->query('SELECT invoices.number, client, email, amount, statuses.status FROM invoices JOIN statuses ON invoices.status_id = statuses.id ORDER BY invoices.id');
        return $stmt->fetchAll();
    }

    $stmt = getDb()->prepare('SELECT invoices.number, client, email, amount, statuses.status FROM invoices JOIN statuses ON invoices.status_id = statuses.id WHERE statuses.status = ? ORDER BY invoices.id');
    $stmt->execute([$status]);
    return $stmt->fetchAll();
}

function getInvoiceByNumber(string $number): ?array {
    $stmt = getDb()->prepare('SELECT invoices.number, client, email, amount, statuses.status FROM invoices JOIN statuses ON invoices.status_id = statuses.id WHERE invoices.number = ? LIMIT 1');
    $stmt->execute([$number]);
    $row = $stmt->fetch();
    return $row === false ? null : $row;
}

function addInvoice(array $invoice): bool {
    $statusId = getStatusId($invoice['status']);
    if ($statusId === null) {
        return false;
    }
    $stmt = getDb()->prepare('INSERT INTO invoices (number, client, email, amount, status_id) VALUES (?, ?, ?, ?, ?)');
    return $stmt->execute([
        $invoice['number'],
        $invoice['client'],
        $invoice['email'],
        $invoice['amount'],
        $statusId,
    ]);
}

function updateInvoice(string $number, array $invoice): bool {
    $statusId = getStatusId($invoice['status']);
    if ($statusId === null) {
        return false;
    }
    $stmt = getDb()->prepare('UPDATE invoices SET client = ?, email = ?, amount = ?, status_id = ? WHERE number = ?');
    return $stmt->execute([
        $invoice['client'],
        $invoice['email'],
        $invoice['amount'],
        $statusId,
        $number,
    ]);
}

function deleteInvoice(string $number): bool {
    $stmt = getDb()->prepare('DELETE FROM invoices WHERE number = ?');
    return $stmt->execute([$number]);
}

function getInvoiceCount(string $status = 'all'): int {
    if ($status === 'all') {
        $stmt = getDb()->query('SELECT COUNT(*) FROM invoices');
        return (int) $stmt->fetchColumn();
    }

    $stmt = getDb()->prepare('SELECT COUNT(*) FROM invoices JOIN statuses ON invoices.status_id = statuses.id WHERE statuses.status = ?');
    $stmt->execute([$status]);
    return (int) $stmt->fetchColumn();
}

function getAllStatusesWithAll(): array {
    $statuses = getStatuses();
    array_unshift($statuses, 'all');
    return $statuses;
}
