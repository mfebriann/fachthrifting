<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting - Ubah Anggota</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
  if ($role !== 'super_admin') {
    header("Location: dashboard.php");
    return;
  }

  $id = $_GET['id'];
  $queryRole = mysqli_query($conn, "SELECT DISTINCT(role) FROM members");

  $roles = [];
  while ($row = mysqli_fetch_assoc($queryRole)) {
    $roles[] = $row;
  }
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold text-slate-700">Ubah Role Anggota</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-7 flex flex-col gap-5">
        <div class="flex flex-col gap-3">
          <label for="role" class="text-slate-600">Role anggota</label>
          <select name="role" id="role"
            class="appearance-none relative rounded-md border border-slate-500 px-3 py-2 outline-none capitalize w-full">
            <?php foreach ($roles as $role): ?>
              <option value="<?= $role ?>" <?= $role['role'] === $role ? 'selected' : '' ?>>
                <?= str_replace('_', ' ', $role['role']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <button type="submit" name="submit" id="btn-submit"
          class="rounded-md w-full px-3 mt-5 py-2 outline-none btn-submit-active font-semibold">Ubah Anggota</button>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php' ?>
  <script src="../script/app.js"></script>
</body>

</html>