<?php
include 'db/koneksi.php';

$midtransServerKey = 'SB-Mid-server-BDbJ5IBhtbhqR3eirbNUxlJy'; 
$apiUrl = 'https://api.sandbox.midtrans.com/v2/';


$sql = "SELECT * FROM penjualan ORDER BY tanggal DESC LIMIT 10";
$result = $conn->query($sql);

function censorOrderId($order_id) {
    return substr($order_id, 0, 2) . '*******' . substr($order_id, -2);
}

function censorPhone($phone) {
    return substr($phone, 0, 3) . '*******' . substr($phone, -3);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Cek Transaksi - GacorTopUp</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <!-- Main CSS File -->
    <link href="assets/css/main.css" rel="stylesheet" />
</head>

<body class="service-details-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
            <a href="index.php" class="logo d-flex align-items-center">
                <img src="assets/img/logo.png" alt="" class="img-fluid" width="40" height="50" />
                <h1 class="sitename">GacorTopup</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php#hero"><i class="fa-solid fa-store p-1"></i>Topup</a></li>
                    <li><a href="index.php#faq"><i class="fa-solid fa-question p-1"></i>FAQ</a></li>
                    <li><a href="cek_transaksi.php" class="active"><i class="fa-solid fa-clock-rotate-left p-1"></i>Cek
                            Transaksi</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
        </div>
    </header>
    <main class="main">
        <!-- Page Title -->
        <div class="page-title dark-background" data-aos="fade-in" data-aos-delay="100">
            <div class="container position-relative">
                <h1>Cek Transaksi</h1>
                <p>Kalian bisa mencari data transaksi disini!</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="index.html">Home</a></li>
                        <li class="current">Cek Transaksi</li>
                    </ol>
                </nav>
            </div>
        </div><!-- End Page Title -->
        <section id="service-details" class="service-details section"
            style="background-image: url('assets/img/bg.png'); background-attachment: contain; background-size: cover; background-position: center;">
            <div class="container mt-5" data-aos="fade-in" data-aos-delay="100">
                <div class="card shadow mb-4">
                    <div class="card-header py-2">
                        <h2 class="m-0 font-weight-bold">Cek Transaksi</h2>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered" width="100%">
                                <thead class="table-warning">
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Order ID</th>
                                        <th>No HP</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $cacheFile = 'storage/cache_status.json'; 
                                    $cachedStatus = [];
                                        
                                    if (file_exists($cacheFile)) {
                                        $cachedStatus = json_decode(file_get_contents($cacheFile), true);
                                    } else {
                                        echo "Cache not found.";
                                    }
                                
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $censoredOrderId = censorOrderId($row['order_id']);
                                            $censoredPhone = censorPhone($row['no_hp']);
                                
                                            $orderId = $row['order_id'];
                                    ?>
                                    <tr>
                                        <td><?php echo date('d M Y H:i:s', strtotime($row['tanggal'])); ?></td>
                                        <td><?php echo $censoredOrderId; ?></td>
                                        <td><?php echo $censoredPhone; ?></td>
                                        <td>Rp. <?php echo number_format($row['harga'], 0, ',', '.'); ?></td>
                                        <td><?php echo "<span class='status-label' data-order-id='" . $orderId . "'>Loading...</span>"; ?></td>
                                        <td class="d-none"><?php echo $row['order_id']; ?></td>
                                        <td class="d-none"><?php echo $row['no_hp']; ?></td>
                                    </tr>
                                    <?php
                            }
                        } else {
                            echo "<tr>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            <td class='text-center'>-</td>
                            </tr>";
                        }
                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="whatsapp-bubble" onclick="openWhatsApp()" style="font-size: 32px;">
            <i class="fa-brands fa-whatsapp"></i>
            <span
                class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle">
        </div>
    </main>
    <footer id="footer" class="footer dark-background">
        <div class="container">
            <h3 class="sitename">GacorTopup</h3>
            <p>Toko Topup game termurah dan terpercaya 24/7.</p>
            <h5 class="sitename">Our Team</h5>
            <div class="d-flex justify-content-center" style="margin: 0;">
                <a href="https://instagram.com/mrendimlna" target="_blank">
                    <p>Muhammad Rendi Maulana</p>
                </a>
                <span class="mx-1">&#9679;</span>
                <a href="https://instagram.com/robbyrmdh" target="_blank">
                    <p>Robbyanto Bagus Ramadhan</p>
                </a>
                <span class="mx-1">&#9679;</span>
                <a href="https://instagram.com/ryanagdi" target="_blank">
                    <p>Ryan Agdi Winata Yunastiar Isa</p>
                </a>
                <span class="mx-1">&#9679;</span>
                <a href="https://instagram.com/salmanhapit" target="_blank">
                    <p>Salman Hapitulung</p>
                </a>
            </div>
            <div class="container">
                <div class="copyright">
                    <span>&copy 2024</span>
                    <strong class="px-1 sitename">GacorTopup</strong>
                    <span>All Rights Reserved</span>
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you've purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
                    Template by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>

    <script src="assets/vendor/aos/aos.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="https://kit.fontawesome.com/095df3b031.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
    const statusElements = document.querySelectorAll(".status-label");

    statusElements.forEach((element) => {
        const orderId = element.getAttribute("data-order-id");

        if (orderId) {
            fetch(`func/fetch_status.php?order_id=${orderId}`)
                .then((response) => response.json())
                .then((data) => {
                    let statusLabel;
                    switch (data.status) {
                        case "settlement":
                            statusLabel = '<span class="badge rounded-pill text-bg-success">Success</span>';
                            break;
                        case "pending":
                            statusLabel = '<span class="badge rounded-pill text-bg-warning">Pending</span>';
                            break;
                        case "expire":
                            statusLabel = '<span class="badge rounded-pill text-bg-secondary">Expired</span>';
                            break;
                        case "cancel":
                            statusLabel = '<span class="badge rounded-pill text-bg-danger">Canceled</span>';
                            break;
                        default:
                            statusLabel = '<span class="badge rounded-pill text-bg-secondary">Unknown</span>';
                            break;
                    }
                    element.innerHTML = statusLabel;
                })
                .catch((error) => {
                    element.innerHTML = '<span class="badge badge-pill badge-secondary">Error</span>';
                });
        }
    });
});

    </script>

    <script>
        function openWhatsApp() {
            const phoneNumber = "62895611471425";
            const message = encodeURIComponent("Halo min, saya ingin bertanya mengenai layanan topup.");
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
            window.open(whatsappUrl, "_blank");
        }
    </script>

    <!-- Initialize DataTables -->
        <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                "order": [
                    [0, "desc"]
                ],

                columnDefs: [{
                        targets: 5,
                        visible: false,
                        searchable: true
                    },
                    {
                        targets: 6,
                        visible: false,
                        searchable: true
                    },
                    {
                        className: 'dt-center',
                        targets: '_all'
                    },
                ]
            });
        });
    </script>

</body>

</html>

<?php
$conn->close();
?>