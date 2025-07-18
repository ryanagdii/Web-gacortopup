<?php
include "../db/koneksi.php";
session_start();
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];

if(!isset($admin_name)){
   header('location:../login.php');
}

require_once '../func/midtrans/Midtrans.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-BDbJ5IBhtbhqR3eirbNUxlJy';
\Midtrans\Config::$is3ds = true;
\Midtrans\Config::$isSanitized = true;

$cache_file = '../storage/cache_status.json';

$cache_expiry_time = 30;
$cached_status = [];

if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_expiry_time) {
    $cached_status = json_decode(file_get_contents($cache_file), true);
}

$sqlOrderIds = "SELECT * FROM penjualan";
$resultOrderIds = $conn->query($sqlOrderIds);

while ($row = $resultOrderIds->fetch_assoc()) {
    $orderId = $row['order_id'];

    if (!isset($cached_status[$orderId])) {
        try {
            $status = \Midtrans\Transaction::status($orderId);
            $status_code = strtolower($status->transaction_status);

            $cached_status[$orderId] = $status_code;

        } catch (Exception $e) {
            error_log("Error fetching status for Order ID: $orderId - " . $e->getMessage());
            continue;
        }
    }
}

file_put_contents($cache_file, json_encode($cached_status));

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Data Penjualan - GacorTopUp</title>

  <!-- Custom fonts for this template -->
  <link href="../assets/img/favicon.png" rel="icon" />
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/sb-admin-2.min.css" rel="stylesheet" />
  <link href="../assets/css/main.css" rel="stylesheet" />

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" />
</head>

<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #ef6603">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img src="../assets/img/logo.png" class="img-fluid" />
        </div>
        <div class="sidebar-brand-text mx-3">GacorTopUp </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Management
      </div>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="pengumuman.php">
          <i class="fas fa-bullhorn"></i>
          <span>Pengumuman</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="data_penjualan.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Data Penjualan</span></a>
      </li>




      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $admin_name ?></span>
                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="../logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Data Penjualan</h1>
          <p class="mb-4">
            List data penjualan pada website <strong>GacorTopUp</strong>
          </p>

          <!-- DataTable Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-2">
              <button class="btn btn-outline-success" id="exportExcel">Export to Excel</button>
              <button class="btn btn-outline-danger" id="exportPDF">Export to PDF</button>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>User ID</th>
                      <th>Zone ID</th>
                      <th>No. HP</th>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Tanggal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      include '../db/koneksi.php';
                      $cacheFile = '../storage/cache_status.json'; 
                      $cachedStatus = [];

                      if (file_exists($cacheFile)) {
                          $cachedStatus = json_decode(file_get_contents($cacheFile), true);
                      } else {
                          echo "Cache not found.";
                      }

                      $sql = "SELECT * FROM penjualan";
                      $result = $conn->query($sql);

                      if ($result->num_rows > 0) {
                          while ($row = $result->fetch_assoc()) {
                              $orderId = $row['order_id'];
                              $statusLabel = '<span class="badge rounded-pill text-bg-secondary">Unknown</span>';
                          
                              if (isset($cachedStatus[$orderId])) {
                                  $transactionStatus = $cachedStatus[$orderId];
                                  if ($transactionStatus === 'settlement') {
                                      $statusLabel = '<span class="badge badge-pill badge-success">Success</span>';
                                  } elseif ($transactionStatus === 'pending') {
                                      $statusLabel = '<span class="badge badge-pill badge-warning">Pending</span>';
                                  } elseif ($transactionStatus === 'expire') {
                                      $statusLabel = '<span class="badge badge-pill badge-secondary">Expired</span>';
                                  } elseif ($transactionStatus === 'cancel') {
                                      $statusLabel = '<span class="badge badge-pill badge-danger">Canceled</span>';
                                  }
                              } else {
                                  $statusLabel = '<span class="badge badge-pill badge-secondary">Unknown</span>';
                              }
                            
                              echo "<tr>";
                              echo "<td>" . $row['order_id'] . "</td>";
                              echo "<td>" . $row['user_id'] . "</td>";
                              echo "<td>" . $row['zone_id'] . "</td>";
                              echo "<td>" . $row['no_hp'] . "</td>";
                              echo "<td>" . $row['produk'] . "</td>";
                              echo "<td>" . number_format($row['harga'], 0, ',', '.') . "</td>";
                              echo "<td>" . date('d M Y H:i:s', strtotime($row['tanggal'])) . "</td>";
                              echo "<td>" . $statusLabel . "</td>";
                              echo "</tr>";
                          }
                      } else {
                          echo "<tr><td colspan='8'>No records found</td></tr>";
                      }

                      $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <strong>GacorTopUp</strong> 2024</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

      <div id="preloader"></div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin ingin logout?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Pilih tombol "Logout" jika ingin keluar.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="../logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/exceljs@4.3.0/dist/exceljs.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.21/jspdf.plugin.autotable.min.js"></script>


  <script>
    $("#exportExcel").on("click", function () {
      var data = $("#dataTable").DataTable().rows({
        search: "applied"
      }).data().toArray();

      var totalData = data.length;
      var totalPendapatan = 0;
      var pembayaranSukses = 0;
      var pembayaranPending = 0;

      data.forEach(function (row) {
        if ($("<div>").html(row[7]).text().trim() === "Success") {
          totalPendapatan += parseFloat(row[5].replace(/\./g, ""));
          pembayaranSukses++;
        }
        if ($("<div>").html(row[7]).text().trim() === "Pending") {
          pembayaranPending++;
        }
      });

      var workbook = new ExcelJS.Workbook();
      var worksheet = workbook.addWorksheet("Data Penjualan");

      worksheet.addRow(["Statistik Penjualan"]);

      worksheet.mergeCells('A1:B1');
      worksheet.getCell('A1').alignment = {
        horizontal: 'center',
        vertical: 'middle'
      };

      worksheet.getCell('A1').fill = {
        type: 'pattern',
        pattern: 'solid',
        fgColor: {
          argb: 'ef6603'
        }
      };

      worksheet.getCell('A1').font = {
        color: {
          argb: 'FFFFFFFF'
        },
        bold: true
      };

      worksheet.addRow(["Total Data Top-up", totalData]);
      worksheet.addRow(["Total Pendapatan", `Rp ${totalPendapatan.toLocaleString()}`]);
      worksheet.addRow(["Pembayaran Sukses", pembayaranSukses]);
      worksheet.addRow(["Pembayaran Pending", pembayaranPending]);

      worksheet.addRow([]);

      var headers = ["Order ID", "User ID", "Zone ID", "No HP", "Produk", "Harga", "Tanggal", "Status"];
      worksheet.addRow(headers);

      data.forEach(function (row) {
        worksheet.addRow([
          row[0], // Order ID
          row[1], // User ID
          row[2], // Zone ID
          row[3], // No HP
          row[4], // Produk
          row[5].replace(/\./g, ""), // Harga
          row[6], // Tanggal
          $("<div>").html(row[7]).text().trim(), // Status
        ]);
      });

      var headerRow = worksheet.getRow(7);
      headerRow.eachCell(function (cell) {
        cell.font = {
          bold: true,
          color: {
            argb: "FFFFFFFF"
          }
        };
        cell.fill = {
          type: "pattern",
          pattern: "solid",
          fgColor: {
            argb: "ef6603"
          },
        };
        cell.alignment = {
          horizontal: "center",
          vertical: "middle"
        };
      });

      worksheet.eachRow(function (row) {
        row.eachCell(function (cell) {
          cell.border = {
            top: {
              style: "thin"
            },
            left: {
              style: "thin"
            },
            bottom: {
              style: "thin"
            },
            right: {
              style: "thin"
            },
          };
          cell.alignment = {
            horizontal: "center",
            vertical: "middle"
          };
        });
      });

      worksheet.columns = [{
          width: 25
        },
        {
          width: 20
        },
        {
          width: 15
        },
        {
          width: 20
        },
        {
          width: 35
        },
        {
          width: 25
        },
        {
          width: 20
        },
        {
          width: 15
        },
      ];

      var today = new Date();
      var year = today.getFullYear();
      var month = String(today.getMonth() + 1).padStart(2, "0");
      var day = String(today.getDate()).padStart(2, "0");

      var fileName = `Data Penjualan GacorTopUp (${day}-${month}-${year}).xlsx`;

      workbook.xlsx.writeBuffer().then(function (buffer) {
        saveAs(new Blob([buffer], {
          type: "application/octet-stream"
        }), fileName);
      });
    });



    $("#exportPDF").on("click", function () {
      var data = $("#dataTable").DataTable().rows({
        search: "applied"
      }).data().toArray();

      var headers = ["Order ID", "User ID", "Zone ID", "No HP", "Produk", "Harga", "Tanggal", "Status"];

      var totalData = data.length;
      var totalPendapatan = 0;
      var pembayaranSukses = 0;
      var pembayaranPending = 0;

      data.forEach(function (row) {
        if ($("<div>").html(row[7]).text().trim() === "Success") {
          totalPendapatan += parseFloat(row[5].replace(/\./g, ""));
          pembayaranSukses++;
        }
        if ($("<div>").html(row[7]).text().trim() === "Pending") {
          pembayaranPending++;
        }
      });

      const {
        jsPDF
      } = window.jspdf;
      const doc = new jsPDF();

      doc.setFontSize(16);
      doc.text("Laporan Data Penjualan", 14, 10);

      doc.setFontSize(12);
      doc.text(`Total Data Top-up: ${totalData}`, 14, 20);
      doc.text(`Total Pendapatan: Rp ${totalPendapatan.toLocaleString()}`, 14,
        25);
      doc.text(`Pembayaran Sukses: ${pembayaranSukses}`, 14, 30);
      doc.text(`Pembayaran Pending: ${pembayaranPending}`, 14, 35);

      doc.autoTable({
        head: [headers],
        body: data.map(function (row) {
          return [
            row[0], // Order ID
            row[1], // User ID
            row[2], // Zone ID
            row[3], // No HP
            row[4], // Produk
            row[5].replace(/\./g, ""), // Harga
            row[6], // Tanggal
            $("<div>").html(row[7]).text().trim(), // Status
          ];
        }),
        startY: 45,
        theme: "grid",
        headStyles: {
          fillColor: [239, 102, 3],
          halign: 'center',
        },
        styles: {
          fontSize: 10,
          cellPadding: 3,
          halign: 'center',
        },
      });

      var today = new Date();
      var year = today.getFullYear();
      var month = String(today.getMonth() + 1).padStart(2, "0");
      var day = String(today.getDate()).padStart(2, "0");

      var fileName = `Data Penjualan GacorTopUp (${day}-${month}-${year}).pdf`;

      doc.save(fileName);
    });
  </script>


</body>

</html>