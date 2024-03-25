<?php
include 'db.php';

if (isset ($_COOKIE['login'])) {
  setcookie('login', 'true', time() + 60 * 60 * 24 * 30, '/', '', true);
  header('Location: src/pages/dashboard.php');
}

if (isset ($_POST['submit'])) {
  $username = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');
  $password = htmlspecialchars($_POST["password"], ENT_QUOTES, 'UTF-8');

  $query = mysqli_query($conn, "SELECT member, password FROM `members` WHERE `username` = '$username'");
  $response = mysqli_fetch_assoc($query);
  $encryptPassword = $response['password'];

  // If Input Correct Then Show Response
  if (password_verify($password, $encryptPassword)) {
    setcookie('login', 'true', time() + 60 * 60 * 24 * 30, '/', '', true);
    setcookie('member', $response['member'], time() + 60 * 60 * 24 * 30, '/', '', true);

    header('Location: src/pages/dashboard.php');
  } else {
    echo '<script>alert("Username atau password salah!")</script>';
  }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting</title>
  <link rel="stylesheet" href="src/css/styles.css" />
</head>

<body class="bg-login flex h-screen items-center justify-center bg-cover bg-no-repeat px-5">
  <main class="w-full max-w-96 rounded-md border-2 border-blue-700 bg-white p-5">
    <h1 class="text-center text-xl font-bold">Login terlebih dahulu</h1>
    <form class="mt-8 flex flex-col gap-6" method="POST">
      <div class="flex flex-col gap-2">
        <label for="username" class="text-sm text-slate-600">Username</label>
        <input type="text" name="username" id="username" required autocomplete="username" autofocus
          class="w-full rounded-full border border-blue-600 p-2 text-sm outline-blue-400 focus:border-blue-400"
          placeholder="Masukkan username kamu..." tabindex="1" />
      </div>
      <div class="flex flex-col gap-2">
        <div class="flex items-center justify-between gap-2">
          <label for="password" class="text-sm text-slate-600">Password</label>
          <a href="src/pages/forgot-password.php" class="text-sm text-blue-600 underline">Lupa password?</a>
        </div>
        <div class="relative">
          <input type="password" name="password" id="password" required autocomplete="current-password"
            class="w-full rounded-full border border-blue-600 p-2 pr-10 text-sm outline-blue-400 focus:border-blue-400"
            placeholder="Masukkan password kamu..." tabindex="2" />

          <div class="absolute bottom-0 right-0 top-0 flex cursor-pointer items-center pr-4 wrapper-show-hide-password"
            data-show-password="false">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
              class="show-hide-password h-5 w-5 fill-slate-600">
              <path
                d="M17.8827 19.2968C16.1814 20.3755 14.1638 21.0002 12.0003 21.0002C6.60812 21.0002 2.12215 17.1204 1.18164 12.0002C1.61832 9.62282 2.81932 7.5129 4.52047 5.93457L1.39366 2.80777L2.80788 1.39355L22.6069 21.1925L21.1927 22.6068L17.8827 19.2968ZM5.9356 7.3497C4.60673 8.56015 3.6378 10.1672 3.22278 12.0002C4.14022 16.0521 7.7646 19.0002 12.0003 19.0002C13.5997 19.0002 15.112 18.5798 16.4243 17.8384L14.396 15.8101C13.7023 16.2472 12.8808 16.5002 12.0003 16.5002C9.51498 16.5002 7.50026 14.4854 7.50026 12.0002C7.50026 11.1196 7.75317 10.2981 8.19031 9.60442L5.9356 7.3497ZM12.9139 14.328L9.67246 11.0866C9.5613 11.3696 9.50026 11.6777 9.50026 12.0002C9.50026 13.3809 10.6196 14.5002 12.0003 14.5002C12.3227 14.5002 12.6309 14.4391 12.9139 14.328ZM20.8068 16.5925L19.376 15.1617C20.0319 14.2268 20.5154 13.1586 20.7777 12.0002C19.8603 7.94818 16.2359 5.00016 12.0003 5.00016C11.1544 5.00016 10.3329 5.11773 9.55249 5.33818L7.97446 3.76015C9.22127 3.26959 10.5793 3.00016 12.0003 3.00016C17.3924 3.00016 21.8784 6.87992 22.8189 12.0002C22.5067 13.6998 21.8038 15.2628 20.8068 16.5925ZM11.7229 7.50857C11.8146 7.50299 11.9071 7.50016 12.0003 7.50016C14.4855 7.50016 16.5003 9.51488 16.5003 12.0002C16.5003 12.0933 16.4974 12.1858 16.4919 12.2775L11.7229 7.50857Z">
              </path>
            </svg>
          </div>
        </div>
      </div>
      <button type="submit" name="submit" class="rounded-full bg-blue-600 p-2 font-medium text-white hover:bg-blue-500">
        Masuk
      </button>
    </form>

    <div class="flex gap-2 justify-center mt-5">
      <p class="text-sm text-slate-600">Belum punya akun?</p>
      <a href="src/pages/register.php" class="text-sm text-blue-600 underline">Daftar</a>
    </div>
  </main>

  <script src="src/script/form.js"></script>
</body>

</html>