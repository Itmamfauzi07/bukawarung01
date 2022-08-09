<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    include 'db.php'; //menginput db_php agara querynya berjalan
    if($_SESSION['status_login'] != true){ //jika setatus login itu tdk sama dengan true
        echo '<script>window.location="login.php"</script>'; //maka akan di arahkan ke login
    }
    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '".$_GET['id']."' ");
    if(mysqli_num_rows($produk)== 0){
        echo '<script>window.location="data-produk.php"</script>';
    }
    $p = mysqli_fetch_object($produk);

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
                <li><a href="data-kategori.php">Data Kategori</a></li>
                <li><a href="data-produk.php">Data Produk</a></li>
                <li><a href="keluar.php">Keluar</a></li>
            </ul>
        </div>
    </header>
    <!-- content -->
    <div class="section">
        <div class="container">
            <h3>Edit Data Produk</h3>
            <div class="box" >
                
                <form action="" method="POST" enctype="multipart/form-data"> <!--value > untuk menampilkan masing masing tabel -->
                    <select class="input-control" name="kategori" required>
                        <option value="">--Pilih--</option>
                        <?php
                            $kategori = mysqli_query($conn, "SELECT * FROM tb_kategory ORDER BY kategory_id DESC");
                            while($r = mysqli_fetch_array($kategori)){
                        ?>
                            <option value="<?php echo $r['kategory_id'] ?>" <?php echo ($r['kategory_id']== $p->kategory_id)?  
                            'selected':''; ?>><?php echo $r['kategory_name']  ?></option>
                        <?php } ?>
                    </select>
                    <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value ="<?php echo $p->
                        product_name ?>" required> <!--untuk menampilkan nama-->
                    <input type="text" name="harga" class="input-control" placeholder=" Harga" value ="<?php echo $p->
                        product_price ?>" required> <!--untuk menampilkan harga-->

                        <img src="produk/<?php echo $p->product_image ?>" width = "100px"> <!--untuk menampilkan image ketika di upload-->
                        <input type="hidden" name ="foto" value ="<?php echo $p->product_image ?>">
                    <input type="file" name="gambar" class="input-control">
                    <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->
                        product_description?>"</textarea> <br> <!--untuk menampilkan deskripsi-->
                    <select class="input-control" name="status">
                        <option value="">--Pilih--</option>
                        <option value="1" <?php echo ($p->product_status == 1)? 'selected':''; ?>>Aktif</option>
                        <option value="0" <?php echo ($p->product_status == 0)? 'selected':''; ?>>Tidak Aktif</option>
                    </select>
                    <input type="submit" name="submit" value=" submit" class="btn">
                </form>
            <?php 
                if(isset($_POST['submit'])){

                    //datan infutan dari form
                    $kategori   = $_POST['kategori']; 
                    $nama       = $_POST['nama']; 
                    $harga      = $_POST['harga']; 
                    $deskripsi  = $_POST['deskripsi']; 
                    $status     = $_POST['status']; 
                    $foto     = $_POST['foto']; 

                    //data gambar yang baru
                    $filename = $_FILES['gambar']['name'];
                    $tmp_name = $_FILES['gambar']['tmp_name'];

                    
                    //jika admin ganti gambar 
                    if($filename != ''){
                        $type1 = explode('.', $filename);
                        $type2 = $type1[1];
    
                        $newname = 'produk' .time(). '.'.$type2;
    
                        //menampung data  format file yang di izinkan
                        $tipe_diizinkan = array('jpg','jpeg','png', 'gif');

                        if(!in_array($type2, $tipe_diizinkan)){
                         //jika upload file tida ada dlm aarai/(jpg,png dll maka tidak diizinkan)
                            echo '<script>alert("Format File Tidak di Izinkan")</script>' ;
                    }else{
                        unlink('./produk/'.$foto);
                        
                        move_uploaded_file($tmp_name, './produk/' .$newname);
                        $namagambar = $newname;

                    }

                    }else{
                        //jika admin tidak tganti gambar
                        $namagambar = $foto;
                    }
                    // query update data produk
                    $update = mysqli_query($conn, "UPDATE tb_product SET
                                    kategory_id = '".$kategori."',
                                    product_name = '".$nama."',
                                    product_price = '".$harga."',
                                    product_description = '".$deskripsi."',
                                    product_image = '".$namagambar."',
                                    product_status = '".$status."'
                                    WHERE product_id = '".$p->product_id."' ");

                    if($update){
                        echo '<script>alert("Ubah Data Berhasil")</script>';
                        echo '<script>window.location="data-produk.php"</script>';
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
    <script>
         CKEDITOR.replace( 'deskripsi' ); //menambah ckeditor
    </script>
</body>
</html>