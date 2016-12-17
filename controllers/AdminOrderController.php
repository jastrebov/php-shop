<?php


class adminOrderController extends AdminBase
{
    public function actionIndex(){

        // Проверка доступа
        self::checkAdmin();

        $ordersList = Order::getOrders();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_order/index.php');
        return true;
    }

    //Action для страницы "Удалить заказ"

    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем заказ
            Order::deleteOrderById($id);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/order");
        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_order/delete.php');
        return true;
    }

    public function actionView($id){
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Получаем массив с идентификаторами и количеством товаров
        $productsQuantity = json_decode($order['products'], true);

        // Получаем массив с индентификаторами товаров
        $productsIds = array_keys($productsQuantity);

        $products = Product::getProduсtsByIds($productsIds);

        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_order/view.php');
        return true;
    }

    public function actionUpdate($id){
        // Проверка доступа
        self::checkAdmin();

        // Получаем данные о конкретном заказе
        $order = Order::getOrderById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['user_name'] = $_POST['userName'];
            $options['user_phone'] = $_POST['userPhone'];
            $options['user_comment'] = $_POST['userComment'];
            $options['date'] = $_POST['date'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;
            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['user_name']) || empty($options['user_name'])) {
                $errors[] = 'Заполните поля';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Обновляем заказ
                $id = Order::updateOrderById($id, $options);

                // Если запись добавлена
                if ($id) {
                    // Перенаправляем пользователя на страницу управлениями категориями
                    header("Location: /admin/order/view/$1");
                };
            }
        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_order/update.php');
        return true;
    }
}