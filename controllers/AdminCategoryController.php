<?php


class AdminCategoryController extends AdminBase
{
        public function actionIndex(){

            // Проверка доступа
            self::checkAdmin();

            // Получаем список категорий
            $categoriesList = Category::getCategoriesListAdmin();

            require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_category/index.php');
            return true;

        }

    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();
        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Удаляем товар
            Category::deleteCategoryById($id);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/category");
        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_category/delete.php');
        return true;
    }

    public function actionCreate(){
        // Проверка доступа
        self::checkAdmin();

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Category::createCategory($options);

                // Если запись добавлена
                if ($id) {
                    // Перенаправляем пользователя на страницу управлениями категориями
                    header("Location: /admin/category");
                };
            }
        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_category/create.php');
        return true;
    }

    public function actionUpdate($id){
        // Проверка доступа
        self::checkAdmin();

        $category = Category::getCategoryById($id);

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена
            // Получаем данные из формы
            $options['name'] = $_POST['name'];
            $options['sort_order'] = $_POST['sort_order'];
            $options['status'] = $_POST['status'];

            // Флаг ошибок в форме
            $errors = false;

            // При необходимости можно валидировать значения нужным образом
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Заполните поля';
            }
            if ($errors == false) {
                // Если ошибок нет
                // Добавляем новый товар
                $id = Category::updateCategory($id, $options);

                // Если запись добавлена
                if ($id) {
                    // Перенаправляем пользователя на страницу управлениями категориями
                    header("Location: /admin/category");
                };
            }
        }
        // Подключаем вид
        require_once($_SERVER['DOCUMENT_ROOT'] . '/views/admin_category/update.php');
        return true;
    }
}