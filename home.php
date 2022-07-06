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

$status = null;
$foto = '';
$SECRET_KEY = Secret::$SECRET_KEY;

if (!isset($_COOKIE["X-USER-TOKEN"])) {
    $status = null;
    $foto = "user.png";
} else if ($_COOKIE["X-USER-TOKEN"] != "LOGOUT") {
    $status = '-login';
    $jwt = $_COOKIE["X-USER-TOKEN"];
    try {
        $payload = \Firebase\JWT\JWT::decode($jwt, new \Firebase\JWT\Key($SECRET_KEY, 'HS256'));
        $foto = $todolistRepository->ambilGambar($payload->username);
    } catch (Exception $exception) {
        // throw new Exception("User is not login");
        return false;
    }

    // $foto=$_COOKIE["profile"];
} else {
    $status = null;
    $foto = "user.png";
}

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="home.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">



    <title>TODOLIST</title>
</head>

<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3  w-100">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">TODOLIST</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="/home.php">Home</a>
                    <a class="nav-link" href="/src/about-us.php">About us</a>
                    <a class="nav-link user" href="/signup.php">Register</a>
                    <a class="nav-link userLogin" href="/login.php">Login</a>
                    <a class="nav-link status" href="/src/signup.php">
                        <div class="logo-profile<?= $status ?>"><img
                                src="/Bahan/<?= $foto ?>"
                                alt=""></div>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- <h3 class="status"><?= $notlogin ?>
    </h3>
    <div class="logout">
        <a href="/src/logout.php">logout</a>
    </div>
    <div class="login">
        <a href="/src/login.php">login</a>
    </div> -->

    <!-- Layout -->
    <div class="mid">
        <img src="/Bahan/ways to do.jpg" class="ways" alt="">
        <img src="/Bahan/book.jpg" class="book mt-5" alt="">
        <img src="/Bahan/todo2.jpg" class="todo2" alt="">
        <img src="/Bahan/quote.jpg" class="quote1" alt="">
        <div class="slogan">
            <p>BE A BETTER PERSON WITH US</p>
        </div>
        <ul class="menu">
            <li><a href="/src/show-todolist.php" onclick="add()" class="add"><img src="/Bahan/show.png"
                        alt="">Show Todo List</a></li>
            <li><a href="/src/add-todolist.php" onclick="add()" class="add"><img src="/Bahan/add.png" alt="">Add
                    Todo List</a></li>
            <li><a href="/src/remove-todolist.php" onclick="add()" class="add"><img src="/Bahan/trash.png"
                        alt="">Remove Todo List</a></li>
        </ul>
    </div>



    <div class="container-footer">
        <div class="footer">
            <div class="copyright">
                © 2018 All Right Reserved | <a href="/home.php">TODOLIST</a>
            </div>

            <div class="information">
                <a href="/src/about-us.php">Informasi Perusahaan</a> | <a href="">Privasi dan Kebijakan</a> | <a
                    href="">Syarat dan Ketentuan</a>
            </div>
        </div>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
    <script src="home.js"></script>
</body>

</html>