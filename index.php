<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Jika logout, hapus sesi dan arahkan ke halaman login
if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <!-- CSS dan lain-lain di sini -->
</head>

<body>
    <div class="container">
        <h1>Selamat datang,
            <?php echo $_SESSION['username']; ?>!
        </h1>
        <form action="" method="post">
            <button type="submit" name="logout">Logout</button>
        </form>
    </div>
</body>

</html>
