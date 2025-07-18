<?php
include "../db/koneksi.php";
require_once 'midtrans/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-BDbJ5IBhtbhqR3eirbNUxlJy';
\Midtrans\Config::$is3ds = true;
\Midtrans\Config::$isSanitized = true;

if (!isset($_GET['order_id'])) {
    echo json_encode(['error' => 'Order ID not provided']);
    exit();
}

$order_id = $_GET['order_id'];

try {
    $status = \Midtrans\Transaction::status($order_id);
    $response = [
        'order_id' => $order_id,
        'status' => strtolower($status->transaction_status),
    ];
    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
