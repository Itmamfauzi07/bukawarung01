<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    include 'db.php'; //menginput db_php agara querynya berjalan
    if($_SESSION['status_login'] != true){ //jika setatus login itu tdk sama dengan true
        echo '<script>window.location="login.php"</script>'; //maka akan di arahkan ke login
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE admin_id = '".$_SESSION['id']."' ");
    $d = mysqli_fetch_object($query);

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
            <h3>Profile</h3>
            <div class="box" >
                
                <form action="" method="POST"> <!--value > untuk menampilkan masing masing tabel -->
                    <input type="text" name="nama" placeholder="Nama Lengkap" class="input-control" value="<?php echo $d->admin_name ?>" required> 
                    <input type="text" name="user" placeholder="Username" class="input-control"value="<?php echo $d->username ?>"  required>
                    <input type="text" name="hp" placeholder="No Hp" class="input-control" value="<?php echo $d->admin_telp?>" required>
                    <input type="text" name="email" placeholder="Email" class="input-control" value="<?php echo $d->admin_email?>" required>
                    <input type="text" name="alamat" placeholder="Alamat" class="input-control" value="<?php echo $d->admin_adress ?>" required>
                    <input type="submit" name="submit" value="Ubah Profile" class="btn">
                </form>
                    <?php
                        if(isset($_POST['submit'])){  //ketika submit di tekan maka melakukan proses sub data
                            $nama   = ucwords($_POST['nama']);   //untuk menampung inputan yang ada di tabel admin //ucwords yaitu untuk memberikan tulisan awalnya kapital
                            $user   = $_POST['user'];
                            $hp     = $_POST['hp'];
                            $email  = $_POST['email'];
                            $alamat = ucwords($_POST['alamat']);

                            $update  = mysqli_query($conn, "UPDATE tb_admin SET
                                                    admin_name = '".$nama."',
                                                    username = '".$user."',
                                                    admin_telp = '".$hp."',
                                                    admin_email = '".$email."',
                                                    admin_adress = '".$alamat."'
                                                    WHERE admin_id = '".$d->admin_id."' ");
                                                    if($update){  //jika variabel update berhasil
                                                        echo '<script>alert("Ubah Data Berhasil")</script>'; //maka refresh secara otomatis dan menampilkan berhasil
                                                        echo '<script>window.location="profile.php"</script>';
                                                    }else{  //jika gagal 
                                                        echo'gagal' .mysqli_error($conn); //maka tampilkan gagal dan erornya dimana
                                                    }
                        }
                    ?>
            </div>
            <h3>Ubah Password</h3>
            <div class="box" >
                
                <form action="" method="POST"> <!--value > untuk menampilkan masing masing tabel -->
                    <input type="password" name="pass1" placeholder="Password Baru " class="input-control"  required> 
                    <input type="password" name="pass2" placeholder="Konfirmasi Password" class="input-control"  required> 
                    <input type="submit" name="ubah_password" value="Ubah Password" class="btn">
                </form>
                    <?php
                        if(isset($_POST['ubah_password'])){  //ketika submit di tekan maka melakukan proses sub data //proses ubah password
                            $pass1   = $_POST['pass1'];   //untuk menampung inputan yang ada di tabel admin //ucwords yaitu untuk memberikan tulisan awalnya kapital
                            $pass2   = $_POST['pass2'];
                              
                            if($pass2 != $pass1){  //jika pass2 tidak sama dengan pass1
                                echo '<script>alert("Konfirmasi Password Baru tidak sesuai")</script>';

                                }else{ //jika sudah sesuai maka lakukan proses update

                                     $u_pass  = mysqli_query($conn, "UPDATE tb_admin SET
                                                password = '".MD5($pass1)."' 
                                                WHERE admin_id = '".$d->admin_id."' "); //password din andkripsi menjadi md5
                                            if($u_pass){ //jika variabel U_PASS berhasil
                                                echo '<script>alert("Ubah Data Berhasil")</script>'; //maka refresh secara otomatis dan menampilkan berhasil
                                                echo '<script>window.location="profile.php"</script>';
                                            }else{
                                                echo 'gagal' .mysqli_error($conn); //maka tampilkan gagal dan erornya dimana
                                    }
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