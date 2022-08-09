<?php 
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
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">


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
            <input type="text" name="search" placeholder="Cari Produk">
            <input type="hidden" name="kat" value="<?php echo $_GET['kat'] ?> "> <!--mengkombinasikan pencarian berdasarkan kategori dan nama-->
            <input type="submit" name="cari" value="Cari Produk">
        </form>
    </div>
   </div>
   <!--category-->
   <div class="section">
    <div class="container">
        <h3>Kategori</h3>
        <div class="box">
            <?php 
                $kategori = mysqli_query($conn, "SELECT * FROM tb_kategory ORDER BY kategory_id DESC
                            ");
                    if(mysqli_num_rows($kategori) > 0){
                        while($k = mysqli_fetch_array($kategori)){
            ?>
            <!--mengarahkan ketika nama kategori di klik-->
                <a href="produk.php?kat=<?php echo $k['kategory_id'] ?>">
                    <div class="col-5">
                        <img src="img/icon_kategori.png" width=50px style="margin-bottom:5px;">
                        <!--memberikan namanama dalam kategori-->
                        <p> <?php echo $k['kategory_name'] ?></p>
                    </div>
                </a>
            <?php }}else{ ?>
                    <p>Kategori tidak ada</p>
                <?php } ?>
        </div>
    </div>
   </div>
   <!--new product-->
   <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php 
                    $produk = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_status = 1 ORDER BY product_id DESC
                                    LIMIT 8");
            if(mysqli_num_rows($produk) > 0){
                while($p = mysqli_fetch_array($produk)){
                ?>
                <a href="detail-produk.php?id=<?php echo $p['product_id'] ?>">
                
                    <div class="col-4">
                        <img src="produk/<?php echo $p['product_image'] ?>">
                        <p class="nama"><?php echo substr($p['product_name'],0,30 ) ?> </p>
                        <p class="harga">Rp. <?php echo number_format( $p['product_price']) ?></p>
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