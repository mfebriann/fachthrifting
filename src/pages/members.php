<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting - Lihat Transaksi</title>
  <link rel="stylesheet" href="../css/styles.css" />
  <link href="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css" rel="stylesheet">

</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
  if ($role !== 'super_admin') {
    header("Location: dashboard.php");
    return;
  }

  $query = mysqli_query($conn, "SELECT * FROM `members` ORDER BY member DESC");
  $members = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $members[] = $row;
  }
  $no = 1;
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-semibold text-slate-700">Daftar anggota</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>

      <div class="mt-14 overflow-auto">
        <table cellpadding="10" class="w-full" id="members">
          <thead>
            <tr class="whitespace-nowrap">
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                No
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Tanggal
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Nama
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Username
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Role
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Foto profile
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">Aksi</th>
            </tr>
          </thead>
          <tbody class="[&>*:nth-child(even)]:bg-white [&>*:nth-child(odd)]:bg-slate-100">
            <?php foreach ($members as $member): ?>
              <?php $photoProfile = $member['photo_profile'] ?>
              <tr>
                <?php
                $date = date("d/m/Y", strtotime($member['datejoin']));
                ?>
                <td class="text-center">
                  <?= $no ?>
                </td>
                <td>
                  <?= $date ?>
                </td>
                <td class="text-left">
                  <?= $member['name'] ?>
                </td>
                <td class="text-left">
                  <?= $member['username'] ?>
                </td>
                <td class="text-left">
                  <?= $member['role'] ?>
                </td>
                <td class="text-left">
                  <div class="flex justify-center">
                    <img
                      src="<?= !$photoProfile ? '../images/photoProfile/default-profile.png' : "../images/photoProfile/$photoProfile" ?>"
                      alt="<?= $member['username'] ?>" class="h-20 object-cover w-20">
                  </div>
                </td>
                <td><a href="edit-members.php?id=<?= $member['member'] ?>"
                    class="block w-max mx-auto cursor-pointer rounded-md bg-green-600 p-2 hover:opacity-75">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                      fill="rgba(255,255,255,1)">
                      <path
                        d="M12.8995 6.85453L17.1421 11.0972L7.24264 20.9967H3V16.754L12.8995 6.85453ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z">
                      </path>
                    </svg>
                  </a></td>
              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <script>
    new DataTable('#members', {
      pageLength: 100,
      ordering: false,
    });
  </script>
</body>

</html>