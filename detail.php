<?php
  require "koneksi.php";

  session_start();

  if(isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "SELECT * FROM produk WHERE id = ?";
    $result = $connection->prepare($sql);
    $result->execute([$id]);
    $data = $result->fetch(PDO::FETCH_ASSOC);

    if($data) {
      $id = $data["id"];
      $nama = $data["nama"];
      $deskripsi = $data["deskripsi"];
      $harga = $data["harga"];
      $gambar = $data["gambar"];
    }
  }
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Detail Produk Djogja Publisher</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <style>
    .bg-nav {
      background-color: rgb(240, 240, 240);
    }
    .product-card {
      background-color: #f8f9fa;
      border: 1px solid #ddd;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    .product-image {
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
    .product-details {
      margin-top: 20px;
    }
    .product-price {
      font-size: 1.5em;
      color: #333;
    }
    .product-description {
      margin-top: 20px;
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

  <div class="container product-details">
    <div class="card product-card">
      <div class="row">
        <div class="col-md-6">
          <a href="<?php echo $data["gambar"]; ?>" target="_blank"><img src="<?php echo $data["gambar"]; ?>" alt="Gambar Produk" class="product-image"></a>
        </div>
        <div class="col-md-6">
          <div class="card-body">
            <h2 class="card-title"><?php echo $data["nama"]; ?></h2>
            <p class="product-price">Rp. <?php echo number_format($data["harga"], 2, ',', '.'); ?></p>
            <p class="product-description">
              <?php echo $data["deskripsi"]; ?>
            </p>
            <a href="buy.php?id=<?php echo $data["id"]; ?>" class="btn btn-primary">Beli</a>
            <a href="dashboard.php" class="btn btn-secondary">Batal</a>
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
