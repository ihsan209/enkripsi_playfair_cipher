<?php
session_start(); // Pindahkan session_start ke paling awal

include('functions.php');

$conn = createConnection();

$registrationMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) {
    $username = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);


    // Enkripsi dengan Playfair Cipher
    $key = 'PYTHAGORAS';
    $encryptedEmail = playfairEncrypt($email, $key);

    // Dekripsi
    $decryptedEmail = playfairDecrypt($encryptedemail, $key);

    $stmt = $conn->prepare("INSERT INTO users (username, email, phone ) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $decryptedEmail);

    if ($stmt->execute()) {
        $registrationMessage = '<div class="alert alert-success">Registrasi berhasil!</div>';
    } else {
        $registrationMessage = '<div class="alert alert-danger">Error: Registrasi gagal. Coba lagi nanti atau hubungi administrator.</div>';
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <!-- CSS -->
    <link rel="stylesheet" href="style/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Register</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <?php echo $registrationMessage; ?>
                            <div class="form-group">
                                <label for="name"></label>
                                <input type="text" name="name" id="name" placeholder="Username" />
                            </div>
                            <div class="form-group position-relative">
                                <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                            </div>
                            <div class="form-group position-relative">
                                <input type="text" name="phone" id="phone" placeholder="Phone" class="form-control">
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                            </div>
                            <p style="margin-top: 10px; text-align: center;">Sudah Punya Akun? <a href="login.php">Login</a></p>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/garage.jpg" alt="sign up image"></figure>
                    </div>
                </div>
            </div>
        </section>
    </div>

</body>

</html>