<?php
include '../db/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = $_POST['order_id'];

    $sql = "DELETE from penjualan WHERE order_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $order_id);

    if ($stmt->execute()) {
        echo "Berhasil menghapus data";
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
