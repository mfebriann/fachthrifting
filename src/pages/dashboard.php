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
  $query = mysqli_query($conn, "SELECT `transaction`, `message`, `author`, `status`, `stok`, `category`, `resi`, `total_price`, `admin_fee`,  `datetime`  FROM `transactions` ORDER BY transaction DESC LIMIT 0, 10");
  $transactions = [];
  while ($row = mysqli_fetch_assoc($query)) {
    $transactions[] = $row;
  }
  $no = 1;
  ?>
  <main class="mt-20 px-4">
    <section class="container mx-auto">
      <h1 class="text-3xl font-semibold text-slate-700 mb-4">Dashboard</h1>
      <div class="overflow-auto">
        <canvas id="myChart" style="max-height: 512px"></canvas>
      </div>

      <h2 class="mt-10 text-2xl font-semibold text-slate-700">
        10 Data Transaksi Terbaru
      </h2>
      <div class="mt-5 overflow-auto">
        <table cellpadding="10" class="w-full text-center">
          <thead>
            <tr class="whitespace-nowrap">
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                No
              </th>
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Tanggal
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
              <th class="border border-white bg-blue-600 px-4 py-3 text-center font-semibold text-white">
                Aksi
              </th>
            </tr>
          </thead>
          <tbody class="[&>*:nth-child(even)]:bg-white [&>*:nth-child(odd)]:bg-slate-100">
            <?php foreach ($transactions as $transaction): ?>
              <tr>
                <?php
                $date = date("d/m/Y", strtotime($transaction['datetime']));
                ?>
                <td class="text-center">
                  <?= $no ?>
                </td>
                <td>
                  <?= $date ?>
                </td>
                <td class="text-left">
                  <?= $transaction['author'] ?>
                </td>
                <td class="text-left">
                  <?= $transaction['message'] ?>
                </td>
                <td>
                  <?= !$transaction['resi'] ? '-' : $transaction['resi'] ?>
                </td>
                <td>
                  Rp.
                  <?= number_format($transaction['total_price']) ?>
                </td>
                <td>
                  Rp.
                  <?= number_format($transaction['admin_fee']) ?>
                </td>
                <td>
                  <?= !$transaction['stok'] ? '-' : $transaction['stok'] ?>
                </td>
                <td class="capitalize">
                  <?= !$transaction['category'] ? '-' : $transaction['category'] ?>
                </td>
                <td
                  class="font-medium capitalize <?= $transaction['status'] === 'pemasukkan' ? 'text-green-500' : 'text-red-500' ?>">
                  <?= $transaction['status'] ?>
                </td>
                <td class="flex justify-center">
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
                    <a href="edit-transactions.php?id=<?= $transaction['transaction'] ?>"
                      class="block w-max cursor-pointer rounded-md bg-green-600 p-2 hover:opacity-75">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                        fill="rgba(255,255,255,1)">
                        <path
                          d="M12.8995 6.85453L17.1421 11.0972L7.24264 20.9967H3V16.754L12.8995 6.85453ZM14.3137 5.44032L16.435 3.319C16.8256 2.92848 17.4587 2.92848 17.8492 3.319L20.6777 6.14743C21.0682 6.53795 21.0682 7.17112 20.6777 7.56164L18.5563 9.68296L14.3137 5.44032Z">
                        </path>
                      </svg>
                    </a>
                    <a href="delete.php" class="block w-max cursor-pointer rounded-md bg-red-600 p-2 hover:opacity-75">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16" height="16"
                        fill="rgba(255,255,255,1)">
                        <path
                          d="M4 8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8ZM7 5V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V5H22V7H2V5H7ZM9 4V5H15V4H9ZM9 12V18H11V12H9ZM13 12V18H15V12H13Z">
                        </path>
                      </svg>
                    </a>
                  </div>
                </td>

              </tr>
              <?php $no++; ?>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>
  </main>
  <?php include '../components/footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../script/app.js"></script>
  <script>
    const ctx = document.getElementById("myChart");

    new Chart(ctx, {
      type: "bar",
      data: {
        labels: [
          "Jan",
          "Feb",
          "Mar",
          "Apr",
          "Mei",
          "Jun",
          "Jul",
          "Aug",
          "Sep",
          "Oct",
          "Nov",
          "Dec",
        ],
        label: ["Pengeluaran", "Pendapatan"],
        datasets: [
          {
            borderWidth: 1,
            label: "Total Produk Masuk",
            data: [65, 59, 80, 81, 56, 55, 40, 10, 11, 2, 4, 2],
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            borderColor: "rgb(54, 162, 235)",
          },
          {
            borderWidth: 1,
            label: "Total Produk Terjual",
            data: [11, 4, 21, 30, 52, 50, 20, 10, 2, 4, 2, 10],
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgb(75, 192, 192)",
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  </script>
</body>

</html>