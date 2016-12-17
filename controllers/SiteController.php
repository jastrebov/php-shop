<?php

class SiteController
{

    public function actionIndex(){ //ГЛАВНАЯ СТРАНИЦА

        // Список категорий для левого меню
        $categories = Category::getCategory();

        // Список товаров
        $latestProducts = Product::getProducts(6);

        // Список товаров для слайдера
        $sliderProducts = Product::getRecommendedProducts();

       //Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/site/index.php');
        return true;
    }

    //Action для страницы "Контакты"
    public function actionContact() {

        // Переменные для формы
        $userEmail = '';
        $userText = '';
        $result = false;

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $userEmail = $_POST['userEmail'];
            $userText = $_POST['userText'];

            //Ошибки
            $errors = false;

            // Валидация полей
            if (!User::checkEmail($userEmail)) {
                $errors[] = 'Неправильный email';
            }

            // Если ошибок нет
            // Отправляем письмо администратору
            if ($errors == false) {
                $adminEmail = 'admin@mail.ru';
                $message = "Текст: {$userText}. От {$userEmail}";
                $subject = 'Тема письма';
                $result = mail($adminEmail, $subject, $message);
            }

        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/site/contact.php');
        return true;
    }


    public function actionAbout()//Action для страницы О магазине
    {
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/site/about.php');
        return true;
    }


}