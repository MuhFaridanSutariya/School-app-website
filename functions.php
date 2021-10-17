<?php 
    error_reporting(0);

    $conn = mysqli_connect("localhost", "root", "", "education_stm");

    function query($query) {
        global $conn;
        $result = mysqli_query($conn, $query);
        $rows = [];

        while ( $row = mysqli_fetch_assoc($result) ) {
            $rows[] = $row;
        }
        return $rows;
    }

    function tambah($data) {
        global $conn;

        $nip = htmlspecialchars($data["nip"]);
        $nama = htmlspecialchars($data["nama"]);
        $mapel = htmlspecialchars($data["mapel"]);
        $tugas = htmlspecialchars($data["tugas"]);
        $file = htmlspecialchars($data["file"]);
        $tanggal = date("Y-m-d");

        if ( isset($_REQUEST["submit"]) ) {
            $file = $_FILES["file"]["name"];
            $tmpName = $_FILES["file"]["tmp_name"];
            $path = "uploads/".$file;
            $file1 = explode(".", $file);
            $ext = strtolower(end($file1));
            $allowed = ["jpg", "png", "jpeg", "txt", "docx", "pptx", "pdf", "mp3", "mp4", "wmv", "zip", "rar"];

            if ( in_array($ext, $allowed) ) {
                move_uploaded_file($tmpName, $path);
            }
        }

        $query = "INSERT INTO 12rpl
                    VALUES
                    ('', '$nip', '$nama', '$mapel', '$tugas', '$file', '$tanggal')
        ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function hapus($id) {
        global $conn;
        mysqli_query($conn, "DELETE FROM 12rpl WHERE id = $id");
        return mysqli_affected_rows($conn);
    }

    function ubah($data) {
        global $conn;

        $id = $data["id"];

        $nip = htmlspecialchars($data["nip"]);
        $nama = htmlspecialchars($data["nama"]);
        $mapel = htmlspecialchars($data["mapel"]);
        $tugas = htmlspecialchars($data["tugas"]);
        $fileUploadLama = htmlspecialchars($data["fileUploadLama"]);
        $tanggal = date("Y-m-d");

        if ( isset($_REQUEST["submit"]) ) {
            $file = $_FILES["file"]["name"];
            $tmpName = $_FILES["file"]["tmp_name"];
            $path = "uploads/".$file;
            $file1 = explode(".", $file);
            $ext = strtolower(end($file1));
            $allowed = ["jpg", "png", "jpeg", "txt", "docx", "pdf", "pptx", "mp3", "mp4", "wmv", "zip", "rar"];

            if ( in_array($ext, $allowed) ) {
                move_uploaded_file($tmpName, $path);
            }
        }

        if ( $_FILES["file"]["error"] === 4 ) {
            $file = $fileUploadLama;
        }

        $query = "UPDATE 12rpl SET
                    nip = '$nip',
                    nama = '$nama',
                    mapel = '$mapel',
                    tugas = '$tugas',
                    file = '$file',
                    tanggal = '$tanggal'
                    WHERE id = $id
        ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function cari($keyword) {
        $query = "SELECT * FROM jawaban WHERE
                    kelas_jurusan LIKE '%$keyword%' OR
                    nama LIKE '%$keyword%' OR
                    mapel LIKE '%$keyword%' OR
                    tanggal LIKE '%$keyword%' 
        ";
        return query($query);
    }

    function kirim($data) {
        global $conn;

        $kelas_jurusan = htmlspecialchars($data["kelas_jurusan"]);
        $nama = htmlspecialchars($data["nama"]);
        $mapel = htmlspecialchars($data["mapel"]);
        $file = htmlspecialchars($data["file"]);
        $tanggal = date("Y-m-d");

        if ( isset($_REQUEST["submit"]) ) {
            $file = $_FILES["file"]["name"];
            $tmpName = $_FILES["file"]["tmp_name"];
            $path = "uploads/".$file;
            $file1 = explode(".", $file);
            $ext = strtolower(end($file1));
            $allowed = ["jpg", "png", "jpeg", "txt", "docx", "pptx", "pdf", "mp3", "mp4", "wmv", "zip", "rar"];

            if ( in_array($ext, $allowed) ) {
                move_uploaded_file($tmpName, $path);
            }
        }

        $query = "INSERT INTO jawaban
                    VALUES
                    ('', '$kelas_jurusan', '$nama', '$mapel', '$file', '$tanggal')
        ";
        mysqli_query($conn, $query);
        return mysqli_affected_rows($conn);
    }

    function registrasiGuru($data) {
        global $conn;

        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        $result = mysqli_query($conn, "SELECT username FROM user_guru WHERE username = '$username'");

        if ( mysqli_fetch_assoc($result) ) {
            echo "
                <script>
                    alert('Username telah terdaftar');
                </script>
            ";
            return false;
        }

        if ( $password !== $password2 ) {
            echo "
                <script>
                    alert('Password tidak konsisten');
                </script>
            ";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user_guru VALUES ('', '$username', '$password')");
        return mysqli_affected_rows($conn);
    }

    function registrasiMurid($data) {
        global $conn;

        $username = $_POST["username"];
        $password = $_POST["password"];
        $password2 = $_POST["password2"];

        $result = mysqli_query($conn, "SELECT username FROM user_murid WHERE username = '$username'");

        if ( mysqli_fetch_assoc($result) ) {
            echo "
                <script>
                    alert('Username telah terdaftar');
                </script>
            ";
            return false;
        }

        if ( $password !== $password2 ) {
            echo "
                <script>
                    alert('Password tidak konsisten');
                </script>
            ";
            return false;
        }

        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO user_murid VALUES ('', '$username', '$password')");
        return mysqli_affected_rows($conn);
    }


?>