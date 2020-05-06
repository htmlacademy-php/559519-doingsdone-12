<?php
//подсчет задач
function task_count(array $tasks_array, $project_name) : int
{
    $count = 0;
    foreach ($tasks_array as $task_item) {
        if ($task_item['project_name'] === $project_name) {
            $count++;
        }
    }
    return $count;
}
//подключает шаблон, передает туда данные и возвращает итоговый HTML контент
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
//функция выделят дела, до даты выполнения которых осталось меньше 24 часов
function getHoursBeforeDate($complete_date)
{
    $current_date = time();
    $hours_before = floor((strtotime($complete_date) - $current_date) / 3600);
    if ($hours_before < 0) {
        $hours_before = 0;
    }
    return $hours_before;
}
