<?php
require_once dirname(__FILE__) . '/midtrans/Midtrans.php';

\Midtrans\Config::$serverKey = ''; // MIDTRANS SERVER KEY
\Midtrans\Config::$clientKey = ''; // MIDTRANS CLIENT KEY
\Midtrans\Config::$isProduction = false;

include "../db/koneksi.php";

$userId = isset($_POST['userId']) ? $_POST['userId'] : '';
$zoneId = isset($_POST['zoneId']) ? $_POST['zoneId'] : '-';
$product = isset($_POST['product']) ? $_POST['product'] : '';
$no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : ''; 
$price = isset($_POST['price']) ? $_POST['price'] : '';
$tanggal = date("Y-m-d H:i:s");

$orderId = 'GT' . strtoupper(uniqid());

if (empty($userId) || empty($zoneId) || empty($product) || empty($price) || empty($no_hp)) {
    echo json_encode(['error' => 'Please fill all the required fields.']);
    exit;
}

$transactionDetails = [
    'order_id' => $orderId,
    'gross_amount' => (int) $price,
];

$customerDetails = [
    'phone' => $no_hp,
];

$transaction = [
    'transaction_details' => $transactionDetails,
    'customer_details' => $customerDetails,
];

try {
    $snapToken = \Midtrans\Snap::getSnapToken($transaction);
    echo json_encode(['snapToken' => $snapToken, 'orderId' => $orderId]);
} catch (Exception $e) {
    echo json_encode(['error' => 'Error generating Snap token: ' . $e->getMessage()]);
}
