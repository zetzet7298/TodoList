<?php
namespace TodoList\Controllers;

//use TodoList\Models\TodoListModel;

use TodoList\Models\TodoListModel;

class TodoListController extends BaseController
{
    private $model;

    public function __construct(){
        $this->loadModel('TodoListModel');
        $this->model = new TodoListModel();
    }

    public function index(){
        $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);
        return $this->views('works.index', ['title' => 'Calendar']);
    }

    public function show($id){
        $data = $this->model->findById($id);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    public function store(){
        $data = [
            'work_name' => 'test',
            'work_starting_date' => 123123,
            'work_ending_date' => 321321,
            'work_status' => 1
        ];
        $result = $this->model->store($data);
    }

    public function update($id){
        $data = [
            'work_name' => 'test a',
            'work_status' => 2
        ];
        $result = $this->model->update($id, $data);
    }

    public function destroy($id){
        $result = $this->model->destroy($id);
    }
}