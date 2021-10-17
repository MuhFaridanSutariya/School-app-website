<?php 
    session_start();
    if ( !isset($_SESSION["login-guru"]) ) {
        header("Location: login.php");
        exit;
    }

    require 'functions.php';

    $id = $_GET["id"];

     if ( hapus($id) > 0 ) {
        echo "
            <script>
                alert('Tugas Berhasil dihapus');
                document.location.href = 'index-guru.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Tugas gagal dihapus');
                document.location.href = 'index-guru.php';
            </script>
        ";
    }

?>