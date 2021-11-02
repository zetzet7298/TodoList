<?php
namespace TodoList\Controllers;

//use TodoList\Models\TodoListModel;

class TodoListController extends BaseController
{
    public function index(){
        $this->loadModel('TodoListModel');
        return $this->views('todolists.index', ['title' => 'test page title']);
    }
}