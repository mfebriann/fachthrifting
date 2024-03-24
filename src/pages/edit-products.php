<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting - Ubah Transaksi</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
  if ($role !== 'super_admin' || $role !== 'admin') {
    header("Location: dashboard.php");
    return;
  }

  $id = $_GET['id'];
  $query = mysqli_query($conn, "SELECT * FROM `products` WHERE product = $id");
  $response = mysqli_fetch_assoc($query);

  $product = $response['product'];
  $author = $response['author'];
  $status = $response['status'];
  $name = $response['name'];
  $size = $response['size'];
  $stok = $response['stok'];
  $category = $response['category'];
  $priceItem = $response['price_item'];
  $priceMaxNego = $response['price_max_nego'];
  $description = $response['description'];
  $images = $response['image_code'];

  // Category
  $queryCategories = mysqli_query($conn, 'SELECT DISTINCT `category` FROM products WHERE category != "" ');
  $categories = [];
  while ($row = mysqli_fetch_assoc($queryCategories)) {
    $categories[] = $row;
  }

  if (isset ($_POST['submit'])) {
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES, 'UTF-8');
    $nameProduct = htmlspecialchars($_POST['nama-produk'], ENT_QUOTES, 'UTF-8');
    $description = $_POST['keterangan'] !== '' ? "'" . htmlspecialchars($_POST['keterangan'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
    $idImages = $_POST['id-images'] !== '' ? "'" . $_POST['id-images'] . "'" : "NULL";
    $size = $_POST['ukuran'] !== '' ? "'" . htmlspecialchars($_POST['ukuran'], ENT_QUOTES, 'UTF-8') . "'" : "NULL";
    $stok = $_POST['stok'] !== '' ? htmlspecialchars($_POST['stok'], ENT_QUOTES, 'UTF-8') : "NULL";
    $category = ($_POST['new-category'] !== "NULL" && $_POST['new-category'] !== "") ? str_replace(' ', '-', strtolower(htmlspecialchars($_POST['new-category'], ENT_QUOTES, 'UTF-8'))) : htmlspecialchars($_POST['category'], ENT_QUOTES, 'UTF-8');
    $hargaItem = !$_POST['harga-item'] ? "NULL" : str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['harga-item']), ENT_QUOTES, 'UTF-8'));
    $hargaMaxNego = $_POST['harga-max-nego'] !== '' ? "'" . str_replace(',', '', htmlspecialchars(str_replace('.', '', $_POST['harga-max-nego']), ENT_QUOTES, 'UTF-8')) . "'" : "NULL";
    $statusProduct = $stok == 0 || $stok === '' ? 'sold' : 'available';

    mysqli_query($conn, "UPDATE `transactions` SET `name_product` = '$nameProduct', `size` = $size, `stok` = $stok, `category` = '$category', `price_item` = $hargaItem, `price_max_nego` = $hargaMaxNego, `description` = $description, `images` = $idImages, `dateupdated` = NOW() WHERE product_id = $product");

    mysqli_query($conn, "UPDATE `products` SET `name` = '$nameProduct', `size` = $size, `stok` = $stok, `category` = '$category', `price_item` = $hargaItem, `price_max_nego` = $hargaMaxNego, `description` = $description, `image_code` = $idImages, `dateupdated` = NOW(), `status` = '$statusProduct' WHERE product = $product");

    if (mysqli_affected_rows($conn) > 0) {
      echo '<script>alert("Produk berhasil diubah"); window.location.href = "products.php"; </script>';
    } else {
      echo '<script>alert("Produk gagal diubah"); </script>';
    }
  }
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold text-slate-700">Ubah Transaksi</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-7 flex flex-col gap-5">
        <input type="hidden" name="product-id" id="product-id" autocomplete="name" readonly
          class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $product ?>" />
        <div class="flex flex-col gap-3">
          <label for="pembuat" class="text-slate-600">Pengguna yang membuat</label>
          <input type="text" name="pembuat" id="pembuat" readonly autocomplete="name" required
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $author ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="status" class="text-slate-600">Status transaksi</label>
          <input type="text" name="status" id="status" readonly required
            class="rounded-md border border-slate-500 capitalize bg-[#F1F1F1] px-3 py-2 outline-none"
            value="<?= $status === 'available' ? 'Tersedia' : 'Habis' ?>" />
        </div>

        <div class="flex flex-col gap-3">
          <label for="nama-produk" class="text-slate-600">Nama produk</label>
          <input type="text" name="nama-produk" id="nama-produk" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" value="<?= $name ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="ukuran" class="text-slate-600">Ukuran
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="ukuran" id="ukuran" class="rounded-md border border-slate-500 px-3 py-2 outline-none"
            value="<?= $size ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="stok" class="text-slate-600">Stok</label>
          <input type="number" name="stok" id="stok" required
            class="rounded-md border border-slate-500 px-3 py-2 outline-none" value="<?= !$stok ? 0 : $stok ?>" />
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
              <option value="<?= str_replace(' ', '-', strtolower($categoryDB['category'])) ?>"
                <?= $category === $categoryDB['category'] ? 'selected' : '' ?>>
                <?= str_replace('-', ' ', $categoryDB['category']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-item" class="text-slate-600">Harga 1 barang</label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="harga-item" id="harga-item" required
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none"
              value="<?= $priceItem == "" ? 0 : number_format($priceItem, 0, ".", ",") ?>" />
          </div>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-max-nego" class="text-slate-600">Harga maksimal nego
            <span class="text-xs text-slate-500">(Optional)</span>
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="tel" name="harga-max-nego" id="harga-max-nego"
              class="w-full rounded-md border border-slate-500 px-3 py-2 pl-9 outline-none"
              value="<?= number_format($priceMaxNego, 0, ".", ",") ?>" />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label for="keterangan" class="text-slate-600">Keterangan
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <textarea name="keterangan" id="keterangan" cols="30" rows="10"
            class="rounded-md border border-slate-500 px-3 py-2 outline-none"><?= $description ?></textarea>
        </div>
        <div class="flex flex-col gap-3">
          <div class="flex flex-col gap-3">
            <input type="hidden" name="id-images" class="w-full" id="id-images" value="<?= $images ?>">
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
          <div class="flex flex-wrap gap-3" id="container-images">
            <?php if ($images != NULL): ?>
              <?php $productsImage = explode(',', $images) ?>
              <?php foreach ($productsImage as $productImage): ?>
                <?php
                $queryCode = mysqli_query($conn, "SELECT `name`, `path_image` FROM `codes` WHERE code = $productImage");
                $arrColumn = mysqli_fetch_assoc($queryCode);
                $nameImage = $arrColumn["name"];
                $pathImage = $arrColumn["path_image"];
                ?>
                <div>
                  <div class="w-40 bg-slate-100">
                    <div class="header-files">
                      <img src="../images/products/<?= $pathImage ?>" alt="attachment" class="h-40 w-full object-cover">
                    </div>
                    <div class="flex flex-wrap justify-end gap-2 px-2 py-4">
                      <a href="../images/products/<?= $pathImage ?>" title="download" download="<?= $nameImage ?>"
                        class="no-underline action-file block px-1 text-sm rounded cursor-pointer hover:opacity-70">
                        <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                            fill="#0B6AF8"></path>
                        </svg>
                      </a>
                      <button type="button"
                        class="cbtn-close btnDelete no-underline action-file flex items-center justify-center text-sm rounded cursor-pointer hover:opacity-70"
                        id="<?= $productImage ?>" title="Delete">
                        <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                          class="icon-delete-file-attachment">
                          <path
                            d="M2.16667 4.5H11.5V12.0833C11.5 12.4055 11.2388 12.6667 10.9167 12.6667H2.75C2.42784 12.6667 2.16667 12.4055 2.16667 12.0833V4.5ZM3.33333 5.66667V11.5H10.3333V5.66667H3.33333ZM5.08333 6.83333H6.25V10.3333H5.08333V6.83333ZM7.41667 6.83333H8.58333V10.3333H7.41667V6.83333ZM3.91667 2.75V1.58333C3.91667 1.26117 4.17784 1 4.5 1H9.16667C9.48884 1 9.75 1.26117 9.75 1.58333V2.75H12.6667V3.91667H1V2.75H3.91667ZM5.08333 2.16667V2.75H8.58333V2.16667H5.08333Z"
                            fill="#FF0000"></path>
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>

        <button type="submit" name="submit" id="btn-submit"
          class="rounded-md w-full px-3 mt-5 py-2 outline-none btn-submit-active font-semibold">Ubah Produk</button>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
  <script src="../script/categories.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="../script/uploadFiles.js"></script>
</body>

</html>