<?php
  session_start();
  include 'db.php';

  if($_SESSION['status_login_admin'] != true){
    echo "<script>window.location = 'login_admin.php'</script>";
  }
  
  $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['admin_id']."'");
  $user = mysqli_fetch_object($query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Profil Admin | Game Shop</title>
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
                    <a class="nav-link" href="dashboard_admin.php">Dashboard</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page"  href="profil_admin.php">Profil</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="category.php">Data Kategori</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="product.php">Data Produk</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="logout_admin.php">Keluar</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <section class="section-title container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="container text-center">
                <img src="avatar.jpg" alt="" class="img-header rounded-circle">
                <h1 class="fw-bold mt-3"><?php echo $_SESSION['admin_global']->admin_name?></h1>
                <h5 class="mt-3"><?php echo $_SESSION['admin_global']->admin_email?></h5>
            </div>
        </div>
    </section>

    <section class="section-profil container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center mb-3">
                    <h2>Profil</h2>
                    <hr class="mx-auto">
                </div>
            </div>
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="full_name" class="form-control" id="full_name" value="<?php echo $_SESSION['admin_global']->admin_name?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" value="<?php echo $_SESSION['admin_global']->username?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">No Telepon</label>
                        <input type="number" name="telp" class="form-control" id="telp" value="<?php echo $_SESSION['admin_global']->admin_telp?>" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" id="email" value="<?php echo $_SESSION['admin_global']->admin_email?>" required>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Address</label>
                        <input type="text" name="address" class="form-control" id="address" value="<?php echo $_SESSION['admin_global']->admin_address?>" required>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="ubah_profil" class="btn btn-primary">Ubah Profil</button>
                </div>
            </form>
            <?php
                if(isset($_POST['ubah_profil'])){

                    $full_name = ucwords($_POST['full_name']);
                    $username = strtolower($_POST['username']);
                    $admin_telp = $_POST['telp'];
                    $admin_email = strtolower($_POST['email']);
                    $admin_address = ucwords($_POST['address']);

                    $update = mysqli_query($conn, "UPDATE tb_admin SET
                                    admin_name = '".$full_name."',
                                    username = '".$username."',
                                    admin_telp = '".$admin_telp."',
                                    admin_email = '".$admin_email."',
                                    admin_address = '".$admin_address."'
                                    WHERE admin_id = '".$admin->admin_id."'");
                    if($update){
                        echo "<script>alert('Ubah Profil Berhasil')</script>";
                        echo "<script>window.location = 'profil_admin.php'</script>";
                    }
                    else{
                        echo "<script>alert('Ubah Profil Gagal')</script>".mysqli_error($conn);
                    }
                }
            ?>
        </div>
    </section>

    <section class="section-ubahpassword container-fluid">
        <div class="container mt-5 p-4 bg-light rounded">
            <div class="row">
                <div class="col text-center mb-3">
                    <h2>Ubah Password</h2>
                    <hr class="mx-auto">
                </div>
            </div>
            <form action="" method="POST">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="re_password" class="form-control" id="re_password" required>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" name="ubah_password" class="btn btn-primary">Ubah Password</button>
                </div>
            </form>
            <?php
                if(isset($_POST['ubah_password'])){

                    $password = $_POST['password'];
                    $re_password = $_POST['re_password'];

                    if($password != $re_password){
                        echo "<script>alert('Password Harus Sama')</script>";
                    }else{
                        $update_password = mysqli_query($conn, "UPDATE tb_admin SET
                                                password = '".MD5($password)."'
                                                WHERE admin_id = '".$admin->admin_id."'");
                        if($update_password){
                            echo "<script>alert('Ubah Password Berhasil')</script>";
                            echo "<script>window.location = 'profil_admin.php'</script>";
                        }else{
                            echo "<script>alert('Ubah Password Gagal')</script>".mysqli_error($conn);
                        }
                    }
                }
            ?>
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