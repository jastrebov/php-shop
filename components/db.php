<?php

class Db{
        //Устанавливает соединение с базой данных
    public static function getConnection(){

        // Получаем параметры подключения из файла
        $params = include($_SERVER['DOCUMENT_ROOT'] . '/config/db_params.php');
        $dsn = "mysql:host={$params['server']}; dbname={$params['database']}";

        // Устанавливаем соединение
        $db = new PDO($dsn, $params['username'], $params['password'] );
        $db->exec("set names utf8");

        return $db;
    }


}