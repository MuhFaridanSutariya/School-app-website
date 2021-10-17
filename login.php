<?php 
    session_start();
    if ( isset($_SESSION["login-guru"]) ) {
        header("Location: jawaban.php");
        exit;
    }

    require 'functions.php';

    if ( isset($_POST["login-guru"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user_guru WHERE username = '$username'");

        if ( mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_assoc($result);
            if ( password_verify($password, $row["password"]) ) {
                $_SESSION["login-guru"] = true;
                header("Location: jawaban.php");
                exit;
            }
        }
        $error = true;
    }

    if ( isset($_SESSION["login-murid"]) ) {
        header("Location: index-murid.php");
        exit;
    }

    if ( isset($_POST["login-murid"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($conn, "SELECT * FROM user_murid WHERE username = '$username'");

        if ( mysqli_num_rows($result) == 1 ) {
            $row = mysqli_fetch_assoc($result);
            if ( password_verify($password, $row["password"]) ) {
                $_SESSION["login-murid"] = true;
                header("Location: index-murid.php");
                exit;
            }
        }
        $error = true;
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #a9dfae;
        }

        img {
            position: absolute;
            top: 20px;
            left: 10px;
        }

        .container {
            width: 400px;
            height: 530px;
            margin: 50px auto;
            background-color: #61af69;
            border-radius: 5px;
            position: relative;
            padding: 20px 0px;
            border: 1px solid black;
        }

        h1 {
            display: flex;
            justify-content: center;
            font-size: 36px;
            text-shadow: .5px .5px .8px black;
            letter-spacing: .5px;
        }

        span {
            width: 400px;
            height: 2px;
            position: absolute;
            top: 90px;
            background-color: #000;
        }

        ul {
            position: absolute;
            top: 130px;
            left: 70px;
        }

        ul li {
            list-style: none;
            margin-bottom: 20px;
        }

        label {
            display: flex;
            font-size: 25px;
            margin-bottom: 5px;
        }

        input {
            width: 250px;
            height: 30px;
            border: none;
            border-radius: 3px;
            padding: 2px;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        button {
            position: relative;
            margin-top: 8px;
            width: 250px;
            height: 30px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: .2s;
            letter-spacing: 1px;
            border-radius: 2px;
        }

        .dropdown-child {
            display: none;
            width: 250px;
            background-color: #66b878;
        }

        .dropdown:hover .main-tombol {
            border: 1px solid black;
            background-color: transparent;
            color: #fff;
        }

        .dropdown:hover .dropdown-child {
            display: block;
            background-color: #49c063;
            color: #fff;
        }

        .dropdown-child .guru:hover {
            background-color: #308b43;
            color: #fff;
        }

        .registrasi {
            position: relative;
            display: flex;
            justify-content: center;
            margin-top: 210px;
            color: #000;
            font-size: 18px;
        }

        .registrasi.murid {
            position: absolute;
            top: -20px;
        }

        .registrasi.guru {
            position: absolute;
        }
    </style>
</head>
<body>
    <a href="home.html"><img src="img/prev.png"></a>
        
    <div class="container">
        <form action="" method="POST">
        <h1>HALAMAN LOGIN</h1>
        <span></span>
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username" autocomplete="off" placeholder="Masukkan username" >
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password">
            </li>
            <li>
                <div class="dropdown">
                    <button class="main-tombol">LOGIN</button>
                    <div class="dropdown-child">
                        <button type="submit" name="login-guru" class="guru">Sebagai Guru</button>
                        <button type="submit" name="login-murid" class="guru">Sebagai Murid</button>
                    </div>
                </div>
                <?php if ( isset($error) ) : ?>
                    <p>Username atau password tidak valid!</p>
                <?php endif; ?>
            </li>
        </ul>
        </form>
        <div class="registrasi">
            <a href="registrasi-murid.php" class="registrasi murid" name="login-murid">Registrasi Murid</a>
            <a href="registrasi-guru.php" class="registrasi guru" name="login-guru">Registrasi Guru</a>
        </div>
    </div>
    

</body>
</html>