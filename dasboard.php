
<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    if($_SESSION['status_login'] != true){ //jika setatus login itu tdk sama dengan true
        echo '<script>window.location="login.php"</script>'; //maka akan di arahkan ke login
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login | bukawarung</title>
    <link rel="stylesheet" type="text/css" href="CSS/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">


</head>
<body>
    <!--header-->
    <header id= "header">
        <div class="container">
            <h1><a href="dasboard.php">bukawarung</a></h1>
            <ul>
                <li><a href="dasboard.php">Dasboard</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Dasboard</h3>
            <div class="box" >
                <h4>Selamat Datang 
                    <?php echo $_SESSION['a_global']->admin_name ?> di Toko Online 
                </h4>
            </div>
        </div>
    </div>

    
    <!--footer-->
    <footer>
        <div class="container">
            <small>Copyright &copy; 2020 - Bukawarung</small>
        </div>
    </footer>
</body>
</html>