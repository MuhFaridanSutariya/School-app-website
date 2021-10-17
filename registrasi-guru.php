<?php 
    require 'functions.php';

    if ( isset($_POST["register"]) ) {
        if ( registrasiGuru($_POST) > 0 ) {
            echo "
                <script>
                    alert('Akun Berhasil ditambahkan');
                    document.location.href = 'login.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Akun gagal ditambahkan');
                    document.location.href = 'registrasi-guru.php';
                </script>
            ";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Akun Guru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #62e7b0;
        }

        .img {
            position: absolute;
            top: 20px;
            left: 10px;
        }

        form {
            margin: 60px 150px;
            width: 750px;
            height: 400px;
            background-color: #7a7a7a93;
            border-radius: 5px;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            text-shadow: .1px .1px 1px #1f1f1f;
        }

        ul {
            margin-top: 30px;
        }

        li {
            list-style: none;
            margin-bottom: 2px;
        }

        label {
            display: flex;
            font-size: 20px;
            margin-bottom: 2px;
        }

        .input {
            width: 300px;
            height: 30px;
            border: 1px solid black;
            padding: 2px;
        }

        .logo {
            position: absolute;
            width: 250px;
            top: 150px;
            right: 460px;
        }

        .tambah {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 20px;
            border: 1px solid black;
            width: 170px;
            height: 50px;
            color: black;
            background-color: #00ff40;
            border-radius: 3px;
            font-size: 20px;
            transition: .2s;
            cursor: pointer;
        }

        .tambah:hover {
            background-color: #38d35e;
        }
    </style>
</head>
<body>
    <a href="index-guru.php"><img src="img/prev.png" class="img"></a>
        <form action="" method="POST" enctype="multipart/form-data">
            <h1>HALAMAN TAMBAH TUGAS</h1>
            <ul>
                <img src="img/logo.png" class="logo">
                <li>
                    <label for="username">Username :</label>
                    <input type="text" name="username" id="username" required autocomplete="off" class="input">
                </li>
                <li>
                    <label for="password">Password :</label>
                    <input type="password" name="password" id="password" required autocomplete="off" class="input">
                </li>
                <li>
                    <label for="password2">Confirm Password :</label>
                    <input type="password" name="password2" id="password2" required autocomplete="off" class="input">
                </li>
                <li>
                    <button type="submit" name="register" class="tambah">BUAT</button>
                </li>
            </ul>
        </form>
    
</body>
</html>