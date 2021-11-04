<?php

require './config/app.php';
require './Controllers/BaseController.php';
require './Core/Database.php';
require './Models/BaseModel.php';

$controllerName = $_REQUEST['controller'] ?? '';
$actionName = $_REQUEST['action'] ?? 'index';
$id = $_REQUEST['id'] ?? -1;

$controllerNameExploded = explode('-', $controllerName);
$controllerName = array_reduce($controllerNameExploded, function ($carry, $value){
    return ucfirst($carry) . ucfirst($value);
});
$controllerName .= 'Controller';

require "./Controllers/${controllerName}.php";

$controller = "\\TodoList\\Controllers\\${controllerName}";
$controllerObj = new $controller($actionName);
($id != -1) ? $controllerObj->$actionName($id) : $controllerObj->$actionName() ;
