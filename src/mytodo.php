<?php 
require_once __DIR__ . "/Entity/entityTodoList.php";
require_once __DIR__ . "/Helper/InputHelper.php";
require_once __DIR__ . "/Repository/todoListRepository.php";
require_once __DIR__ . "/Service/todoListService.php";
require_once __DIR__ . "/View/viewTodoList.php";
require_once __DIR__ . "/Config/database.php";

use Helper\InputHelper;
use Service\TodolistServiceImpl;
use Repository\TodolistRepositoryImpl;
use Config\Database;


$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);

$todolists = $todolistRepository->getAll();

$error = "";
if ($_SERVER["REQUEST_METHOD"]== "POST"){
    if ($_POST["input"] == "1"){
        header("Location: /add-todolist.php");
    }else if ($_POST["input"] == "2"){
        header("Location: /remove-todolist.php");
    }else{
        $error = "Invalid Value Requirements";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODOLIST</title>
</head>
<body>
    <h1>My Todolist</h1>
    <!-- <table border="1">
        <?php foreach($todolists as $value) { ?>
            <tr>
                <td><?= $value->getid() ?></td>
                <td><?= $value->getTodolist() ?></td>
            </tr>
        <?php } ?>
    </table> -->
    <ol>
        <?php foreach($todolists as $value) { ?>
        <li><?= $value->getTodolist()?></li>
        <?php } ?>
    </ol>
    <h2>Menu : </h2>
    <ol>
        <li>Tambah Todolist</li>
        <li>Hapus Todolist</li>
    </ol>
    <form action="/mytodo.php" method="POST"> 
        <label>Pilih Menu</label> 
        <input type="text" name="input">
        <input type="submit" value="Kirim">
    </form>
    <h2><?= $error ?></h2>
</body>
</html>