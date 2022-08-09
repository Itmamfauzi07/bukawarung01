<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    include 'db.php'; //menginput db_php agara querynya berjalan
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
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>


</head>
<body>
    <!--header-->
    <header id= "header">
        <div class="container">
            <h1><a href="dasboard.php">Profile</a></h1>
            <ul>
                <li><a href="dasboard.php">Dasboard</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="data-kategori.php">Data Kategory</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Tambah Data Produk</h3>
            <div class="box" >
                
                <form action="" method="POST" enctype="multipart/form-data"> <!--value > untuk menampilkan masing masing tabel -->
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategory ORDER BY kategory_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                            <option value="<?php echo $r['kategory_id'] ?>"><?php echo $r['kategory_name'] ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                    <input type="text" name="harga" class="input-control" placeholder=" Harga" required>
                    <input type="file" name="gambar" class="input-control" required>
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea> <br>
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1">Aktif</option>
                        <option value="0">Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value=" submit" class="btn">
                </form>
            <?php 
                if(isset($_POST['submit'])){

                   // print_r($_FILES ['gambar']);
                   //menampung infutan dari form
                    $kategori   = $_POST['kategori']; 
                    $nama       = $_POST['nama']; 
                    $harga      = $_POST['harga']; 
                    $deskripsi  = $_POST['deskripsi']; 
                    $status     = $_POST['status']; 

                   //menampung data file yg di uupload

                   $filename = $_FILES['gambar']['name'];
                   $tmp_name = $_FILES['gambar']['tmp_name'];

                   $type1 = explode('.', $filename);
                   $type2 = $type1[1];

                   $newname = 'produk' .time(). '.'.$type2;
                   //menampung data  format file yang di izinkan
                    $tipe_diizinkan = array('jpg','jpeg','png', 'gif');
                   //validasi format file

                   if(!in_array($type2, $tipe_diizinkan)){ //jika upload file tida ada dlm aarai/(jpg,png dll maka tidak diizinkan)
                        echo '<script>alert("Format File Tidak di Izinkan")</script>' ;

                   }else{  //tetapi jika sesuai arrray maka berhasil upload
                             //proses upload file sekaligus insert ke database
                        move_uploaded_file($tmp_name, './produk/' .$newname);
                        $insert = mysqli_query($conn, "INSERT INTO tb_product VALUES ( 
                                null,
                                '".$kategori."',
                                '".$nama."',
                                '".$harga."',
                                '".$deskripsi."',
                                '".$newname."',
                                '".$status."',

                                null
                                    ) ");
                        if($insert){
                            echo '<script>alert("Simpan Data Berhasil")</script>';
                            echo '<script>window.location="data-produk.php"</script>';
                        }else{
                            echo 'gagal' .mysqli_error($conn);
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
    <script>
         CKEDITOR.replace( 'deskripsi' ); //menambah ckeditor
    </script>
</body>
</html>