<?php
error_reporting(E_ALL);
ini_set("display_error", true);
ini_set("error_reporting", E_ALL);
// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);
//Заголовок страницы
$title = 'Дела в порядке';
//массив проектов
$projects = ['Входящие', 'Учеба', 'Работа', 'Домашние дела', 'Авто'];
//массив задач
$tasks = [
	[
		'name' => 'Собеседование в IT компании',
		'complete_date' => '01.12.2019',
		'project_name' => 'Работа',
		'completed' => false
	],
	[
		'name' => 'Выполнить тестовое задание',
		'complete_date' => '25.12.2019',
		'project_name' => 'Работа',
		'completed' => false
	],
	[
		'name' => 'Сделать задание первого раздела',
		'complete_date' => '21.12.2019',
		'project_name' => 'Учеба',
		'completed' => true
	],
	[
		'name' => 'Встреча с другом',
		'complete_date' => '25.12.2019',
		'project_name' => 'Входящие',
		'completed' => false
	],
	[
		'name' => 'Купить корм для кота',
		'complete_date' => null,
		'project_name' => 'Домашние дела',
		'completed' => false
	],
	[
		'name' => 'Заказать пиццу',
		'complete_date' => null,
		'project_name' => 'Домашние дела',
		'completed' => false
	]
];
require_once('functions/template.php');
$page_content = include_template('main.php', ['projects' => $projects, 'tasks' => $tasks, 'show_complete_tasks' => $show_complete_tasks]);
$layout_content = include_template('layout.php', ['content' => $page_content, 'title' => $title]);
print($layout_content);
?>
