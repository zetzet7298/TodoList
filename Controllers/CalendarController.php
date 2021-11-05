<?php

namespace TodoList\Controllers;

//use TodoList\Models\TodoListModel;

use TodoList\common\constants\WorkConstant;
use TodoList\Models\WorkModel;

class CalendarController extends BaseController
{
    private $model;

    public function __construct()
    {
        require './common/constants/WorkConstant.php';

        $this->loadModel('WorkModel');

        $this->model = new WorkModel();
    }

    public function index()
    {
        $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);

        return $this->views('calendar.index', [
            'title' => 'Calendar',
            'data' => $data
        ]);
    }
}