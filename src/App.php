<?php 

require_once __DIR__ . "/Entity/entityTodoList.php";
require_once __DIR__ . "/Helper/InputHelper.php";
require_once __DIR__ . "/Repository/todoListRepository.php";
require_once __DIR__ . "/Service/todoListService.php";
require_once __DIR__ . "/View/viewTodoList.php";
require_once __DIR__ . "/Config/database.php";

use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;
use View\ViewTodoList;
use Config\Database;

$connection = Database::getConnection();
$todolistRepository = new TodolistRepositoryImpl($connection);
$todolistService = new TodolistServiceImpl($todolistRepository);
$todolistView = new ViewTodoList($todolistService);

$todolistView->showTodoList();


?>