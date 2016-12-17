<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/db.php');

class Category
{
    // возвращает все категории
    public static function getCategory(){
        // Соединение с БД
        $db = Db::getConnection();

        $categorys = array();
        //запрос к БД
        $result = $db->query('SELECT * FROM category  ORDER BY sort_order ASC');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $categorys[$i]["id"] = $row["id"];
            $categorys[$i]["name"] = $row["name"];
            $categorys[$i] ["sort_order"] = $row ["sort_order"];
            $categorys[$i]["status"] = $row["status"];

            $i++;
        }
        return $categorys;
    }

    public static function getCategoriesListAdmin()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Запрос к БД
        $result = $db->query('SELECT * FROM category ORDER BY sort_order ASC');
        // Получение и возврат результатов
        $categoryList = array();
        $i = 0;
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $categoryList[$i]['id'] = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $categoryList[$i]['sort_order'] = $row['sort_order'];
            $categoryList[$i]['status'] = $row['status'];
            $i++;
        }
        return $categoryList;
    }


     // Возвращает текстое пояснение статуса для категории :<br/>
     // 0 - Скрыта, 1 - Отображается</i>

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Отображается';
                break;
            case '0':
                return 'Скрыта';
                break;
        }
    }

    //Удаляет категорию с заданным id

    public static function deleteCategoryById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM category WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function createCategory($options){

        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO category '
               . '(name, sort_order, status)'
               . 'VALUES '
               . '(:name, :sort_order, :status)';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result = $result->execute();

        return  $result;
    }

    public static function getCategoryById($id){

        // Соединение с БД
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM category WHERE id = $id");
        // Указываем, что хотим получить данные в виде массива
        $oneCategory  = $result->fetch(PDO::FETCH_ASSOC);

        return  $oneCategory ;
    }

    public static function updateCategory($id, $options){

        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE category
            SET 
                name = :name, 
                sort_order = :sort_order, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':sort_order', $options['sort_order'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        return $result->execute();
    }
}