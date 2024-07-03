<?php
  session_start();
  require "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Djogja Publisher</title>
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
        <form class="form-inline my-2 my-lg-0" method="post" name="cari" action="dashboard.php">
          <div class="input-group">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Cari" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-primary" type="submit" name="cari"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <!-- Profile Button -->
          <div class="nav-item dropdown">
            <button class="btn btn-outline-primary ml-2 ml-lg-3 nav-link dropdown-toggle" type="button" id="navbarScrollingDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <?php echo $_SESSION['userUsername']; ?>
            </button>
            <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
              <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
            </ul>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <div class="container-fluid mt-4">
    <h2 class="mt-1 mb-4 text-center">Daftar Produk</h2>
    <div class="container-fluid">
      <div class="row">
        <?php
        if(isset($_POST['cari'])){
          $search = $_POST['search'];
          $sql = "SELECT * FROM produk WHERE nama LIKE '%$search%'";
          $result = $connection->prepare($sql);
          $result->execute();
          $data = $result->fetchAll();
          foreach($data as $row){
            echo '<div class="col-lg-3 mb-4">
                    <div class="card h-100">
                      <img class="card-img-top" src="'. $row['gambar'] .'" alt="Product Image" style="height: 200px; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title">'. $row['nama'] .'</h5>
                        <p class="card-text">'. $row['deskripsi'] .'</p>
                        <h6 class="card-subtitle mb-4 text-muted">Harga: Rp. '. number_format($row['harga'], 2, ',', '.') .'</h6>
                        <div class="d-flex justify-content-center">
                          <a href="detail.php?id='. $row['id'] .'" type="button" class="btn btn-primary w-75 rounded">Buy Now</a>
                        </div>
                        </div>
                    </div>
                  </div>';
          }
        }else{
          $sql = "SELECT * FROM produk";
          $result = $connection->prepare($sql);
          $result->execute();
          $data = $result->fetchAll();
          foreach($data as $row){
            echo '<div class="col-lg-3 mb-4">
                    <div class="card h-100">
                      <img class="card-img-top" src="'. $row['gambar'] .'" alt="Product Image" style="height: 200px; object-fit: cover;">
                      <div class="card-body">
                        <h5 class="card-title">'. $row['nama'] .'</h5>
                        <p class="card-text">'. $row['deskripsi'] .'</p>
                        <h6 class="card-subtitle mb-4 text-muted">Harga: Rp. '. number_format($row['harga'], 2, ',', '.') .'</h6>
                        <div class="d-flex justify-content-center">
                          <a href="detail.php?id='. $row['id'] .'" type="button" class="btn btn-primary w-75 rounded">Buy Now</a>
                        </div>
                        </div>
                    </div>
                  </div>';
          }
        }
        ?>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
