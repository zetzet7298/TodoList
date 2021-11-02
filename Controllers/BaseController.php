<?php
namespace TodoList\Controllers;

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';

    const MODEL_FOLDER_NAME = 'Models';

    /*
     * pathName = folderName.fileName
     */
    protected function views($viewPath, array $data = []){
        foreach ($data as $k => $v){
            $$k = $v;
        }

        $viewPath = self::VIEW_FOLDER_NAME . '/' . str_replace('.', '/', $viewPath) . '.php';
        require $viewPath;
    }

    /*
     * */
    protected function loadModel($modelName){
        require self::MODEL_FOLDER_NAME . '/' . $modelName . '.php';
    }
}