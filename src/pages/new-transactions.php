<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting - Tambah Transaksi</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
  $statusTransactions = ['pengeluaran', 'pemasukkan'];
  $queryCategories = mysqli_query($conn, 'SELECT DISTINCT `category` FROM transactions WHERE category != "" ');
  $categories = [];
  while ($row = mysqli_fetch_assoc($queryCategories)) {
    $categories[] = $row;
  }

  if (isset($_POST['submit'])) {
    $authorId = $response['member'];
    $isProduct = isset($_POST['product-check']) ? 'yes' : 'no';
    $status = $_POST['status'];
    $pesanTransaksi = htmlspecialchars($_POST['pesan-transaksi'], ENT_QUOTES, 'UTF-8');
    $totalHarga = str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['total-harga']), ENT_QUOTES, 'UTF-8'));
    $adminFee = $_POST['biaya-admin'] !== '' ? "'" . str_replace(',', '', $_POST['biaya-admin']) . "'" : "NULL";
    $description = $_POST['keterangan'] !== '' ? "'" . htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
    $idImages = $_POST['id-images'] !== '' ? "'" . $_POST['id-images'] . "'" : "NULL";
    $dateTransaction = $_POST['tanggal-transaksi'];

    if ($isProduct === 'yes') {
      $nameProduct = $_POST['nama-produk'] !== '' ? "'" . htmlspecialchars($_POST['nama-produk'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
      $size = $_POST['ukuran'] !== '' ? "'" . htmlspecialchars($_POST['ukuran'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
      $stok = $_POST['stok'] !== '' ? "'" . htmlspecialchars($_POST['stok'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
      $category = ($_POST['new-category'] !== "NULL" && $_POST['new-category'] !== "") ? str_replace(' ', '-', strtolower(htmlspecialchars($_POST['new-category'], ENT_QUOTES, 'UTF-8'))) : htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
      $hargaItem = !$_POST['harga-item'] ? "NULL" : str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['harga-item']), ENT_QUOTES, 'UTF-8'));
      $hargaMaxNego = $_POST['harga-max-nego'] !== '' ? "'" . str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['harga-max-nego']), ENT_QUOTES, 'UTF-8')) . "'" : "NULL";
      $resi = $_POST['resi-kurir'] !== '' ? "'" . str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['resi-kurir']), ENT_QUOTES, 'UTF-8')) . "'" : "NULL";

      mysqli_query($conn, "INSERT INTO `products` VALUES(NULL, '$name', $authorId, $nameProduct, $size, $stok, '$category', '$hargaItem', $hargaMaxNego, $description, $idImages, NOW(), NULL, 'available', 'yes')");

      $query = mysqli_query($conn, "SELECT product FROM `products` ORDER BY product DESC LIMIT 0,1");
      $productId = mysqli_fetch_assoc($query)['product'];

      mysqli_query($conn, "INSERT INTO `transactions` VALUES(NULL, '{$pesanTransaksi}', '$name', $authorId, $nameProduct, '$isProduct', '$status', $size, $stok, '$category', $resi, '$totalHarga', '$hargaItem', $hargaMaxNego, $adminFee, $description, $idImages, $productId ,NOW(), NULL, '$dateTransaction')");
    } else {
      mysqli_query($conn, "INSERT INTO `transactions` (`transaction`, `message`, author, author_id, `status`, isproduct, total_price, admin_fee, `description`, images, `datetime`, `datetransaction`) VALUES(NULL, '$pesanTransaksi', '$name', $authorId, '$status', '$isProduct', $totalHarga, $adminFee, $description, $idImages, NOW(), '$dateTransaction')");
    }

    if (mysqli_affected_rows($conn) > 0) {
      echo '<script>alert("Berhasil menambahkan transaksi baru"); window.location.href = "transactions.php"; </script>';
    } else {
      echo '<script>alert("Gagal menambahkan transaksi baru"); window.location.href = "transactions.php"; </script>';
    }
  }
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold text-slate-700">Tambah Transaksi Baru</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-7 flex flex-col gap-5" enctype="multipart/form-data">
        <input type="hidden" name="transaction-id" id="transaction-id" autocomplete="name" readonly
          class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="" />
        <div class="flex flex-col gap-3">
          <label for="pembuat" class="text-slate-600">Pengguna yang membuat</label>
          <input type="text" name="pembuat" id="pembuat" readonly autocomplete="name" required
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $name ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="tanggal-transaksi" class="text-slate-600">Waktu transaksi</label>
          <input type="date" required name="tanggal-transaksi" id="tanggal-transaksi"
            class="appearance-none relative rounded-md border border-slate-500 px-3 py-2 outline-none capitalize w-full"
            value="<?= date('Y-m-d') ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="status" class="text-slate-600">Status transaksi</label>
          <select name="status" id="status"
            class="appearance-none relative rounded-md border border-slate-500 px-3 py-2 outline-none capitalize w-full">
            <?php foreach ($statusTransactions as $statusTransaction): ?>
              <option value="<?= $statusTransaction ?>">
                <?= $statusTransaction ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="flex items-center gap-2">
          <input type="checkbox" name="product-check" id="product-check" class="w-5 h-5" />
          <label for="product-check" class="w-full text-sm text-slate-600 sm:text-base">Apakah ini berhubungan
            dengan produk?</label>
        </div>
        <div class="flex flex-col gap-3">
          <label for="pesan-transaksi" class="text-slate-600">Pesan transaksi</label>
          <input type="text" name="pesan-transaksi" id="pesan-transaksi" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="nama-produk" class="text-slate-600">Nama produk</label>
          <input type="text" name="nama-produk" id="nama-produk" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="ukuran" class="text-slate-600">Ukuran
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="ukuran" id="ukuran"
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="stok" class="text-slate-600">Stok</label>
          <input type="number" name="stok" id="stok" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" value="1" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <div class="flex justify-between items-center">
            <label for="category" class="text-slate-600">Kategori</label>
            <span id="add-category" class="underline text-green-600 text-sm cursor-pointer hover:text-green-500">Tambah
              kategori baru?</span>
            <span id="cancel-category"
              class="underline text-red-600 text-sm cursor-pointer hover:text-red-500 hidden">Batal
              buat
              kategori baru</span>
          </div>
          <input type="text" name="new-category" id="new-category"
            class="rounded-md border hidden border-slate-500 px-3 py-2 outline-none" />
          <select name="category" id="category"
            class="appearance-none relative rounded-md border border-slate-500 px-3 py-2 outline-none capitalize w-full"
            required>
            <?php foreach ($categories as $categoryDB): ?>
              <option value="<?= str_replace(' ', '-', strtolower($categoryDB['category'])) ?>">
                <?= str_replace('-', ' ', $categoryDB['category']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="flex flex-col gap-3">
          <label for="total-harga" class="text-slate-600">Total harga</label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="total-harga" id="total-harga" required
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none" />
          </div>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-item" class="text-slate-600">Harga 1 barang</label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="harga-item" id="harga-item" required
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none" />
          </div>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-max-nego" class="text-slate-600">Harga maksimal nego
            <span class="text-xs text-slate-500">(Optional)</span>
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="harga-max-nego" id="harga-max-nego"
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none" />
          </div>
        </div>

        <div class="flex flex-col gap-3">
          <label for="biaya-admin" class="text-slate-600">Biaya admin kirim
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="biaya-admin" id="biaya-admin"
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none" />
          </div>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="resi-kurir" class="text-slate-600">Resi
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="resi-kurir" id="resi-kurir"
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="keterangan" class="text-slate-600">Keterangan
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <textarea name="keterangan" id="keterangan" cols="30" rows="10"
            class="rounded-md border border-slate-500 px-3 py-2 outline-none"></textarea>
        </div>
        <div class="flex flex-col gap-3">
          <div class="flex flex-col gap-3">
            <input type="hidden" name="id-images" class="w-full" id="id-images">
            <label class="text-slate-600 ">
              <span class="islabelproduct">Gambar produk/Bukti transfer</span>
              <span class="text-xs text-slate-500">(Optional)</span>
            </label>
            <div class="flex gap-2">
              <input
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none file:bg-gray-300 file:px-3 file:h-full file:border-0"
                name="images" id="images" type="file" accept="image/png, image/jpg, image/jpeg">
              <button type="button" id="submit-images" name="submit-images"
                class="bg-red-600 hover:bg-red-500 text-white px-8 py-2 rounded-md font-semibold text-sm uppercase">Pilih</button>
            </div>
          </div>
          <div class="flex flex-wrap gap-3" id="container-images"></div>
          <!-- Preview gambar produk/bukti transfer -->
        </div>
        <button type="submit" name="submit" id="btn-submit"
          class="rounded-md w-full px-3 mt-5 py-2 outline-none text-white bg-green-500 hover:bg-green-400 font-semibold">Tambah
          Transaksi</button>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
  <script src="../script/transactions.js"></script>
  <script src="../script/categories.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../script/uploadFiles.js"></script>
</body>

</html>