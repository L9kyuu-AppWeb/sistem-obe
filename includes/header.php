<!-- header.php -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light bg-teal">
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
      <span class="nav-link" id="navbar-clock">
        <i class="far fa-clock"></i> <span id="clock-time">--:--:--</span>
      </span>
    </li>
    <script>
      setInterval(() => {
        const now = new Date();
        document.getElementById("clock-time").textContent = now.toLocaleTimeString();
      }, 1000);
    </script>
    <li class="nav-item dropdown">
      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-user"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-header">Halo, Admin</span>
        <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item">
          <i class="fas fa-user-cog mr-2"></i> Profil Saya
        </a>
        <a href="#" class="dropdown-item">
          <i class="fas fa-sign-out-alt mr-2"></i> Keluar
        </a>
      </div>
    </li>
  </ul>
</nav>