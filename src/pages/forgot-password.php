<?php
if (isset ($_COOKIE['login'])) {
  setcookie('login', 'true', time() + 60 * 60 * 24 * 30, '/', '', true);
  header('Location: dashboard.php');
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body class="bg-login flex h-screen items-center justify-center bg-cover bg-no-repeat px-5">
  <main class="w-full max-w-96 rounded-md border-2 border-blue-700 bg-white p-5">
    <h1 class="text-center text-xl font-bold">Tanya ke admin untuk mereset password!</h1>


    <div class="flex gap-2 justify-center mt-5">
      <p class="text-sm text-slate-600">Sudah punya akun?</p>
      <a href="../../index.php" class="text-sm text-blue-600 underline">Masuk</a>
    </div>

  </main>

  <script src="../script/form.js"></script>
</body>

</html>