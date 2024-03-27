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
  if (isset($_GET['date'])) {
    $date = $_GET['date'];
    $query = mysqli_query($conn, "SELECT `transaction`, `message`, `author`, `status`, `stok`, `category`, `resi`, `total_price`, `admin_fee`, `datetransaction` FROM `transactions` WHERE DATE_FORMAT(`datetime`, '%Y-%m') = '$date' ORDER BY `datetransaction` DESC");
  } else {
    $query = mysqli_query($conn, "SELECT `transaction`, `message`, `author`, `status`, `stok`, `category`, `resi`, `total_price`, `admin_fee`, `datetransaction`  FROM `transactions` ORDER BY `datetransaction` DESC");
  }

  $transactions = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $transactions[] = $row;
  }
  $no = 1;

  $queryTotalDanaKeluar = mysqli_query($conn, "SELECT SUM(total_price) as totalPrice, SUM(admin_fee) as adminFee FROM `transactions` WHERE status = 'pengeluaran'");
  $totalDanaKeluar = mysqli_fetch_assoc($queryTotalDanaKeluar);

  $totalPrice = $totalDanaKeluar['totalPrice'] ?? 0;
  $totalAdminFee = $totalDanaKeluar['adminFee'] ?? 0;

  $queryTotalDanaMasuk = mysqli_query($conn, "SELECT SUM(total_price) as totalPrice FROM `transactions` WHERE status = 'pemasukkan'");
  $totalDanaMasuk = mysqli_fetch_assoc($queryTotalDanaMasuk)['totalPrice'] ?? 0;
  ?>

  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <div class="flex flex-wrap items-center justify-between gap-3">
        <h1 class="text-2xl font-semibold text-slate-700">Riwayat Transaksi</h1>
        <a href="#" class="text-blue-500 underline hover:opacity-50" onclick="history.back()">Kembali</a>
      </div>
      <div class="mt-5 flex flex-col gap-3">
        <div class="bg-purple-600 rounded-md text-white p-4 h-36">
          <div class="flex justify-between flex-wrap gap-2">
            <p class="font-semibold">Total Saldo Sekarang</p>
            <p class="text-sm font-bold">
              <?= $totalDanaMasuk === ($totalPrice + $totalAdminFee) ? '' : ($totalDanaMasuk > ($totalPrice + $totalAdminFee) ? 'Yeay kita untung 😍' : 'Kita lagi rugi nih 😭') ?>
            </p>
          </div>
          <p class="text-3xl font-bold mt-2">Rp
            <?= number_format($totalDanaMasuk - ($totalPrice + $totalAdminFee)) ?>
          </p>
        </div>
        <div class="bg-green-500 rounded-md text-white p-4 h-36">
          <p class="font-semibold">Total Dana Masuk</p>
          <p class="text-3xl font-bold mt-2">Rp
            <?= number_format($totalDanaMasuk) ?>
          </p>
        </div>
        <div class="bg-red-500 rounded-md text-white p-4 h-36">
          <p class="font-semibold">Total Dana Keluar</p>
          <p class="text-3xl font-bold mt-2">Rp
            <?= number_format($totalPrice) ?>
          </p>
          <p class="mt-4 text-sm ">Total biaya admin: <span class="font-semibold">Rp
              <?= number_format($totalAdminFee) ?>
            </span>
          </p>
        </div>
      </div>

      <div class="mt-14 overflow-auto">
        <div
          class="flex flex-col-reverse sm:flex-row items-center justify-between gap-3 flex-wrap mb-2 <?= $role === 'user' ? 'sm:justify-end' : '' ?>">
          <?php if ($role !== 'user'): ?>
            <a href="new-transactions.php"
              class="block bg-green-600 hover:bg-green-500 text-white font-semibold w-full px-4 py-3 rounded-md sm:w-max text-center text-sm sm:text-base ">Tambah
              Transaksi Baru</a>
          <?php endif ?>
          <div class="flex items-center flex-col-reverse gap-3 w-full sm:flex-row sm:w-max">
            <a href="./transactions.php" class="text-red-600 underline text-sm">Hapus Filter</a>
            <input type="month" id="date" class="border-blue-600 border px-4 rounded py-2 w-full sm:w-max" name="date"
              value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
          </div>
        </div>
        <div class="mt-5 overflow-auto">
          <table cellpadding="10" class="w-full" id="transactions">
            <thead>
              <tr class="whitespace-nowrap">
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  No
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Aksi
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Tanggal Transaksi
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Nama Pembuat
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Nama Transaksi
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Resi
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Harga
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Biaya Admin
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Stok
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Kategori
                </th>
                <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                  Status
                </th>
              </tr>
            </thead>
            <tbody class="[&>*:nth-child(even)]:bg-white [&>*:nth-child(odd)]:bg-slate-100">
              <?php foreach ($transactions as $transaction): ?>
                <tr>
                  <?php
                  $dateTransaction = !$transaction['datetransaction'] ? '-' : date("d/m/Y", strtotime($transaction['datetransaction']));
                  ?>
                  <td class="text-center">
                    <?= $no ?>
                  </td>
                  <td class="text-center flex justify-center">
                    <div class="flex gap-2">
                      <a href="view-transactions.php?id=<?= $transaction['transaction'] ?>"
                        class="block w-max cursor-pointer rounded-md bg-blue-600 p-2 hover:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                          fill="rgba(255,255,255,1)">
                          <path
                            d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z">
                          </path>
                        </svg>
                      </a>
                      <?php if ($role !== 'user'): ?>
                        <a href="edit-transactions.php?id=<?= $transaction['transaction'] ?>"
                          class="block w-max cursor-pointer rounded-md bg-green-600 p-2 hover:opacity-75">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                            fill="rgba(255,255,255,1)">
                            <path
                              d="M12.8995 6.85453L17.1421 11.0972L7.24264 20.9967H3V16.754L12.8995 6.85453ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z">
                            </path>
                          </svg>
                        </a>
                        <div
                          class="block w-max cursor-pointer rounded-md bg-red-600 p-2 hover:opacity-75 btn-delete-transaction"
                          id="<?= $transaction['transaction'] ?>">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                            fill="rgba(255,255,255,1)">
                            <path
                              d="M4 8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8ZM7 5V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V5H22V7H2V5H7ZM9 4V5H15V4H9ZM9 12V18H11V12H9ZM13 12V18H15V12H13Z">
                            </path>
                          </svg>
                        </div>
                      <?php endif; ?>
                    </div>
                  </td>
                  <td>
                    <?= $dateTransaction ?>
                  </td>
                  <td class="text-left" data-username="<?= $username ?>">
                    <?= $transaction['author'] ?>
                  </td>
                  <td class="text-left">
                    <?= $transaction['message'] ?>
                  </td>
                  <td>
                    <?= !$transaction['resi'] ? '-' : $transaction['resi'] ?>
                  </td>
                  <td>
                    <?= 'Rp. ' . number_format($transaction['total_price']) ?>
                  </td>
                  <td>

                    <?= 'Rp. ' . number_format($transaction['admin_fee']) ?>
                  </td>
                  <td>
                    <?= $transaction['stok'] === NULL ? '-' : ($transaction['stok'] === 0 ? 0 : $transaction['stok']) ?>
                  </td>
                  <td class="capitalize">
                    <?= !$transaction['category'] ? '-' : str_replace('-', ' ', $transaction['category']) ?>
                  </td>
                  <td
                    class="font-medium capitalize <?= $transaction['status'] === 'pemasukkan' ? 'text-green-500' : 'text-red-500' ?>">
                    <?= $transaction['status'] ?>
                  </td>
                </tr>
                <?php $no++; ?>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </section>
  </main>
  <?php include '../components/footer.php' ?>


  <script src="../script/app.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>
  <script>
    // https://datatables.net/reference/button/excelHtml5#Built-in-styles
    const sizeParamaters = new URLSearchParams(window.location.search).size;
    const currentMonthAndYear = new URLSearchParams(window.location.search).get('date');

    new DataTable('#transactions', {
      pageLength: 100,
      ordering: false,
      layout: {
        topStart: {
          buttons: [
            {
              filename: sizeParamaters === 0 ? 'Laporan-Transaksi' : `Laporan-Transaksi_${currentMonthAndYear}`,
              title: sizeParamaters === 0 ? 'Laporan Transaksi Fach Thrifting' : `Laporan Transaksi Fach Thrifting - ${currentMonthAndYear}`,
              extend: 'pdfHtml5',
              exportOptions: {
                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
              },
            },
            {
              filename: sizeParamaters === 0 ? 'Laporan-Transaksi' : `Laporan-Transaksi_${currentMonthAndYear}`,
              title: sizeParamaters === 0 ? 'Laporan Transaksi Fach Thrifting' : `Laporan Transaksi Fach Thrifting - ${currentMonthAndYear}`,
              extend: 'excelHtml5',
              exportOptions: {
                columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10]
              },
              exportStyles: {
                cssStyles: ['red_highlight', 'yellow_highlight'],
                excelStyles: [5, 11]
              },
              customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];

                $('row:not(:first, :nth-child(2)) c[r^="A"], row:not(:first, :nth-child(2)) c[r^="H"]', sheet).each(function () {
                  $(this).attr('s', '50');
                });

                $('row c[r^="D"]', sheet).each(function () {
                  $(this).attr('s', '2');
                });

                $('row:not(:nth-child(2)) c[r^="J"]', sheet).each(function () {
                  if ($(this).text() === 'pengeluaran') {
                    $(this).attr('s', '37');
                  } else {
                    $(this).attr('s', '17');
                  }
                });
              }
            },
          ],
        }
      }
    });


    const filterDate = document.getElementById('date');
    filterDate.addEventListener('change', ({ target }) => {
      window.location.href = `?date=${target.value}`;
    })

    const btnDeleteTransactions = document.querySelectorAll('.btn-delete-transaction');
    btnDeleteTransactions.forEach((btnDeleteTransaction) => {
      btnDeleteTransaction.addEventListener('click', () => {
        const idTransaction = btnDeleteTransaction.id;

        Swal.fire({
          title: "Apa kamu yakin mau menghapus?",
          text: "Kamu data transaksi ini?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Iya, hapus saja!",
        }).then(function (action) {
          if (action.isConfirmed) {
            $.ajax({
              url: "../utils/functions.php",
              type: "post",
              data: {
                action: "delTransaction",
                idTransaction,
              },
              success: function (response) {
                console.log(response);
                const jsonResponse = JSON.parse(response);
                if (jsonResponse["success"] == "success") {
                  Swal.fire("Deleted!", "Transaksi kamu berhasil dihapus!", "success").then(() => {
                    window.location.reload();
                  });
                }
              },
            });
          }
        });
      })
    })
  </script>
</body>

</html>