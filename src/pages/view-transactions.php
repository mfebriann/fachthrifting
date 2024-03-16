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

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-3xl font-semibold text-slate-700">Lihat Transaksi</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <form method="POST" class="mt-7 flex flex-col gap-5">
        <!-- Pengeluaran - Produk tidak di check -->
        <div class="flex flex-col gap-3">
          <label for="pembuat" class="text-slate-600">Pengguna yang membuat</label>
          <input type="text" name="pembuat" id="pembuat" autocomplete="name" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="Muhammad Febrian" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="status" class="text-slate-600">Status transaksi</label>
          <input type="text" name="status" id="status" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="Pengeluaran" />
        </div>
        <div class="flex items-center gap-1">
          <input type="checkbox" name="produk-check" id="produk-check" class="w-4" required onclick="return false;"
            readonly />
          <label for="produk-check" class="w-full text-sm text-slate-600 sm:text-base">Bukan pengeluaran untuk
            produk</label>
        </div>
        <div class="flex flex-col gap-3">
          <label for="pesan-transaksi" class="text-slate-600">Pesan transaksi</label>
          <input type="text" name="pesan-transaksi" id="pesan-transaksi" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
            value="Membeli Sweater Crocodile" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="ukuran" class="text-slate-600">Ukuran
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="ukuran" id="ukuran" readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="L" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="stok" class="text-slate-600">Stok</label>
          <input type="number" name="stok" id="stok" required readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="2" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="total-harga" class="text-slate-600">Total harga</label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="text" name="total-harga" id="total-harga" required readonly
              class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
              value="100.000" />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label for="harga-max-nego" class="text-slate-600">Harga maksimal nego
            <span class="text-xs text-slate-500">(Optional)</span>
          </label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="text" name="harga-max-nego" id="harga-max-nego" readonly
              class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
              value="50.000" />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label for="biaya-admin" class="text-slate-600">Biaya admin kirim
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <div class="relative flex items-center">
            <span class="absolute left-3">Rp</span>
            <input type="text" name="biaya-admin" id="biaya-admin" readonly
              class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
              value="6.500" />
          </div>
        </div>
        <div class="flex flex-col gap-3">
          <label for="resi-kurir" class="text-slate-600">Resi
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <input type="text" name="resi-kurir" id="resi-kurir" readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none" value="RS09281021KS" />
        </div>
        <div class="flex flex-col gap-3">
          <label for="keterangan" class="text-slate-600">Keterangan
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <textarea name="keterangan" id="keterangan" cols="30" rows="10" readonly
            class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none">
Tadi gua belanja merek baju crocodile, fila, uniqlo,
sama zalora.

Gua beli di alamat blabla

No resinya: #21312321
          </textarea>
        </div>
        <div class="flex flex-col gap-3">
          <label for="upload-bukti" class="text-slate-600">Gambar produk/Bukti transfer
            <span class="text-xs text-slate-500">(Optional)</span></label>
          <div class="flex flex-wrap gap-3">
            <div class="w-40 bg-slate-100">
              <img
                src="https://images.tokopedia.net/img/cache/700/VqbcmM/2023/1/18/daab8512-0b79-4692-8e4e-541803a3689d.jpg"
                alt="produk" class="h-40 w-full object-cover" />
              <div class="flex flex-wrap justify-end gap-3 px-2 py-4">
                <div class="cursor-pointer hover:opacity-70" title="Delete">
                  <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M2.16667 4.5H11.5V12.0833C11.5 12.4055 11.2388 12.6667 10.9167 12.6667H2.75C2.42784 12.6667 2.16667 12.4055 2.16667 12.0833V4.5ZM3.33333 5.66667V11.5H10.3333V5.66667H3.33333ZM5.08333 6.83333H6.25V10.3333H5.08333V6.83333ZM7.41667 6.83333H8.58333V10.3333H7.41667V6.83333ZM3.91667 2.75V1.58333C3.91667 1.26117 4.17784 1 4.5 1H9.16667C9.48884 1 9.75 1.26117 9.75 1.58333V2.75H12.6667V3.91667H1V2.75H3.91667ZM5.08333 2.16667V2.75H8.58333V2.16667H5.08333Z"
                      fill="#FF0000" />
                  </svg>
                </div>
                <div class="cursor-pointer hover:opacity-70" title="Download">
                  <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                      fill="#0B6AF8" />
                  </svg>
                </div>
              </div>
            </div>
            <div class="w-40 bg-slate-100">
              <img
                src="https://assets-a2.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg?t=o&v=500"
                alt="bukti-transfer" class="h-40 w-full object-cover" />
              <div class="flex flex-wrap justify-end gap-3 px-2 py-4">
                <div class="cursor-pointer hover:opacity-70" title="Delete">
                  <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M2.16667 4.5H11.5V12.0833C11.5 12.4055 11.2388 12.6667 10.9167 12.6667H2.75C2.42784 12.6667 2.16667 12.4055 2.16667 12.0833V4.5ZM3.33333 5.66667V11.5H10.3333V5.66667H3.33333ZM5.08333 6.83333H6.25V10.3333H5.08333V6.83333ZM7.41667 6.83333H8.58333V10.3333H7.41667V6.83333ZM3.91667 2.75V1.58333C3.91667 1.26117 4.17784 1 4.5 1H9.16667C9.48884 1 9.75 1.26117 9.75 1.58333V2.75H12.6667V3.91667H1V2.75H3.91667ZM5.08333 2.16667V2.75H8.58333V2.16667H5.08333Z"
                      fill="#FF0000" />
                  </svg>
                </div>
                <div class="cursor-pointer hover:opacity-70" title="Download">
                  <svg width="24" height="24" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                      d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                      fill="#0B6AF8" />
                  </svg>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End Pengeluaran - Produk tidak di check -->

        <!-- Pengeluaran - check -->
        <!-- <div class="flex flex-col gap-3">
            <label for="pembuat" class="text-slate-600"
              >Pengguna yang membuat</label
            >
            <input
              type="text"
              name="pembuat"
              id="pembuat"
              autocomplete="name"
              required
              readonly
              class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
              value="Muhammad Febrian"
            />
          </div>
          <div class="flex flex-col gap-3">
            <label for="status" class="text-slate-600">Status transaksi</label>
            <input
              type="text"
              name="status"
              id="status"
              required
              readonly
              class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
              value="Pengeluaran"
            />
          </div>
          <div class="flex items-center gap-1">
            <input
              type="checkbox"
              name="produk-check"
              id="produk-check"
              class="w-4"
              required
              onclick="return false;"
              readonly
              checked
            />
            <label
              for="produk-check"
              class="w-full text-sm text-slate-600 sm:text-base"
              >Bukan pengeluaran untuk produk</label
            >
          </div>
          <div class="flex flex-col gap-3">
            <label for="pesan-transaksi" class="text-slate-600"
              >Pesan transaksi</label
            >
            <input
              type="text"
              name="pesan-transaksi"
              id="pesan-transaksi"
              required
              readonly
              class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
              value="Minjem dulu buat bayar utang"
            />
          </div>

          <div class="flex flex-col gap-3">
            <label for="total-harga" class="text-slate-600">Total harga</label>
            <div class="relative flex items-center">
              <span class="absolute left-3">Rp</span>
              <input
                type="text"
                name="total-harga"
                id="total-harga"
                required
                readonly
                class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
                value="100.000"
              />
            </div>
          </div>

          <div class="flex flex-col gap-3">
            <label for="biaya-admin" class="text-slate-600"
              >Biaya admin kirim
              <span class="text-xs text-slate-500">(Optional)</span></label
            >
            <div class="relative flex items-center">
              <span class="absolute left-3">Rp</span>
              <input
                type="text"
                name="biaya-admin"
                id="biaya-admin"
                readonly
                class="w-full rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 pl-9 outline-none"
                value="6.500"
              />
            </div>
          </div>

          <div class="flex flex-col gap-3">
            <label for="keterangan" class="text-slate-600"
              >Keterangan
              <span class="text-xs text-slate-500">(Optional)</span></label
            >
            <textarea
              name="keterangan"
              id="keterangan"
              cols="30"
              rows="10"
              readonly
              class="rounded-md border border-slate-500 bg-[#F1F1F1] px-3 py-2 outline-none"
            >
Tadi gua belanja merek baju crocodile, fila, uniqlo,
sama zalora.

Gua beli di alamat blabla

No resinya: #21312321
          </textarea
            >
          </div>
          <div class="flex flex-col gap-3">
            <label for="upload-bukti" class="text-slate-600"
              >Bukti transfer
              <span class="text-xs text-slate-500">(Optional)</span></label
            >
            <div class="flex flex-wrap gap-3">
              <div class="w-40 bg-slate-100">
                <img
                  src="https://assets-a2.kompasiana.com/items/album/2019/05/15/20190515-042338-5cdb370875065776065e29e6.jpg?t=o&v=500"
                  alt="bukti-transfer"
                  class="h-40 w-full object-cover"
                />
                <div class="flex flex-wrap justify-end gap-3 px-2 py-4">
                  <div class="cursor-pointer hover:opacity-70" title="Delete">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 14 14"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M2.16667 4.5H11.5V12.0833C11.5 12.4055 11.2388 12.6667 10.9167 12.6667H2.75C2.42784 12.6667 2.16667 12.4055 2.16667 12.0833V4.5ZM3.33333 5.66667V11.5H10.3333V5.66667H3.33333ZM5.08333 6.83333H6.25V10.3333H5.08333V6.83333ZM7.41667 6.83333H8.58333V10.3333H7.41667V6.83333ZM3.91667 2.75V1.58333C3.91667 1.26117 4.17784 1 4.5 1H9.16667C9.48884 1 9.75 1.26117 9.75 1.58333V2.75H12.6667V3.91667H1V2.75H3.91667ZM5.08333 2.16667V2.75H8.58333V2.16667H5.08333Z"
                        fill="#FF0000"
                      />
                    </svg>
                  </div>
                  <div class="cursor-pointer hover:opacity-70" title="Download">
                    <svg
                      width="24"
                      height="24"
                      viewBox="0 0 14 14"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0.583252 8.45829C0.583252 7.10006 1.29742 5.9086 2.37074 5.23899C2.66265 2.94229 4.62392 1.16663 6.99992 1.16663C9.37589 1.16663 11.3372 2.94229 11.6291 5.23899C12.7024 5.9086 13.4166 7.10006 13.4166 8.45829C13.4166 10.4542 11.8744 12.09 9.91659 12.2389L4.08325 12.25C2.12546 12.09 0.583252 10.4542 0.583252 8.45829ZM9.82809 11.0756C11.1892 10.9721 12.2499 9.83268 12.2499 8.45829C12.2499 7.54071 11.7765 6.70608 11.0116 6.22885L10.5416 5.93561L10.4717 5.3861C10.2511 3.65048 8.76672 2.33329 6.99992 2.33329C5.2331 2.33329 3.74869 3.65048 3.52809 5.3861L3.45825 5.93561L2.98827 6.22885C2.22333 6.70608 1.74992 7.54071 1.74992 8.45829C1.74992 9.83268 2.81061 10.9721 4.17174 11.0756L4.27284 11.0833H9.727L9.82809 11.0756ZM7.58325 6.99996H9.33325L6.99992 9.91663L4.66659 6.99996H6.41659V4.66663H7.58325V6.99996Z"
                        fill="#0B6AF8"
                      />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        <!-- End Pengeluaran - Produk check -->

        <!-- <div class="flex w-full gap-4">
            <input
              type="file"
              name="upload-bukti"
              id="upload-bukti"
              disabled
              class="w-full rounded-md border border-slate-500 px-3 py-2 outline-none"
            />
            <button
              type="button"
              disabled
              class="rounded-md border border-slate-500 bg-[#f1f1f1] px-5 py-2 outline-none"
            >
              Upload
            </button>
          </div> -->
      </form>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
</body>

</html>