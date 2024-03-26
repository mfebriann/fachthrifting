<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Fach Thrifting</title>
  <link rel="stylesheet" href="../css/styles.css" />
</head>

<body>
  <?php include '../components/header.php' ?>

  <?php
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
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold text-slate-700">Lihat Produk</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-7 flex flex-col gap-5">
        <input type="hidden" name="transaction-id" id="transaction-id" autocomplete="name" readonly
          class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $transaction ?>" />
        <div class="flex flex-col gap-3">
          <label for="pembuat" class="text-slate-600">Pengguna yang membuat</label>
          <input type="text" name="pembuat" id="pembuat" autocomplete="name" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $author ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="status" class="text-slate-600">Status stok</label>
          <input type="text" name="status" id="status" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none capitalize"
            value="<?= $status === 'available' ? 'Tersedia' : 'Habis' ?>" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="nama-produk" class="text-slate-600">Nama produk</label>
          <input type="text" name="nama-produk" id="nama-produk" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $name ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="ukuran" class="text-slate-600">Ukuran
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="ukuran" id="ukuran" readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $size ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="stok" class="text-slate-600">Stok</label>
          <input type="number" name="stok" id="stok" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="<?= $stok ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="category" class="text-slate-600">Kategori</label>
          <input type="text" name="category" id="category" required readonly
            class="rounded-md border capitalize border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
            value="<?= str_replace('-', ' ', $category) ?>" />
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-item" class="text-slate-600">Harga 1 barang</label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="text" name="harga-item" id="harga-item" required readonly
              class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
              value="<?= number_format($priceItem) ?>" />
          </div>
        </div>
        <div class="flex flex-col gap-3 isproduct">
          <label for="harga-max-nego" class="text-slate-600">Harga maksimal nego
            <span class="text-xs text-slate-500">(Optional)</span>
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="text" name="harga-max-nego" id="harga-max-nego" readonly
              class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
              value="<?= number_format($priceMaxNego) ?>" />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label for="keterangan" class="text-slate-600">Keterangan
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <textarea name="keterangan" id="keterangan" cols="30" rows="10" readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"><?= $description ?></textarea>
        </div>
        <div class="flex flex-col gap-3">
          <input type="hidden" name="id-images" class="w-full" id="id-images" value="<?= $images ?>">
          <label for="upload-bukti" class="text-slate-600">
            <span class="islabelproduct">Gambar produk/Bukti transfer</span>
            <span class="text-xs text-slate-500">(Optional)</span>
          </label>
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
                  <a href="../images/products/<?= $pathImage ?>" class="header-files">
                    <img src="../images/products/<?= $pathImage ?>" alt="attachment" class="h-40 w-full object-cover">
                  </a>
                  <div class="flex flex-wrap justify-end gap-2 px-2 py-4">
                    <?php if ($role !== 'user'): ?>
                      <a href="../images/products/<?= $pathImage ?>" title="download" download="<?= $nameImage ?>"
                        class="no-underline action-file block px-1 text-sm rounded cursor-pointer hover:opacity-70">
                        <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                            d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                            fill="#0B6AF8"></path>
                        </svg>
                      </a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>

        </div>
        </div>
      </form>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
  <script src="../script/transactions.js"></script>
</body>

</html>