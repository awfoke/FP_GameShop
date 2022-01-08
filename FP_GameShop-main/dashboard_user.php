<?php
  session_start();
  if($_SESSION['status_login_user'] != true){
    echo "<script>window.location = 'login_user.php'</script>";
  }
  include 'db.php';

  function make_query($conn)
{
 $query = "SELECT * FROM tb_product ORDER BY product_id ASC";
 $result = mysqli_query($conn, $query);
 return $result;
}
function make_slide_indicators($conn)
{
 $output = ''; 
 $count = 0;
 $result = make_query($conn);
 while($banner = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <button type="button" data-bs-target="#dynamic_slide_show" data-bs-slide-to="'.$count.'" class="active"></button>
   ';
  }
  else
  {
   $output .= '
   <button type="button" data-bs-target="#dynamic_slide_show" data-bs-slide-to="'.$count.'"></button>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}
function make_slides($conn)
{
 $output = '';
 $count = 0;
 $result = make_query($conn);
 while($banner = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="carousel-item active">';
  }
  else
  {
   $output .= '<div class="carousel-item">';
  }
  $output .= '
   <img src="product/'.$banner["product_image"].'" class="d-block w-25 mx-auto" alt="'.$banner["product_name"].'" />
   <div class="carousel-caption d-none d-md-block" style="color:red">
    <h3>'.$banner["product_name"].'</h3>
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Game Shop</title>
  </head>
  <body>
    <section class="section-navbar">
        <nav class="navbar navbar-expand-lg shadow">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.html">Game Shop</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                <span></span>
                <span></span>
                <span></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="dashboard_user.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"  href="profil_user.php">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="kategori.php">Data Kategori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="produk.php">Data Produk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout_user.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <section class="section-cari-produk container-fluid">
        <div class="container p-4 bg-light rounded">
            <div class="container">
              <form>
                <div class="row justify-content-center">
                  <div class="col-6">
                    <input type="text" class="form-control" id="search" placeholder="Cari Produk">
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary btn-lg">Cari</button>
                  </div>
                </div>
              </form>
            </div>
        </div>
    </section>

    <section class="section-carousel container-fluid">
      <div class="container mt-1 p-4 bg-light rounded">
        <div class="container">
        <div id="dynamic_slide_show" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
        <?php echo make_slide_indicators($conn); ?>
        </div>
        <div class="carousel-inner">
        <?php echo make_slides($conn); ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#dynamic_slide_show" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#dynamic_slide_show" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
          </a>
        </div>
        </div>
      </div>
    </section>

    <section class="section-title container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="container text-center">
                <h1 class="display-5 fw-bold mt-3">Game Shop</h1>
                <h5 class="">Selamat Datang <?php echo $_SESSION['user_global']->user_name ?> !</h5>
            </div>
        </div>
    </section>

    <section class="section-kategori container-fluid">
        <div class="container mt-5 mb-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center">
                    <h2>Kategori Produk</h2>
                    <hr class="mx-auto">
                </div>
            </div>
        </div>
    </section>

    <section class="section-produk container-fluid">
        <div class="container mt-5 mb-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center">
                    <h2>Produk</h2>
                    <hr class="mx-auto">
                </div>
            </div>
        </div>
    </section>

    <footer class="shadow">
        <div class="container mt-5">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <p class="pt-5 fw-bold">&copy; Copyright 2021</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>