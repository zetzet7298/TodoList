<?php
require './Controllers/BaseController.php';

$controllerName = $_REQUEST['controller'] ?? '';
$actionName = $_REQUEST['action'] ?? 'index';

$controllerNameExploded = explode('-', $controllerName);
$controllerName = array_reduce($controllerNameExploded, function ($carry, $value){
    return ucfirst($carry) . ucfirst($value);
});
$controllerName .= 'Controller';

require "./Controllers/${controllerName}.php";

$controller = "\\TodoList\\Controllers\\${controllerName}";
$controllerObj = new $controller($actionName);
$controllerObj->$actionName();
