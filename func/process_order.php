<?php
include "../db/koneksi.php";

$order_id = $_POST['order_id'];
$userId = $_POST['user_id'];
$zoneId = $_POST['zoneId'] ? $_POST['zoneId'] : '-';
$product = $_POST['product'];
$no_hp = $_POST['no_hp'];
$price = $_POST['price'];
$tanggal = date("Y-m-d H:i:s");

$sql = "INSERT INTO penjualan (order_id, user_id, zone_id, no_hp, produk, harga, tanggal)
        VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssss", $order_id, $userId, $zoneId, $no_hp, $product, $price, $tanggal);

if ($stmt->execute()) {
    echo json_encode(['success' => 'Data successfully inserted into the database.']);
} else {
    echo json_encode(['error' => 'Error inserting data into database.']);
}

$stmt->close();
$conn->close();
