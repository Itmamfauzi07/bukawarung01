
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
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action="" method="POST">
            <input type="text" name="user" placeholder="Username" class="input-control">
            <input type="password" name="pass" placeholder="Password" class="input-control">
            <input type="submit" name="submit" value="Login" class ="btn">
        </form>
        <?php
            
                if(isset($_POST ['submit'])){
                    session_start();
                    include 'db.php';
    
                    $user = mysqli_real_escape_string($conn,$_POST['user']); //menolak karakter yg lain dan memanggil variabel
                    $pass =  mysqli_real_escape_string($conn,$_POST['pass']);
    
                    $cek = mysqli_query($conn, "SELECT * FROM tb_admin  WHERE username = '".$user."' AND password ='".MD5($pass)."'");
                    if( mysqli_num_rows($cek)>0){  //jika isinya lebih dari
                        $d = mysqli_fetch_object($cek);
                        $_SESSION['status_login'] = true;
                        $_SESSION['a_global'] = $d;
                        $_SESSION['id'] = $d->admin_id;            
                        echo '<script> window.location="dasboard.php" </script>'; //ketika login berhasil maka akan di arahkan ke halaman dasboard
                    }
                    else{
                    echo '<script>alert("username atau password anda salah!") </script>';
                }
               }
        ?>
    </div>
</body>
</html>