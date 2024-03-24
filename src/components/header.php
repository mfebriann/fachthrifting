<?php
include ('../../db.php');
include ('../utils/checkCookie.php');
$id = $response['member'];
$name = $response['name'];
$username = $response['username'];
$password = $response['password'];
$role = $response['role'];
$photoProfile = $response['photo_profile'];

$websiteName = "fachthrifting.modifwebsite.id/assets/";
?>

<header class="fixed left-0 right-0 top-0 z-10 bg-blue-600 px-4 py-3">
  <nav class="container relative mx-auto flex items-center justify-between">
    <a href="dashboard.php" class="flex-shrink-0 text-xl font-semibold text-white">FACH Thrifting</a>
    <div
      class="absolute right-0 top-16 hidden w-full max-w-72 flex-col rounded-md border border-slate-300 bg-white shadow-md md:static md:flex md:max-w-full md:flex-row md:items-center md:justify-between md:border-none md:bg-transparent md:shadow-none"
      id="submenu">
      <ul class="flex flex-col md:mx-auto md:flex-row md:items-center md:gap-6">
        <li>
          <a href="dashboard.php"
            class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:p-0 md:text-white md:hover:bg-transparent">Dashboard</a>
        </li>
        <li>
          <a href="transactions.php"
            class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:p-0 md:text-white md:hover:bg-transparent">Transaksi</a>
        </li>
        <li>
          <a href="products.php"
            class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:p-0 md:text-white md:hover:bg-transparent">Stok
            Produk</a>
        </li>
        <?php if ($role === 'super_admin'): ?>
          <li>
            <a href="members.php"
              class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:p-0 md:text-white md:hover:bg-transparent">Kelola
              Pengguna</a>
          </li>
        <?php endif; ?>
      </ul>
      <div class="flex flex-col md:flex-row md:gap-4 md:items-center">
        <a href="settings.php" title="<?= $name ?>">
          <span
            class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:hidden md:p-0 md:text-white md:hover:bg-transparent">Pengaturan</span>
          <img
            src="<?= !$photoProfile ? '../images/photoProfile/default-profile.png' : "../images/photoProfile/$photoProfile" ?>"
            alt="person" class="hidden h-10 w-10 rounded-full object-cover md:block" />
        </a>
        <a href="../utils/logout.php" title="Keluar">
          <span
            class="block px-3 py-2 font-medium hover:bg-blue-100 hover:opacity-80 md:hidden md:p-0 md:text-white md:hover:bg-transparent">Keluar</span>

          <div
            class="hidden md:flex cursor-pointer hover:rounded-full hover:bg-slate-400 w-10 h-10 ease-in duration-150 items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"
              fill="rgba(255,255,255,1)">
              <path
                d="M5 22C4.44772 22 4 21.5523 4 21V3C4 2.44772 4.44772 2 5 2H19C19.5523 2 20 2.44772 20 3V6H18V4H6V20H18V18H20V21C20 21.5523 19.5523 22 19 22H5ZM18 16V13H11V11H18V8L23 12L18 16Z">
              </path>
            </svg>
          </div>
        </a>
      </div>
    </div>
    <div class="relative block md:hidden" id="menu">
      <input type="checkbox" class="absolute inset-0 cursor-pointer opacity-0" id="checkbox" />
      <div>
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="rgba(255,255,255,1)">
          <path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path>
        </svg>
      </div>
    </div>
  </nav>
</header>