<?php

class Router
{

    private $routes;  //это массив в котором будут хранится маршруты

    public function __construct() //прочитываем и записуем маршруты
    {
        $routesPath = include($_SERVER['DOCUMENT_ROOT'] . '/config/routes.php'); //указуем путь к роутам
        $this->routes = $routesPath;
    }

    private function getURL()   //Получить строку запроса из URL браузера
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');//удаляет слеш
        }

    }

    // Отвечает за анализ запроса и передачу управления

    public function run()   // принимает управление от FrontControllera
    {

        $url = $this->getURL();// Получить строку запроса

        //Проверить наличее такого запроса в routes.php
        //$uryPattern (ключ из роута 'news' или 'products') и $path (это значение ключа 'news/View' или 'product/list')
        foreach ($this->routes as $uryPattern => $path) { //маршруты из routes.php

            //Сравниваем $uryPattern (ключ из роута) и $url (строка запроса от пользователя)
            if (preg_match("~$uryPattern~", $url)) { // ~ для разделения


                $internalRoute = preg_replace("~$uryPattern~", $path, $url);

                //определить какой контролер и action обрабатывает запрос
                $segments = explode('/', $internalRoute);

                //Получаем имя контроллера
                $controllerName = array_shift($segments) . 'Controller'; //Получаем первый элемент массива и удаляем его из массива

                $controllerName = ucfirst($controllerName);//Делает первую букву заглавной

                $actionName = 'action' . ucfirst(array_shift($segments));

                $parameters = $segments; //передаем данные которые остались в массиве

                //Подключить файл класа контроллера
                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $controllerName . '.php';

                ////проверяем существует такой файл на диске,,если да то подключаем
                if (file_exists($controllerFile)) {
                    require_once($controllerFile);
                }

                //Создать объект и вызвать метод т.е. action
                $controllerObject = new $controllerName;

                /* Вызываем необходимый метод ($actionName) у определенного
                   класса ($controllerObject) с заданными ($parameters) параметрами
                 */
                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                // Если метод контроллера успешно вызван, завершаем работу роутера
                if ($result != null) {
                    break;
                }

            }


        }

    }
}



