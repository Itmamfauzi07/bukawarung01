
<?php   //tidak bisa pergi ke halaman ini sebelum login dan ketika mengklik halaman ini maka akan di arahkan untuk login
    session_start();
    include 'db.php';
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
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
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
            <h3>Data Kategori</h3>
            <div class="box" >
                 <p><a href="tambah-kategori.php">Tambah Data</a></p>
                <table border="1" cellspacing= "0" class="tabel">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Ktegori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                $no = 1; //memberikan nomoer dari mulai angka 1
                                $kategori = mysqli_query($conn, "SELECT * FROM tb_kategory ORDER By kategory_id DESC");
                                if(mysqli_num_rows($kategori)>0){
                                while($row = mysqli_fetch_array($kategori)){
                            ?>
                        <tr>
                            <td><?php echo $no++ ?></td>
                            <td><?php echo $row['kategory_name'] ?></td>
                            <td>
                                <a href="edit-kategori.php?id=<?php echo $row['kategory_id'] ?>">Edit</a> ||
                                 <a href="proses-hapus.php?idk=<?php echo $row ['kategory_id'] ?>" onclick="return confirm('Yakin Ingin Hapus ?')">Hapus</a>
                            </td>
                        </tr>
                        <?php } }else{?>
                                <tr>
                                    <td colspan="3">Tidak ada data</td>
                                </tr>
                            <?php } ?>
                    </tbody>    
                </table> 
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