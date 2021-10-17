<?php 
    session_start();
    if ( !isset($_SESSION["login-guru"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    $siswa = mysqli_query($conn, "SELECT * FROM jawaban");

    if ( isset($_POST["cari"]) ) {
        $siswa = cari($_POST["keyword"]);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Guru</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #eee;
        }

        .container {
            position: relative;
        }

        .sidebar {
            position: absolute;
            left: 0;
            width: 200px;
            height: 100vh;
            background-color: #ddd;
        }

        h2 {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            font-size: 26px;
        }

        span {
            position: absolute;
            left: 0;
            top: 70px;
            width: 200px;
            height: 1px;
            background-color: black;
        }

        .kelas {
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 10px;
            margin-top: 50px;
            width: 170px;
            height: 50px;
            margin-left: 15px;
            color: black;
            background-color: #7a7a7a;
            border-radius: 3px;
            font-size: 18px;
            transition: .2s;
        }

        .kelas:hover {
            transform: scale(.93);
        }

        .next {
            position: absolute;
            top: 300px;
            left: 0;
        }

        a {
            text-decoration: none;
        }

        .keyword {
            width: 170px;
            height: 30px;
            color: black;
            background-color: #c7c7c7;
            border-radius: 5px;
            border: 1px solid black;
            margin-top: 300px;
            margin-left: 15px;
            padding: 3px;
        }

        .cari {
            position: absolute;
            top: 490px;
            left: 40px;
            width: 120px;
            height: 25px;
            cursor: pointer;
            background-color: #7c5c5c;
            border: 1px solid black;
            border-radius: 3px;
            transition: .1s;
        }

        .cari:hover {
            background-color: transparent;
        }

        .logout {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 100px;
            border: 1px solid black;
            width: 170px;
            height: 50px;
            margin-left: 15px;
            color: black;
            background-color: #df4242;
            border-radius: 3px;
            font-size: 20px;
            transition: .1s;
        }

        .logout:hover {
            transform: translateY(-2px);
            background-color: transparent;
        }

        table {
            position: absolute;
            margin: 100px 300px;
            font-size: 18px;
        }

        .th {
            padding: 10px 55px;
        }

        .th-1 {
            padding: 10px 20px;
        }

        .td {
            padding: 5px 15px;
        }

        .td-1 {
            padding: 10px 20px;
        }

        .hapus {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 30px;
            color: black;
            background-color: #c9c9c9;
            border-radius: 15px;
            font-size: 16px;
            transition: .1s;
            margin-bottom: 8px;
        }

        .hapus:hover {
            background-color: #949494;
        }

        .ubah {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100px;
            height: 30px;
            color: black;
            background-color: #c9c9c9;
            border-radius: 15px;
            font-size: 16px;
            transition: .1s;
        }

        .ubah:hover {
            background-color: #949494;
        }

        h1 {
            position: absolute;
            top: 20px;
            left: 450px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
        <div class="container">
            <div class="sidebar">
                <h2>DAFTAR KELAS</h2>
                <span></span>
                <a href="#" class="kelas">12 RPL</a>
                <a href="index-guru.php" class="next"><img src="img/prev.png"></a>
                <form action="" method="POST" class="tambah">
                    <input type="text" name="keyword" autocomplete="off" placeholder="Cari Jawaban disini" class="keyword">
                    <button type="submit" name="cari" class="cari">Find Now</button>
                </form>
                <a href="logout.php" onclick="return confirm('Yakin mau dilogout?');"><div class="logout">Logout</div></a>
            </div>
            <div class="content">
                <h1>Daftar Jawaban! Selamat Mengoreksi</h1>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th class="th-1">No.</th>
                        <th class="th">Kelas & Jurusan</th>
                        <th class="th">Nama</th>
                        <th class="th">Mapel</th>
                        <th class="th">Jawaban</th>
                        <th class="th">Tanggal</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach($siswa as $sw) : ?>
                    <tr>
                        <td class="td-1"><?php echo $i++; ?></td>
                        <td class="td"><?php echo $sw["kelas_jurusan"]; ?></td>
                        <td class="td"><?php echo $sw["nama"]; ?></td>
                        <td class="td"><?php echo $sw["mapel"]; ?></td>
                        <td class="td">
                            <a download="<?php echo $sw["file"]; ?>" href="uploads/<?php echo $sw["file"]; ?>"><?php echo $sw["file"]; ?></a>
                        </td>
                        <td class="td"><?php echo $sw["tanggal"]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    
</body>
</html>