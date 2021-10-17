<?php 
    session_start();
    if ( !isset($_SESSION["login-murid"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    $siswa = mysqli_query($conn, "SELECT * FROM 12rpl");


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Murid</title>
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
            right: 0;
        }

        a {
            text-decoration: none;
        }

        .tambah {
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 300px;
            border: 1px solid black;
            width: 170px;
            height: 50px;
            margin-left: 15px;
            color: black;
            background-color: #43ce66;
            border-radius: 3px;
            font-size: 20px;
            transition: .1s;
        }

        .tambah:hover {
            transform: translateY(2px);
            background-color: transparent;
        }

        .logout {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px;
            margin-top: 70px;
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
            font-size: 14px;
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
            left: 450px;
            top: 30px;
        }

        .disclamer {
            position: absolute;
            bottom: 210px;
            left: 18px;
        }
    </style>
</head>
<body>
        <div class="container">
            <div class="sidebar">
                <h2>DAFTAR KELAS</h2>
                <span></span>
                <a href="#" class="kelas">12 RPL</a>
                <p class="disclamer">Upload Jawaban dibawah!</p>
                <a href="kirim.php"><div class="tambah">Kirim Tugas</div></a>
                <a href="logout.php" onclick="return confirm('Yakin mau di logout?');"><div class="logout">Logout</div></a>
            </div>
            <div class="content">
                <h1>DAFTAR TUGAS! SELAMAT MENGERJAKAN</h1>
                <table border="1" cellpadding="10" cellspacing="0">
                    <tr>
                        <th class="th-1">No.</th>
                        <th class="th">NIP</th>
                        <th class="th">Nama</th>
                        <th class="th">Mapel</th>
                        <th class="th">Tugas</th>
                        <th class="th">File</th>
                        <th class="th">Tanggal</th>
                    </tr>
                    <?php $i = 1; ?>
                    <?php foreach($siswa as $sw) : ?>
                    <tr>
                        <td class="td-1"><?php echo $i++; ?></td>
                        <td class="td"><?php echo $sw["nip"]; ?></td>
                        <td class="td"><?php echo $sw["nama"]; ?></td>
                        <td class="td"><?php echo $sw["mapel"]; ?></td>
                        <td class="td"><?php echo $sw["tugas"]; ?></td>
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