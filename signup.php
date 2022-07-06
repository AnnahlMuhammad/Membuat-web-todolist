<?php
require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/src/Entity/entityTodoList.php";
require_once __DIR__ . "/src/Repository/todoListRepository.php";
require_once __DIR__ . "/src/Service/todoListService.php";
require_once __DIR__ . "/src/Config/database.php";
require_once __DIR__ . "/secret.php";


use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;
use Config\Database;

$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);

$SECRET_KEY = Secret::$SECRET_KEY;
$statusRegister = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file_name = $_FILES["file_upload"]["name"];
    $file_tmp_name = $_FILES["file_upload"]["tmp_name"];
    move_uploaded_file($file_tmp_name, __DIR__ . "/Bahan/" . $file_name);
    

    if ($_POST["email"] == "" || $_POST["password"]=="" || $_POST["birthday"] == "" || $_POST["gender"] == "" || $_POST["pekerjaan"] == "") {
        $statusRegister = "Please complete data";
    } elseif (strlen($_POST["password"])<8) {
        $statusRegister = "Password should be more than 8 characters";
    } elseif ($todolistService->cekData($_POST["email"])==true) {
        // var_dump($_POST["file_upload"]);
        $statusRegister = "Email is registered, try another email";
    } elseif ($todolistService->cekData($_POST["email"])==false) {
        $todolistService->addData($_POST["email"], $_POST["password"], $_POST["birthday"], $_POST["gender"], $_POST["pekerjaan"], $file_name);
        $payload = [
                "username" => $_POST["email"],
                "role" => "member"
            ];
        $jwt = \Firebase\JWT\JWT::encode($payload, $SECRET_KEY, 'HS256');
        setcookie("X-USER-TOKEN", $jwt);
        header("Location: home.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>
    <?php if ($statusRegister !='') { ?>
    <h1 class="statusRegister"><?= $statusRegister ?></h1>
    <?php } ?>
    <h1>FORM REGISTRASI</h1>
    <form action="/signup.php" method="POST" enctype="multipart/form-data">
        <label>Email
            <input type="email" name="email">
        </label>
        <br>
        <label>Password
            <input type="password" name="password">
        </label>
        <br>
        <label>Tanggal Lahir
            <input type="date" name="birthday">
        </label>
        <br>
        <label>Jenis Kelamin
            <select name="gender" style="width:300px; height: 40px" readonly>
                <option value="Laki-laki">Laki-Laki</option>
                <option value="Perempuan" selected>Perempuan</option>
            </select>
        </label>
        <br>
        <label>Pekerjaan
            <input type="text" name="pekerjaan">
        </label>
        <br>
        <label>Foto Profile
            <input type="file" name="file_upload">
        </label>
        <br>
        <input type="submit" value="Daftar">
    </form>
    <p>Sudah punya akun, <a href="/login.php">login</a></p>
</body>

</html>