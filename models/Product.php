<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/components/db.php');

class Product
{
    // Количество отображаемых товаров по умолчанию
    const SHOW_BY_DEFAULT = 6;

    public static function getProducts($count = self::SHOW_BY_DEFAULT){

        $count = intval($count);

        // Соединение с БД
        $db = Db::getConnection();

        $productList = array();

        $result = $db->query("SELECT id, name, price, is_new, code FROM product WHERE status = 1 ORDER BY id  LIMIT $count");

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $productList[$i]["id"] = $row["id"];
            $productList[$i]["name"] = $row["name"];
            $productList[$i] ["price"] = $row ["price"];
            $productList[$i]["is_new"] = $row["is_new"];
            $productList[$i]["code"] = $row["code"];

            $i++;
        }
        return $productList;
    }

        // Возвращает продукт с указанным id
        public static function oneProduct($id){

            $id = intval($id);
            // Соединение с БД
            $db = Db::getConnection();

            $result = $db->query("SELECT * FROM product WHERE id = $id");

            $oneProduct  = $result->fetch(PDO::FETCH_ASSOC);

            return $oneProduct;
        }

        //все продукты для одной категории
        public static function getProductsListByCategory($category_id, $page = 1){

            $category_id = intval($category_id);

            $limit = Product::SHOW_BY_DEFAULT;

            $db = Db::getConnection();
            // Смещение (для запроса)
            $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

            $productsListByCategory = array();

            $result = $db->query("SELECT id, name, price, is_new, category_id FROM product WHERE category_id = $category_id AND  status = 1 ORDER BY id ASC LIMIT $limit OFFSET $offset");
            //var_dump($result);die;
            $i = 0;
            while($row = $result->fetch(PDO::FETCH_ASSOC)){
                $productsListByCategory[$i]["id"] = $row["id"];
                $productsListByCategory[$i]["name"] = $row["name"];
                $productsListByCategory[$i] ["price"] = $row ["price"];
                $productsListByCategory[$i]["is_new"] = $row["is_new"];
                $productsListByCategory[$i]["category_id"] = $row["category_id"];

                $i++;
            }
            return $productsListByCategory;
        }


    public static function getTotalProductsInCategory($category_id)//количество товаров текущей категории
    {
        $db = Db::getConnection();

        $result = $db->query('SELECT count(id) AS count FROM product '
            . 'WHERE status="1" AND category_id ="'.$category_id.'"');
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $row = $result->fetch();
        // Возвращаем значение count - количество
        return $row['count'];
    }

    //Возвращает список товаров с указанными индентификторами
    public static function getProduсtsByIds($idsArray)
    {
        $products = array();

        $db = Db::getConnection();

        $idsString = implode(',', $idsArray);

        $sql = "SELECT * FROM product WHERE status='1' AND id IN ($idsString)";

        $result = $db->query($sql);
        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while ($row = $result->fetch()) {
            $products[$i]['id'] = $row['id'];
            $products[$i]['code'] = $row['code'];
            $products[$i]['name'] = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;
    }


     //Удаляет товар с указанным id

    public static function deleteProductById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'DELETE FROM product WHERE id = :id';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();
    }


     //Добавляет новый товар

    public static function createProduct($options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, availability,'
            . 'description, is_new, is_recommended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability,'
            . ':description, :is_new, :is_recommended, :status)';
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result = $result->execute();

        return  $result;
     }


     //Редактирует товар с заданным id

    public static function updateProductById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Текст запроса к БД
        $sql = "UPDATE product
            SET 
                name = :name, 
                code = :code, 
                price = :price, 
                category_id = :category_id, 
                brand = :brand, 
                availability = :availability, 
                description = :description, 
                is_new = :is_new, 
                is_recommended = :is_recommended, 
                status = :status
            WHERE id = :id";
        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        $result->execute();

        return $result->execute();
    }


      //Возвращает путь к изображению

    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/upload/images/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'].$pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }
        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

      //Возвращает список рекомендуемых товаров

    public static function getRecommendedProducts()
    {
        // Соединение с БД
        $db = Db::getConnection();
        // Получение и возврат результатов
        $result = $db->query('SELECT id, name, price, is_new FROM product '
            . 'WHERE status = "1" AND is_recommended = "1" '
            . 'ORDER BY id DESC');
        $i = 0;
        $productsList = array();
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['is_new'] = $row['is_new'];
            $i++;
        }
        return $productsList;
    }

}