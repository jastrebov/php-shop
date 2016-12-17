<?php

class User
{
        //Регистрация пользователя
        public static function register($name, $email, $password) {

            $db = Db::getConnection();

            $sql = 'INSERT INTO user (name, email, password) VALUES (:name, :email, :password)';
            //Подготавливает запрос к выполнению и возвращает ассоциированный с этим запросом объек
            $result = $db->prepare($sql);
            //Привязывает параметр запроса к переменной
            $result->bindParam(':name', $name, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            $result->bindParam(':password', $password, PDO::PARAM_STR);
            //Запускает подготовленный запрос на выполнение
            $result->execute();
            return  $result;
        }


     //Проверяет имя: не меньше, чем 2 символа

        public static function checkName($name) {
            if (strlen($name) >= 2) {
                return true;
            }
            return false;
        }
    

     //Проверяет имя: не меньше, чем 6 символов

        public static function checkPassword($password) {
            if (strlen($password) >= 6) {
                return true;
            }
            return false;
        }


     //Проверяет телефон: не меньше, чем 10 символов

    public static function checkPhone($phone)
    {
        if (strlen($phone) >= 10) {
            return true;
        }
        return false;
    }
    

     //Проверяет email
    public static function checkEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
            return false;
    }

        //Существует такой email
        public static function checkEmailExists($email) {

            $db = Db::getConnection();
            // Подготавливает запрос к выполнению
            $sql = 'SELECT COUNT(*) FROM user WHERE email = :email';
            $result = $db->prepare($sql);
            //Привязывает параметр запроса к переменной
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            //Запускает подготовленный запрос на выполнение
            $result->execute();
            //Возвращает данные одного столбца следующей строки результирующего набора
            if($result->fetchColumn()){
                return true;
            }else{
                return false;
           }

        }


     //Проверяем существует ли пользователь с заданными $email и $password

    public static function checkUserData($email, $password)
    {
        $db = Db::getConnection();

        $sql = 'SELECT * FROM user WHERE email = :email AND password = :password';

        $result = $db->prepare($sql);
        $result->bindParam(':email', $email, PDO::PARAM_INT);
        $result->bindParam(':password', $password, PDO::PARAM_INT);
        $result->execute();
        $user = $result->fetch();

        if ($user) {
            return $user['id'];
        }
        return false;
    }

    //Запоминаем пользователя
    public static function auth($userId){

        $_SESSION['user'] = $userId;
    }

    //Проверяем залогинен пользователь
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }

        header("Location: /user/login");
    }

    //Проверка статуса
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

    //Возвращает пользователя с указанным id
    public static function getUserById($id)
    {
        if ($id) {
            $db = Db::getConnection();
            $sql = 'SELECT * FROM user WHERE id = :id';
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute();
            return $result->fetch();
        }
    }

    //Редактирование данных пользователя
    public static function edit($id, $name, $password)
    {
        $db = Db::getConnection();

        $sql = "UPDATE user 
            SET name = :name, password = :password 
            WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        return $result->execute();
    }
}