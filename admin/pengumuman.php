<?php
session_start();
$admin_name = $_SESSION['admin_name'];
$admin_email = $_SESSION['admin_email'];

if (!isset($admin_name)) {
    header('location:../login');
}

// Include the database connection file
include '../db/koneksi.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Pengumuman - GacorTopUp</title>

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
      <li class="nav-item active">
        <a class="nav-link" href="pengumuman.php">
          <i class="fas fa-bullhorn"></i>
          <span>Pengumuman</span></a>
      </li>
      <li class="nav-item">
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

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="h3 mb-2 text-gray-800">Pengumuman</h1>
          <p class="mb-4">List pengumuman yang ada di website <strong>GacorTopUp</strong></p>

          <!-- Add Announcement Form -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-warning">Tambah Pengumuman</h6>
            </div>
            <div class="card-body">
              <form method="POST">
                <div class="form-group">
                  <label for="judul">Judul</label>
                  <input type="text" class="form-control" id="judul" name="judul" required>
                </div>
                <div class="form-group">
                  <label for="deskripsi">Deskripsi</label>
                  <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="add_announcement">Tambah Pengumuman</button>
              </form>
            </div>
          </div>

          <!-- Announcement Table -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-warning">Data Pengumuman</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Judul</th>
                      <th>Deskripsi</th>
                      <th>Dibuat pada</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM announce ORDER BY created_at DESC";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['judul'] . "</td>";
                            echo "<td>" . $row['deskripsi'] . "</td>";
                            echo "<td>" . date('d M Y H:i', strtotime($row['created_at'])) . "</td>";
                            echo "<td>
                                    <button class='btn btn-info btn-sm' data-toggle='modal' data-target='#editModal' onclick='editAnnouncement(" . $row['id'] . ", \"" . $row['judul'] . "\", \"" . $row['deskripsi'] . "\")'>Edit</button>
                                    <a href='#' class='btn btn-danger btn-sm' onclick='confirmDelete(" . $row['id'] . ")'>Delete</a>
                                  </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No records found</td></tr>";
                    }
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

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

      <div id="preloader"></div>

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit Pengumuman</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="edit_judul">Judul</label>
              <input type="hidden" id="edit_id" name="id">
              <input type="text" class="form-control" id="edit_judul" name="edit_judul" required>
            </div>
            <div class="form-group">
              <label for="edit_deskripsi">Deskripsi</label>
              <textarea class="form-control" id="edit_deskripsi" name="edit_deskripsi" required></textarea>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" name="edit_announcement">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable();
    });

    function editAnnouncement(id, judul, deskripsi) {
      document.getElementById('edit_id').value = id;
      document.getElementById('edit_judul').value = judul;
      document.getElementById('edit_deskripsi').value = deskripsi;
    }

    function confirmDelete(id) {
      Swal.fire({
        title: 'Anda Yakin Ingin Menghapus Data ini?',
        text: "Anda tidak akan dapat mengembalikannya!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74c3c',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = '?delete_id=' + id;
        }
      });
    }
  </script>
</body>

</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_announcement'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $created_at = date('Y-m-d H:i:s');

    $sql = "INSERT INTO announce (judul, deskripsi, created_at) VALUES ('$judul', '$deskripsi', '$created_at')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Pengumuman berhasil dibuat!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Pengumuman gagal dibuat!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    }
}

if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $sql = "DELETE FROM announce WHERE id = $delete_id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Pengumuman berhasil dihapus!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Pengumuman gagal dihapus!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    }
}

if (isset($_POST['edit_announcement'])) {
    $id = $_POST['id'];
    $judul = $_POST['edit_judul'];
    $deskripsi = $_POST['edit_deskripsi'];

    $sql = "UPDATE announce SET judul = '$judul', deskripsi = '$deskripsi' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Pengumuman berhasil diubah!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Pengumuman gagal diubah!',
                confirmButtonText: 'OK',
                confirmButtonColor: '#e74c3c'
            }).then(function() {
                window.location= 'pengumuman.php';
            });
        </script>";
    }
}
?>