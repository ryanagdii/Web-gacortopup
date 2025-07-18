<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Order Form - GacorTopup</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="../assets/img/favicon.png" rel="icon">
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="../assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="../assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="../assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="../assets/css/main.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Selecao
  * Template URL: https://bootstrapmade.com/selecao-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="service-details-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="../index.php" class="logo d-flex align-items-center">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="../assets/img/logo.png" alt="" class="img-fluid" width="40" height="50" />
                <h1 class="sitename">GacorTopup</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li>
                        <a href="../index.php#hero" class="active"><i class="fa-solid fa-store p-1"></i>Topup</a>
                    </li>
                    <li>
                        <a href="../index.php#faq"><i class="fa-solid fa-question p-1"></i>FAQ</a>
                    </li>
                    <li>
                        <a href="../cek_transaksi.php"><i class="fa-solid fa-clock-rotate-left p-1"></i>Cek
                            Transaksi</a>
                    </li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

        </div>
    </header>

    <main class="main">

        <!-- Page Title -->
        <div class="page-title dark-background" >
            <div class="container position-relative">
                <h1>GacorTopup</h1>
                <p>Silahkan isi data - data yang sesuai untuk melakukan topup</p>
                <nav class="breadcrumbs">
                    <ol>
                        <li><a href="../index.php">Home</a></li>
                        <li class="current">Order Form</li>
                    </ol>
                </nav>
            </div>

        </div><!-- End Page Title -->

        <!-- Service Details Section -->
        <section id="service-details" class="service-details section" style="background-image: url('../assets/img/bg3.png'); background-attachment: contain; background-size: cover; background-position: center;">

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

                        <div class="service-box">
                            <img src="../assets/img/freefire.webp" class="card-img-top" alt="Free Fire"
                                style="border-radius: 30px 30px 30px 30px;" />
                            <h4 class="mt-3 text-center">Free Fire</h4>
                            <h4>Cara Top Up</h4>
                            <div class="services-list">
                                <ul>
                                    <li><i class="bi bi-1-circle"></i><span>Masukkan User ID anda</span></li>
                                    <li><i class="bi bi-2-circle"></i></i><span>Pilih produk yang anda inginkan.</span>
                                    </li>
                                    <li><i class="bi bi-3-circle"></i></i><span>Selesaikan pembayaran</span></li>
                                    <li><i class="bi bi-4-circle"></i></i><span>Produk akan ditambahkan pada akun
                                            anda.</span></li>
                                </ul>
                            </div>
                        </div><!-- End Services List -->

                    </div>

                    <div class="col-lg-8 ps-lg-5" data-aos="fade-up" data-aos-delay="200">
                        <form method="POST">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Masukan data akun</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control" id="userId" name="userId"
                                                    placeholder="Masukan User ID">
                                                <div class="invalid-feedback">
                                                    Silakan masukkan User ID.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="mb-0">Pilih produk</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group mt-3">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 10 Diamonds', '1600')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 10 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 1.600</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 55 Diamonds', '7100')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 55 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 7.100</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 70 Diamonds', '8700')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 70 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 8.700</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 80 Diamonds', '10300')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 80 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 10.300</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 100 Diamonds', '12700')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 100 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 12.700</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 635 Diamonds', '78400')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 635 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 78.400</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 1000 Diamonds', '121900')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 1000 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 121.900</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-3">
                                                <div class="card product-card"
                                                    onclick="selectProduct(this, '(FF) 2200 Diamonds', '267500')">
                                                    <div class="card-body">
                                                        <h6 class="card-text">💎 2200 Diamonds</h6>
                                                    </div>
                                                    <div class="card-footer text-end">
                                                        <p class="card-text">Rp. 267.500</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Repeat for other options -->
                                        </div>
                                        <input type="hidden" id="selectedProduct" name="product" value="">
                                        <input type="hidden" id="selectedPrice" name="price" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h4 class="mb-0">Nomor Whatsapp</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <input type="number" class="form-control" id="no_hp" name="no_hp"
                                            placeholder="Nomor Whatsapp">
                                        <label class="mt-3" style="color: red">* Nomor whatsapp ini akan dihubungi
                                            apabila
                                            terjadi kendala.<br>contoh : 081234567890</label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-primary mt-3 w-100">Order</button>

                        </form>
                    </div>
                </div>
            </div>


            </div>

            </div>

        </section><!-- /Service Details Section -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/php-email-form/validate.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="../assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="../assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="../assets/vendor/swiper/swiper-bundle.min.js"></script>

    <!-- Main JS File -->
    <script src="https://kit.fontawesome.com/095df3b031.js" crossorigin="anonymous"></script>
    <script src="../assets/js/main.js"></script>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key=""></script> <!-- MIDTRANS CLIENT KEY -->
    <script>
        function openWhatsApp() {
            const phoneNumber = "123123123";
            const message = encodeURIComponent("Halo min, saya ingin bertanya mengenai layanan topup.");
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${message}`;
            window.open(whatsappUrl, "_blank");
        }
    </script>
    <script>
        function selectProduct(card, name, price) {
            var allCards = document.querySelectorAll('.product-card');
            allCards.forEach(function (card) {
                card.classList.remove('selected-card');
            });

            card.classList.add('selected-card');
            document.getElementById('selectedProduct').value = name;
            document.getElementById('selectedPrice').value = price;
        }
    </script>
    <?php
    $userId = isset($_POST['userId']) ? $_POST['userId'] : '';
    $product = isset($_POST['product']) ? $_POST['product'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';;
    ?>

    <script>
        document.getElementById('submitBtn').addEventListener('click', async function (event) {
            event.preventDefault();

            var userId = document.getElementById('userId').value;
            var product = document.getElementById('selectedProduct').value;
            var price = document.getElementById('selectedPrice').value;
            var nohp = document.getElementById('no_hp').value;

            if (!userId || !product || !price || !nohp) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'All fields must be filled. Please check!',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e74c3c'
                });
                return;
            }

            var data = new FormData();
            data.append('userId', userId);
            data.append('product', product);
            data.append('price', price);
            data.append('no_hp', nohp);

            try {
                const response = await fetch('../func/token.php', {
                    method: 'POST',
                    body: data
                });

                const result = await response
                    .json();
                const snapToken = result.snapToken;
                const orderId = result.orderId;

                if (snapToken) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Pemberitahuan',
                        html: `<p><strong>Jangan lupa untuk screenshot atau simpan nomor Virtual Account setelah memilih metode pembayaran!</strong></p>`,
                        confirmButtonText: 'Lanjutkan',
                        confirmButtonColor: '#3085d6'
                    }).then(function () {
                        window.snap.pay(snapToken, {
                            onSuccess: function () {
                                $.ajax({
                                    url: '../func/process_order.php',
                                    type: 'POST',
                                    data: {
                                        order_id: orderId,
                                        user_id: userId,
                                        product: product,
                                        price: price,
                                        no_hp: nohp,
                                    },
                                    success: function (response) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Pembayaran Berhasil',
                                            html: `Terima kasih, pembayaran telah berhasil!<p>Order ID: <strong>${orderId}</strong></p>`,
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#3085d6'
                                        });
                                    },
                                    error: function (xhr, status, error) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Gagal menyimpan data pembayaran. Silakan coba lagi!',
                                            confirmButtonText: 'OK',
                                            confirmButtonColor: '#e74c3c'
                                        });
                                        console.error(
                                            'Failed to update payment status:',
                                            error);
                                    }
                                });
                            },
                            onPending: function () {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Pembayaran Ditunda',
                                    html: `<p>Pembayaran anda masih pending, silahkan selesaikan pembayaran sesuai dengan waktu yang sudah ditentukan!</p>
                                    <p>Order ID: <strong>${orderId}</strong></p>
                                    <p style="color: red;">* Screenshot atau simpan Order ID ini agar dapat mengecek status pembayaran!</p>`,
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#f39c12'
                                }).then(function () {
                                    $.ajax({
                                        url: '../func/process_order.php',
                                        type: 'POST',
                                        data: {
                                            order_id: orderId,
                                            user_id: userId,
                                            product: product,
                                            price: price,
                                            no_hp: nohp,
                                        }
                                    });
                                });
                            },
                            onError: function () {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Pembayaran Gagal',
                                    text: 'Terdapat sebuah error dalam proses pembayaran. Silahkan coba lagi nanti!',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#e74c3c'
                                });
                            },
                            onClose: function () {
                                Swal.fire({
                                    icon: 'warning',
                                    title: 'Pembayaran Dibatalkan',
                                    text: 'Anda telah menutup jendela pembayaran tanpa memilih metode pembayaran!',
                                    confirmButtonText: 'OK',
                                    confirmButtonColor: '#e74c3c'
                                });
                            }
                        });
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Mendapatkan Token Pembayaran',
                        text: 'Terjadi kesalahan ketika proses pembayaran!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#e74c3c'
                    });
                }
            } catch (err) {
                console.error(err.message);
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi Kesalahan',
                    html: `Terdapat error: ${err.message}`,
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#e74c3c'
                });
            }
        });
    </script>
</body>

</html>
