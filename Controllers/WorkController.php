<?php

namespace TodoList\Controllers;

//use TodoList\Models\TodoListModel;

use TodoList\common\constants\WorkConstant;
use TodoList\Models\Validation;
use TodoList\Models\WorkModel;

class WorkController extends BaseController
{
    private $model;
    private $validator;

    public function __construct()
    {
        require './common/constants/WorkConstant.php';

        $this->loadModel('WorkModel');

        $this->model = new WorkModel();

        $this->loadModel('Validation');

        $this->validator = new Validation();
    }

    /**
     * Get list data works. Response as json
     */
    public function getDataAsJson(){
        try {
            $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);
            echo json_encode($data ?? []);
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Return index view of work
     */
    public function index()
    {
        try {
            $data = $this->model->get(['*'], [['id' => 'desc'], ['created_at' => 'desc']]);

            return $this->views('works.index', [
                'title' => 'Work',
                'data' => $data ?? []
            ]);
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Get work by id. Response as Json
     * @param $id
     */
    public function getWorkByIdAsJson($id)
    {
        try {
            $data = $this->model->findById($id) ?? [];
            echo json_encode($data);
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * @param $id
     * @return array|false|string[]|null
     */
    public function show($id)
    {
        try {
            $data = $this->model->findById($id) ?? [];
            return $data;
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Validate input with method post
     * @return array|false
     */
    private function validate()
    {
        if(!isset($_SESSION))
        {
            session_start();
        }


        if ($this->validator->checkNull($_POST["workName"]) == false) {
            $_SESSION['workNameErr'] = "Work name is required";
        } else {
            $workName = $_POST["workName"];
            if ($this->validator->checkMaxLength($workName, 128) == false) {
                $_SESSION['workNameErr'] = "Work name must be less than 128 characters";
            } else {
                unset($_SESSION['workNameErr']);
            }
        }

        if ($this->validator->checkNull($_POST["startingDate"]) == false) {
            $_SESSION['startingDateErr'] = "Starting date is required";
        } else {
            $startingDate = strtotime($_POST["startingDate"]);
            unset($_SESSION['startingDateErr']);
        }

        if ($this->validator->checkNull($_POST["endingDate"]) == false) {
            $_SESSION['endingDateErr'] = "Ending date is required";
        } else {
            $endingDate = strtotime($_POST["endingDate"]);
            unset($_SESSION['endingDateErr']);
        }

        if (!empty($startingDate) && !empty($endingDate) && $this->validator->checkDateFromAndDateTo($startingDate, $endingDate) == false) {
            $_SESSION['endingDateErr'] = "Ending date cannot be less than starting date";
        } elseif (!empty($startingDate) && !empty($endingDate) && $this->validator->checkDateFromAndDateTo($startingDate, $endingDate) == true) {
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
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->validate() == true) {
                    $data = $this->validate();
                    $result = $this->model->store($data);;
                }
                header('Location: ?controller=work&action=index');
            }
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Update "work" by id
     * @param $id
     */
    public function update($id)
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($this->validate() == true) {
                    $data = $this->validate();
                    $result = $this->model->update($id, $data);
                }
                header('Location: ?controller=work&action=index');
            }
            header('Location: ?controller=work&action=index');
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Update "work status" by id
     * @param $id
     */
    public function updateStatus($id)
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $result = $this->model->update($id, [
                    'work_status' => $_POST['work_status']
                ]);
                if ($result) {
                    echo json_encode('update success');
                } else {
                    echo json_encode('update failed');
                }
            }
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }

    /**
     * Delete "work" by id
     * @param $id
     */
    public function destroy($id)
    {
        try {
            $result = $this->model->destroy($id);
            if($result){
                echo json_encode('update success');
            }else{
                echo json_encode('update failed');
            }
        }catch (\Exception $exception){
            error_reporting($exception);
        }
    }
}