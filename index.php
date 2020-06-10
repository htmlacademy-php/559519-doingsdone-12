<?php
error_reporting(E_ALL);
ini_set("display_error", true);
ini_set("error_reporting", E_ALL);
//подключение файла с функциями
require_once('functions/template.php');
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
//Заголовок страницы
$title = 'Дела в порядке';
//подключение файла с настроками БД
$config = require 'config.php';
//подключение к БД
$connection = db_connect($config['db']);
//указание id пользователя
$user_id = 1;

$projects = db_get_projects($user_id, $connection);
$tasks = db_get_tasks($user_id, $connection);
	
$page_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks, 'show_complete_tasks' => $show_complete_tasks]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $title]);
print($layout_content);
