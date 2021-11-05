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

    /**
     * Get list data works. Response as json
     */
    public function getDataAsJson(){
        $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);
        echo json_encode($data);
    }

    /**
     * Return index view of work
     */
    public function index()
    {
        $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);

        return $this->views('works.index', [
            'title' => 'Work',
            'data' => $data
        ]);
    }

    /**
     * Get work by id. Response as Json
     * @param $id
     */
    public function getWorkByIdAsJson($id)
    {
        $data = $this->model->findById($id);
        echo json_encode($data);
    }

    /**
     * @param $id
     * @return array|false|string[]|null
     */
    public function show($id)
    {
        $data = $this->model->findById($id);
        return $data;
    }

    /**
     * Validate input with method post
     * @return array|false
     */
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

    /**
     * Store a new "work"
     */
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

    /**
     * Update "work" by id
     * @param $id
     */
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

    /**
     * Update "work status" by id
     * @param $id
     */
    public function updateStatus($id)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $result = $this->model->update($id, [
                'work_status' => $_POST['work_status']
            ]);
            echo json_encode('update success');
        }else{
            echo json_encode('update failed');
        }
    }

    /**
     * Delete "work" by id
     * @param $id
     */
    public function destroy($id)
    {
        $result = $this->model->destroy($id);
    }
}