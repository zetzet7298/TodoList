<?php

namespace TodoList\Controllers;

//use TodoList\Models\TodoListModel;

use TodoList\common\constants\WorkConstant;
use TodoList\Models\WorkModel;

class WorkController extends BaseController
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

        return $this->views('works.index', [
            'title' => 'Calendar',
            'data' => $data
        ]);
    }

    public function show($id)
    {
        $data = $this->model->findById($id);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
    }

    private function validate()
    {
        session_start();

        if (empty($_POST["workName"])) {
            $_SESSION['workNameErr'] = "Work name is required";
        } else {
            $workName = $_POST["workName"];
            if (strlen($workName) > 128) {
                $_SESSION['workNameErr'] = "Work name must be less than 128 characters";
            } else {
                unset($_SESSION['workNameErr']);
            }
        }

        if (empty($_POST["startingDate"])) {
            $_SESSION['startingDateErr'] = "Starting date is required";
        } else {
            $startingDate = strtotime($_POST["startingDate"]);
            unset($_SESSION['startingDateErr']);
        }

        if (empty($_POST["endingDate"])) {
            $_SESSION['endingDateErr'] = "Ending date is required";
        } else {
            $endingDate = strtotime($_POST["endingDate"]);
            unset($_SESSION['endingDateErr']);
        }

        if (!empty($startingDate) && !empty($endingDate) && ($endingDate <= $startingDate)) {
            $_SESSION['endingDateErr'] = "Ending date cannot be less than starting date";
        } elseif (!empty($startingDate) && !empty($endingDate) && ($endingDate > $startingDate)) {
            unset($_SESSION['endingDateErr']);
        }

        if (!empty($workName) && !empty($startingDate) && !empty($endingDate) && ($endingDate > $startingDate)) {
            return [
                'work_name' => $workName,
                'work_starting_date' => $startingDate,
                'work_ending_date' => $endingDate,
                'work_status' => WorkConstant::STATUS_PLANNING
            ];
        }

        return false;
    }

    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->validate() == true) {
                $data = $this->validate();
                $result = $this->model->store($data);
            }
        }
        header('Location: ?controller=work&action=index');
    }

    public function update($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($this->validate() == true) {
                $data = $this->validate();
                $result = $this->model->update($id, $data);
            }
        }
        header('Location: ?controller=work&action=index');
    }

    public function destroy($id)
    {
        $result = $this->model->destroy($id);
    }
}