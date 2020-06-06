<?php
error_reporting(E_ALL);
ini_set("display_error", true);
ini_set("error_reporting", E_ALL);
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
//Заголовок страницы
$title = 'Дела в порядке';
//подключение в бд
$db_connect = mysqli_connect("localhost", "root", "", "doingsdone");
//задание кодировки uft8
mysqli_set_charset($db_connect, "utf8");
//проверка подключение к MYSQL
if ($db_connect == false) {
	print("Ошибка подключения: " . mysqli_connect_error());
} 
else { 
	// выполнение запросов
	$sql_projects = "SELECT name, id FROM projects WHERE user_id = 1";
	$sql_tasks = "SELECT * FROM tasks WHERE user_id = 1";
	$result_projects = mysqli_query($db_connect, $sql_projects);
	$result_tasks = mysqli_query($db_connect, $sql_tasks);
	$projects = mysqli_fetch_all($result_projects, MYSQLI_ASSOC);
	$tasks = mysqli_fetch_all($result_tasks, MYSQLI_ASSOC);
}
require_once('functions/template.php');
$page_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks, 'show_complete_tasks' => $show_complete_tasks]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $title]);
print($layout_content);
