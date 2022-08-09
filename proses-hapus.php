<?php
    include 'db.php'; 
    if(isset($_GET['idk'])){  //jika ada proses id masuk maka lakukan proses delet
        $delete = mysqli_query($conn, "DELETE FROM tb_kategory WHERE kategory_id ='".$_GET['idk']."' ");
        echo '<script>window.location="data-kategori.php"</script>';
    }

    if(isset($_GET['idp'])){
$produk = mysqli_query($conn, "SELECT product_image FROM tb_product WHERE product_id = '".$_GET['idp']."' ");
$p = mysqli_fetch_object($produk);

        unlink('./produk/'.$p->product_image);  //hapus gambar yang ada di tb produk

        $delete = mysqli_query($conn, "DELETE FROM tb_product WHERE product_id ='".$_GET['idp']."' ");
        echo '<script>window.location="data-produk.php"</script>';
    }
?>