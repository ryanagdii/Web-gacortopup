$(document).ready(function () {
  $("#dataTable").DataTable({
    order: [[6, "desc"]],
    columnDefs: [
      { className: "dt-center", targets: "_all" }, // Semua kolom di tengah
    ],
  });
});
