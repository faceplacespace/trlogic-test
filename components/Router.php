<?php

namespace components;

class Router
{
    private $routes;

    public function __construct()
    {
        $this->routes = include($_SERVER['DOCUMENT_ROOT'] . '/config/routes.php');
    }

    public function run()
    {
        $uri = $this->getURI();
        $uri = parse_url($uri, PHP_URL_PATH) ?? '';

        foreach ($this->routes as $uriPattern => $path) {

            if ($uriPattern === $uri) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                $segments = explode('/', $internalRoute);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = 'app\controllers\\' . ucfirst($controllerName);
                $actionName = strtolower(array_shift($segments));
                $parameters = $segments;

                $controllerFile = $_SERVER['DOCUMENT_ROOT'] . '/app/controllers/' .
                    $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }

                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if ($result != null) {
                    break;
                }
            }
        }
    }

    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
}
