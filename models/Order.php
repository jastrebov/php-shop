<?php

class Order
{
    //Сохранение заказа

    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {

        $products = json_encode($products);

        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
                . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';

        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);

        return $result->execute();
    }

        // возвращает все Заказы
        public static function getOrders(){

        //запрос к БД
        $db = Db::getConnection();

        $ordersList = array();
        $result = $db->query('SELECT * FROM product_order');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $ordersList[$i]["id"] = $row["id"];
            $ordersList[$i]["user_name"] = $row["user_name"];
            $ordersList[$i]["user_phone"] = $row ["user_phone"];
            $ordersList[$i]["user_comment"] = $row["user_comment"];
            $ordersList[$i]["user_id"] = $row["user_id"];
            $ordersList[$i]["date"] = $row["date"];
            $ordersList[$i]["products"] = $row["products"];
            $ordersList[$i]["status"] = $row["status"];

            $i++;
        }
        return  $ordersList;
    }


      //Возвращает текстое пояснение статуса для заказа :<br/>
      //<i>1 - Новый заказ, 2 - В обработке, 3 - Доставляется, 4 - Закрыт</i>

    public static function getStatusText($status)
    {
        switch ($status) {
            case '1':
                return 'Новый заказ';
                break;
            case '2':
                return 'В обработке';
                break;
            case '3':
                return 'Доставляется';
                break;
            case '4':
                return 'Закрыт';
                break;
        }
    }


     //Удаляет заказ с заданным id

    public static function deleteOrderById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM product_order WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    //Выбираем заказ по id
    public static function getOrderById($id){
        // Соединение с БД
        $db = Db::getConnection();
        $result = $db->query("SELECT * FROM product_order WHERE id = $id");
        $order  = $result->fetch(PDO::FETCH_ASSOC);
        return  $order;
    }

    //Редактируем заказ
    public static function updateOrderById($id, $options){
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE product_order
            SET 
                user_name = :user_name, 
                user_phone = :user_phone, 
                user_comment = :user_comment, 
                date = :date, 
                status = :status 
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name',$options['user_name'], PDO::PARAM_STR);
        $result->bindParam(':user_phone',$options['user_phone'], PDO::PARAM_STR);
        $result->bindParam(':user_comment',$options['user_comment'] , PDO::PARAM_STR);
        $result->bindParam(':date',$options['date'], PDO::PARAM_STR);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

}
