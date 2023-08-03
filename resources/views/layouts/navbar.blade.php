<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <!-- Right navbar links -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="logoutButton" href="javascript:void(0);" role="button">
        <i class="fas">
          <svg  height="1em" viewBox="0 0 512 512">
            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/></svg>
        </i>
      </a>
    </li>
  </ul>
</nav>

<script>
const urlLogout = 'v4/56cfb271-4e29-47cc-a237-8ae819491903/user/logout'
$(document).ready(function() {
  $('#logoutButton').click(function(e) {
    Swal.fire({
      title: 'Yakin ingin Logout?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes',
      cancelButtonText: 'Cancel',
      resolveButton: true
    }).then((result) => {
      if (result.isConfirmed) {
        e.preventDefault();
        $.ajax({
          url: `{{ url('${urlLogout}') }}`,
          method: 'POST',
          dataType: 'json',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
            localStorage.removeItem('access_token');
            window.location.href = '/login';
          },
          error: function(xhr, status, error) {
            alert('Error: Failed to logout. Please try again.');
          }
        });
      }
    });
  });
});

const apiCheck = "v2/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk";

$(document).ready(function() {
  $.ajax({
    url: `{{ url('${apiCheck}') }}`,
    method: "GET",
    dataType: "json",
    success: function(response) {
      // console.log(response, '<-- success to login');
    },
    error: function() {
      console.log("Failed to get data from server || dari navbar");
      window.location.href = '/login';
    }
  });
});
</script>