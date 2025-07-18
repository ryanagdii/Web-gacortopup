<?php
include "../db/koneksi.php";

$sqlOrderIds = "SELECT order_id, harga FROM penjualan";
$result = $conn->query($sqlOrderIds);

$orderIds = [];
while ($row = $result->fetch_assoc()) {
    $orderIds[] = ['order_id' => $row['order_id'], 'harga' => $row['harga']];
}

echo json_encode($orderIds);
?>
