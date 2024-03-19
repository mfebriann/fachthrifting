<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting - Pengaturan</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
  include '../../db.php';

  if (isset ($_POST['submit'])) {
    $newName = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
    $newUsername = htmlspecialchars($_POST["username"], ENT_QUOTES, 'UTF-8');

    function updatePhotoProfile()
    {
      global $newUsername;
      global $newName;
      global $conn;
      global $id;

      $tempFileName = $_FILES['file']['name'];
      $tmpName = $_FILES['file']['tmp_name'];
      $imageExtension = explode('.', $tempFileName);
      $imageExtension = strtolower(end($imageExtension));
      $fileName = strtolower(explode('.', $tempFileName)[0]);

      $imagesDirectory = $_SERVER['DOCUMENT_ROOT'] . "/Rian-Folder-Backend/FachThrifting/Website/src/images/photoProfile/";
      $newFileName = $fileName . "-" . date("Y.m.d-H.i.s") . ".{$imageExtension}";

      mysqli_query($conn, "UPDATE `members` SET `name` = '$newName', username = '$newUsername', photo_profile = '$newFileName', dateupdated = NOW() WHERE member = $id");

      move_uploaded_file($tmpName, $imagesDirectory . $newFileName);
    }

    $checkUsername = mysqli_query($conn, "SELECT username FROM `members` WHERE username = '$newUsername'");

    if ($username !== $newUsername) {
      if (mysqli_num_rows($checkUsername) > 0) {
        echo '<script>alert("Username sudah digunakan oleh orang lain")</script>';
      } else {
        if ($_FILES['file']['name'] !== '') {
          updatePhotoProfile();
        } else {
          $query = mysqli_query($conn, "UPDATE `members` SET name = '$newName', username = '$newUsername', dateupdated = NOW() WHERE member = $id");
        }


        if (mysqli_affected_rows($conn) > 0) {
          echo '<script>alert("Profil Kamu berhasil diperbarui");window.location.href = `settings.php` </script>';
        } else {
          echo '<script>alert("Profil Kamu gagal diperbarui")</script>';
        }
      }
    } else {
      if ($_FILES['file']['name'] !== '') {
        updatePhotoProfile();
      } else {
        $query = mysqli_query($conn, "UPDATE `members` SET name = '$newName', username = '$newUsername', dateupdated = NOW() WHERE member = $id");
      }

      if (mysqli_affected_rows($conn) > 0) {
        echo '<script>alert("Profil Kamu berhasil diperbarui"); window.location.href = `settings.php` </script>';
      } else {
        echo '<script>alert("Profil Kamu gagal diperbarui")</script>';
      }
    }
  }

  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-semibold text-slate-700">Pengaturan</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-10 flex flex-col gap-5" enctype="multipart/form-data">
        <div class="flex justify-center">
          <div class="relative">
            <img
              src="<?= !$photoProfile ? '../images/photoProfile/default-profile.png' : "../images/photoProfile/$photoProfile" ?>"
              alt="<?= $username ?>" class="h-28 w-28 rounded-full" id="photo-profile" />
            <label for="file"
              class="absolute bg-slate-100 hover:bg-slate-200 w-7 h-7 flex justify-center cursor-pointer items-center rounded-full right-1 bottom-1">
              <input type="file" name="file" id="file" class="hidden" accept="image/png, image/jpg, image/jpeg">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="currentColor">
                <path
                  d="M2 3.9934C2 3.44476 2.45531 3 2.9918 3H21.0082C21.556 3 22 3.44495 22 3.9934V20.0066C22 20.5552 21.5447 21 21.0082 21H2.9918C2.44405 21 2 20.5551 2 20.0066V3.9934ZM12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12C15 13.6569 13.6569 15 12 15ZM12 17C14.7614 17 17 14.7614 17 12C17 9.23858 14.7614 7 12 7C9.23858 7 7 9.23858 7 12C7 14.7614 9.23858 17 12 17ZM18 5V7H20V5H18Z">
                </path>
              </svg>
            </label>
          </div>
        </div>
        <div class="flex flex-col gap-3 mt-3">
          <label for="name" class="text-slate-600">Nama</label>
          <input type="text" name="name" id="name" autocomplete="name" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" value="<?= $name ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="username" class="text-slate-600">Username</label>
          <input type="text" name="username" id="username" autocomplete="username" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none lowercase" value="<?= $username ?>" />
        </div>
        <button type="submit" name="submit" id="btn-submit"
          class="rounded-md px-3 py-2 outline-none btn-submit-active font-semibold">Simpan</button>
      </form>
      <a href="edit-password.php" class="mx-auto text-red-500 underline text-sm block w-max mt-8">Ubah Password?</a>
    </section>
  </main>
  <?php include '../components/footer.php' ?>

  <script src="../script/app.js"></script>
  <script>
    const photoProfile = document.getElementById('photo-profile');

    const file = document.getElementById('file');

    file.addEventListener('change', () => {
      photoProfile.src = URL.createObjectURL(file.files[0]);
    })
  </script>
</body>

</html>