<?php
include '../db/koneksi.php';
require_once '../func/midtrans/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-BDbJ5IBhtbhqR3eirbNUxlJy';
\Midtrans\Config::$isProduction = false;
\Midtrans\Config::$isSanitized = true;
\Midtrans\Config::$is3ds = true;

$sql = "SELECT order_id, tanggal FROM penjualan";
$result = $conn->query($sql);

$salesData = array_fill(0, 12, 0);

while ($row = $result->fetch_assoc()) {
    $order_id = $row['order_id'];
    
    try {
        $status = \Midtrans\Transaction::status($order_id);

        if (isset($status->transaction_status) && $status->transaction_status === 'settlement') {
            $transactionTime = $status->transaction_time;
            $month = date('n', strtotime($transactionTime));
            $amount = (float)$status->gross_amount;
            $salesData[$month - 1] += $amount;
        }
    } catch (Exception $e) {
        error_log("Error fetching status for order_id $order_id: " . $e->getMessage());
    }
}

header('Content-Type: application/json');
echo json_encode($salesData);

$conn->close();
?>
