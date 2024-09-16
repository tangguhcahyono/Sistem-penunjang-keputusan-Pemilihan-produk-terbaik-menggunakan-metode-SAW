$(document).ready(function () {
  $("#example").DataTable({
    paging: true, // enable pagination
    lengthChange: true, // enable show entries
    searching: true, // enable search
    ordering: true, // enable sorting
    info: true, // enable info
    autoWidth: false, // disable auto width calculation
    responsive: true, // enable responsiveness
  });
});
