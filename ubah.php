<?php 
    session_start();
    if ( !isset($_SESSION["login-guru"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    $id = $_GET["id"];

    $sw = query("SELECT * FROM 12rpl WHERE id = $id")[0];

    if ( isset($_POST["submit"]) ) {
        if ( ubah($_POST) > 0 ) {
            echo "
                <script>
                    alert('Tugas Berhasil diubah');
                    document.location.href = 'index-guru.php';
                </script>
            ";
        } else {
            echo "
                <script>
                    alert('Tugas gagal diubah');
                    document.location.href = 'index-guru.php';
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
    <title>Ubah Tugas</title>
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
            height: 520px;
            background-color: #7a7a7a93;
            border-radius: 5px;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            text-shadow: .1px .1px 1px #1f1f1f;
        }

        ul {
            margin-top: 20px;
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
        }

        .logo {
            position: absolute;
            width: 250px;
            top: 200px;
            right: 450px;
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
            margin-left: 15px;
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
            <input type="hidden" name="id" value="<?php echo $sw["id"]; ?>">
            <input type="hidden" name="fileUploadLama" value="<?php echo $sw["file"]; ?>">
            <h1>HALAMAN UBAH TUGAS</h1>
            <ul>
                <img src="img/logo.png" class="logo">
                <li>
                    <label for="nip">Nip :</label>
                    <input type="text" name="nip" id="nip" required autocomplete="off" value="<?php echo $sw["nip"]; ?>" class="input"> 
                </li>
                <li>
                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" required autocomplete="off" value="<?php echo $sw["nama"]; ?>" class="input">
                </li>
                <li>
                    <label for="mapel">Mapel :</label>
                    <input type="text" name="mapel" id="mapel" required autocomplete="off" value="<?php echo $sw["mapel"]; ?>" class="input">
                </li>
                <li>
                    <label for="tugas">Tugas :</label>
                    <input type="text" name="tugas" id="tugas" required autocomplete="off" value="<?php echo $sw["tugas"]; ?>" class="input">
                </li>
                <li>
                    <label>File :</label>
                    <input type="file" name="file">
                </li>
                <li>
                    <label for="tanggal">Tanggal :</label>
                    <input type="date" name="tanggal" id="tanggal" required autocomplete="off" value="<?php echo $sw["tanggal"]; ?>" class="input">
                </li>
                <li>
                    <button type="submit" name="submit" class="tambah">TAMBAH</button>
                </li>
            </ul>
        </form>
    
</body>
</html>