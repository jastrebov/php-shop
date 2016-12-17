<?php

class ProductController
{
    //Action  для одного продукта
    public  function actionView($id){

        // Список категорий для левого меню
        $categories = Category::getCategory();

        // Получаем инфомрацию о товаре
        $oneProduct = Product::oneProduct($id);

        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/product/view.php');
        return true;
    }
}