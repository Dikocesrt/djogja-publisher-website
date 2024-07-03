<?php
  session_start();
  require 'koneksi.php';

  if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM produk WHERE id = ?";
    $result = $connection->prepare($sql);
    $result->execute([$id]);
    $data = $result->fetch(PDO::FETCH_ASSOC);
  }
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pembayaran Djogja Publisher</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .bg-nav {
      background-color: rgb(240, 240, 240);
    }
    .payment-card {
      background-color: #f8f9fa; /* Warna card yang berbeda */
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-top: 20px;
    }
    .product-card {
      background-color: #fff;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      margin-top: 20px;
    }
    .product-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    .product-title {
      font-size: 1.5em;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .product-price {
      font-size: 1.2em;
      color: #333;
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
        </ul>
          <!-- Tombol Profil -->
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

  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="card payment-card">
          <h2 class="card-title">Pembayaran</h2>
          <form method="POST" enctype="multipart/form-data" action="proses-bayar.php">
            <div class="form-group">
              <label for="jumlah" class="form-label">Jumlah Produk</label>
              <input type="number" class="form-control" id="jumlah" name="jumlah" placeholder="Masukkan jumlah produk" required />
            </div>
            <div class="form-group">
              <label for="catatan" class="form-label">Catatan</label>
              <input type="text" class="form-control" id="catatan" name="catatan" placeholder="Masukkan catatan" required />
            </div>
            <div class="form-group">
              <label for="alamat" class="form-label">Alamat</label>
              <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan alamat" required />
            </div>
            <div class="form-group">
              <label for="telepon" class="form-label">Nomor Telepon (Nomor Whatsapp)</label>
              <input type="number" class="form-control" id="telepon" name="telepon" placeholder="Masukkan nomor telepon" required />
            </div>
            <div class="form-group">
              <label for="metode" class="form-label">Metode Pembayaran</label>
              <input type="text" class="form-control" id="metode" name="metode" placeholder="Masukkan metode pembayaran" required />
            </div>
            <div class="form-group">
              <label for="bank_tujuan" class="form-label">Bank Tujuan</label>
              <select class="form-control" id="bank_tujuan" name="bank_tujuan" required >
                <option value="MANDIRI">MANDIRI - 1232435345 - DONNY TRIANTO</option>
                <option value="BCA">BCA - 234353534534 - DONNY TRIANTO</option>
                <option value="BRI">BRI - 32432483345 - DONNY TRIANTO</option>
              </select>
            </div>
            <div class="form-group">
              <label for="gambar" class="form-label">Bukti Transfer</label>
              <input class="form-control" type="file" id="gambar" name="gambar" placeholder="Masukkan Bukti" required />
            </div>
            <input type="hidden" name="userId" value="<?php echo $_SESSION['userId']; ?>" />
            <input type="hidden" name="produkId" value="<?php echo $data["id"]; ?>" />
            <input type="hidden" name="produkHarga" value="<?php echo $data["harga"]; ?>" />
            <button type="submit" name="submit" class="btn btn-primary payment-button">Bayar Sekarang</button>
            <a href="detail.php?id=<?php echo $data["id"]; ?>" class="btn btn-secondary">Batal</a>
          </form>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card product-card">
          <a href="<?php echo $data["gambar"]; ?>" target="_blank"><img src="<?php echo $data["gambar"]; ?>" alt="Gambar Produk" class="product-image"></a>
          <div class="card-body">
            <h5 class="product-title"><?php echo $data["nama"]; ?></h5>
            <p class="product-price">Rp. <?php echo number_format($data["harga"], 2, ',', '.'); ?></p>
            <p class="product-description"></p>
              <?php echo $data["deskripsi"]; ?>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
