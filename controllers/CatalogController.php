<?php

class CatalogController
{
    public function actionIndex(){

        // Список категорий для левого меню
        $categorys = Category::getCategory();

        // Список товаров
        $getLatesProducts = Product::getProducts();

        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/catalog/index.php');
        return true;
    }


    public function actionCategory($category_id, $page = 1){//$page - для пагинации

        // Список категорий для левого меню
        $categorys = Category::getCategory();

        // Список товаров в категории
        $getProductsListByCategory = Product::getProductsListByCategory($category_id, $page);

        // Общее количетсво товаров (необходимо для постраничной навигации)
        $total = Product::getTotalProductsInCategory($category_id);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/catalog/category.php');
        return true;
    }
}