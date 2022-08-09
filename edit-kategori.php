<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    include 'db.php'; //menginput db_php agara querynya berjalan
    if($_SESSION['status_login'] != true){ //jika setatus login itu tdk sama dengan true
        echo '<script>window.location="login.php"</script>'; //maka akan di arahkan ke login
    }
    //selek form
    $kategori = mysqli_query($conn, "SELECT * FROM tb_kategory WHERE kategory_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori) ==0){ //jika tidak ada datanya 
        echo '<script>window.location="data-kategori.php"</script>'; //maka akan di arahkan ke data kategory
    }
    $k = mysqli_fetch_object($kategori);
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
            <h1><a href="dasboard.php">Profile</a></h1>
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
            <h3>Edit Data Kategori</h3>
            <div class="box" >
                
                <form action="" method="POST"> <!--value > untuk menampilkan masing masing tabel -->
                    <input type="text" name ="nama" placeholder="Nama Kaegori" class="input-control" value="<?php echo $k->kategory_name ?>"
                     required> 
                    <input type="submit" name="submit" value=" submit" class="btn">
                </form>
            <?php 
                if(isset($_POST['submit'])){

                    $nama = ucwords($_POST['nama']);

                    $update = mysqli_query($conn, "UPDATE tb_kategory SET 
                                        kategory_name = '".$nama."' 
                                        WHERE kategory_id = '".$k->kategory_id."' ");

                        if($update){
                            echo '<script>alert("Edit Data Berhasil")</script>'; //memeberikan notif
                            echo '<script>window.location="data-kategori.php"</script>'; //ketika di submit di arahkan ke data kategori
                        }else{
                            echo 'gagal' .mysqli_error($conn);
                        }
                }
            ?>
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