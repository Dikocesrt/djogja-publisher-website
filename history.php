<?php
  require "koneksi.php";

  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Transaksi Djogja Publisher</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        @media (max-width: 576px) {
          .navbar-brand {
            position: static;
            transform: none;
          }
        }
        .bg-nav {
          background-color: rgb(240, 240, 240);
        }
      </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-nav">
        <div class="container">
          <a class="navbar-brand" href="dashboard.php">Djogja Publisher</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-between" id="navbarScroll">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="dashboard.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="history.php">History</a>
              </li>
            </ul>
              <!-- Profile Button -->
              <div class="nav-item dropdown">
                <button class="btn btn-outline-primary ml-2 ml-lg-3 nav-link dropdown-toggle" type="button" id="navbarScrollingDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $_SESSION['userUsername']; ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                </ul>
              </div>
          </div>
        </div>
      </nav>

        <div class="container-fluid mt-4">
            <h2 class="mt-1 mb-4 text-center">History Transaksi</h2>
            <div class="container-fluid">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">ID</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Nama Produk</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Jumlah Pesanan</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Total Harga</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Catatan</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Nomor WA</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Metode Bayar</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Bank Tujuan</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Tanggal Transaksi</p></th>
                                <th scope="col"><p class="text-secondary text-center fw-bold mb-0">Bukti Transfer</p></th>
                            </tr>
                        </thead>
                        <tbody>
                          <?php
                            $sql = "SELECT 
                                pesanan.id AS pesanan_id,
                                pesanan.user_id,
                                pesanan.produk_id,
                                produk.nama AS nama_produk,
                                pesanan.jumlah,
                                pesanan.total_harga,
                                pesanan.catatan,
                                pesanan.metode,
                                pesanan.bank_tujuan,
                                pesanan.nomor_wa,
                                pesanan.bukti,
                                pesanan.tanggal AS tanggal_pesanan
                            FROM 
                                pesanan
                            LEFT JOIN 
                                produk ON pesanan.produk_id = produk.id";

                            $result = $connection->prepare($sql);
                            $result->execute();
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                              echo '<tr class="text-center">
                                <th scope="row" style="vertical-align: middle;"><p class="text-secondary fw-bold mb-0">'. $row['pesanan_id'] .'</p></th>
                                <td style="vertical-align: middle;">'. $row['nama_produk'] .'</td>
                                <td style="vertical-align: middle;">'. $row['jumlah'] .'</td>
                                <td style="vertical-align: middle;">Rp. '. number_format($row['total_harga'], 2, ',', '.').'</td>
                                <td style="vertical-align: middle;">'. $row['catatan'] .'</td>
                                <td style="vertical-align: middle;">'. $row['nomor_wa'] .'</td>
                                <td style="vertical-align: middle;">'. $row['metode'] .'</td>
                                <td style="vertical-align: middle;">'. $row['bank_tujuan'].'</td>
                                <td style="vertical-align: middle;">'. $row['tanggal_pesanan'] .'</td>
                                <td style="vertical-align: middle;"><a href=" '. $row['bukti'] . '" target="_blank"><img src="'. $row['bukti'] . '" alt="gambar" width="100"></a></td>
                            </tr>';
                            }
                          ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>