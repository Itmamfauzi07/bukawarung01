<?php 
    error_reporting(0); //menyembunyikan error
    include 'db.php';
    $kontak = mysqli_query($conn, "SELECT admin_telp, admin_email, admin_adress FROM tb_admin
            WHERE admin_id =1");
            $a = mysqli_fetch_object($kontak);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login | bukawarung</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googlea
    pis.com/css2?family=Quicksand&display=swap" rel="stylesheet">


</head>
<body>
    <!--header-->
    <header id= "header">
        <div class="container">
            <h1><a href="index.php.">bukawarung</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
               
        </div>
    </header>
   <!--search-->
   <div class="search">
    <div class ="container">
        <form action="produk.php">
            <input type="text" name="search" placeholder="Cari Produk" value="<?php echo $_GET['search'] ?>">
           
            <input type="submit" name="cari" value="Cari Produk">
        </form>
    </div>
   </div>
   
   <!--new product-->
   <div class="section">
        <div class="container">
            <h3>Produk </h3>
            <div class="box">
                <?php 
                //pencarian berdasarkan nama dan kategori
                    if($_GET['search'] != '' || $_GET['kat'] != ''){
                        $where = "AND product_name LIKE '%".$_GET['search']."%' AND kategory_id LIKE '%".$_GET['kat']."%' "; //pencarian berdasarkan nama dan kategori
                    }
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 $where
                    ORDER BY product_id DESC ");
            if(mysqli_num_rows($produk) > 0){
                while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                    <div class="col-4">
                        <img src="produk/<?php echo $p['product_image'] ?>">
                        <p class="nama"><?php echo substr($p['product_name'],0,30) ?> </p>
                        <p class="harga">Rp. <?php echo number_format($p['product_price']) ?></p>
                    </div>  
                </a>
                <?php }}else{ ?>  
                        <p>Produk tidak ada</p>
                    <?php } ?>
            </div>
        </div>
   </div>

   <!--footer-->
   <div class="footer">
    <div class="container">
        <h4>Alamat</h4>
        <p><?php echo $a->admin_adress ?></p>

        <h4>Email</h4>
        <p><?php echo $a->admin_email ?></p>

        <h4>No Hp</h4>
        <p><?php echo $a->admin_telp?></p>
        <small>Copyright &copy; 2022 - Bukawarung</small>
    </div>
   </div>
</body>
</html>