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
