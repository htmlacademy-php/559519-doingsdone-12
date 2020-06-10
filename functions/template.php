<?php
/**
 * Подсчитывает количество задач в каждом из проектов
 * @param array $tasks_array Ассоциативный массив с данными
 * @param string $project_id ID проекта
 * @return int Если для аргумента $project_id не найдено элементов в массиве, то вернет ноль
 */
function task_count(array $tasks_array, $project_id) : int
{
    $count = 0;
    foreach ($tasks_array as $task_item) {
        if ($task_item['project_id'] === $project_id) {
            $count++;
        }
    }
    return $count;
}
/**
 * Подключает шаблон, передает туда данные и возвращает итоговый HTML контент
 * @param string $name Путь к файлу шаблона относительно папки templates
 * @param array $data Ассоциативный массив с данными для шаблона
 * @return string Итоговый HTML
 */
function include_template($name, array $data = []) : string
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}
/**
 * Подсчитывает количество часов оставшихся до выполнения задачи
 * @param string $complete_date Дата выполнения задачи
 * @return int Количество часов
 */
function getHoursBeforeDate(string $complete_date) : int
{
    $current_date = time();
    $hours_before = floor((strtotime($complete_date) - $current_date) / 3600);
    if ($hours_before < 0) {
        return false;
    }
    return $hours_before;
}
/**
 * Устанавливает соединение в БД
 * @param array $config с настройками подключения
 * @return 
 */
function db_connect($config)
{
    $connect = mysqli_connect($config['host'], $config['user'], $config['password'], $config['database']);
    if ($connect != false) {
		mysqli_set_charset($connect, "utf8");
    } else {
        exit("Ошибка подключения: " . mysqli_connect_error());
    };
    return $connect;
}
/**
 * Получение проектов пользователя
 * @param $user_id индификатор пользователя, $connection соединение с БД
 * @return массив выборки из БД
 */
 function db_get_projects($user_id, $connection)
{
    $sql = "SELECT name, id FROM projects WHERE user_id = $user_id";
	$query = mysqli_query($connection, $sql);
	$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
	return $result;
}
/**
 * Получение задач пользователя
 * @param $user_id индификатор пользователя, $connection соединение с БД
 * @return массив выборки из БД
 */
 function db_get_tasks($user_id, $connection)
{
    $sql = "SELECT * FROM tasks WHERE user_id = $user_id";
	$query = mysqli_query($connection, $sql);
	$result = mysqli_fetch_all($query, MYSQLI_ASSOC);
	return $result;
}