<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

include("connection.php");

if (isset($_GET["nim"])) {
    $nim = mysqli_real_escape_string($connection, $_GET["nim"]);

    // Jalankan query hapus data
    $query = "DELETE FROM student WHERE nim='$nim'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        $message = urlencode("Data mahasiswa dengan NIM \"<b>$nim</b>\" berhasil dihapus");
        header("Location: student_view.php?message={$message}");
        exit();
    } else {
        die("Query Error: ".mysqli_errno($connection)." - ".mysqli_error($connection));
    }
} else {
    header("Location: student_view.php");
    exit();
}

mysqli_close($connection);
?>