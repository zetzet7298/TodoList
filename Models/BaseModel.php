<?php

namespace TodoList\Models;

use TodoList\Core\Database;

class BaseModel extends Database
{
    protected $connect;

    public function __construct()
    {
        $this->connect = $this->connect();
    }

    private function exeQuery($sql)
    {
        return mysqli_query($this->connect, $sql);
    }

    /**
     * Display a listing of the resource.
     * $table table need to query. Example: todo_list
     * $select select columns needed. require: array. Example: ['work_name']
     * $orderBys column need to order by. require: array object. Example: [['id' => 'desc'], ['created_at' => 'desc']]
     * $limit limit record. require: int. Example: 15
     */
    protected function select($table, $select = ['*'], $orderBys = [], $limit = null)
    {
        $select = implode(', ', $select);

        $sql = "select ${select} from ${table}";

        if (!empty($orderBys)) {
            $orderBys = array_reduce($orderBys, function ($carry, $value) {
                foreach ($value as $k => $v) {
                    if(!empty($carry)) $carry .= ', ' .$k . ' ' . $v;
                    else $carry = $k . ' ' . $v;
                }

                return trim($carry);
            });

            $sql .= " order by ${orderBys}";
        }

        if(!empty($limit)) $sql .= " limit ${limit}";

        $query = $this->exeQuery($sql);

        $data = [];

        if ($query) {
            while ($row = mysqli_fetch_assoc($query)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    /**
     * Get only one record by id
     * @param $table 'table' need to query. Example: todo_list
     * @param $id 'id' to find. Required: int. Example: 1
     */
    protected function find($table, $id)
    {
        $sql = "select * from ${table} where id = {$id}";

        $query = $this->exeQuery($sql);

        return mysqli_fetch_assoc($query);
    }

    /**
     * Create new resource
     * @param $table 'table' need to query. Example: todo_list
     * @param $data 'data' to insert into database. Require: array object.
     */
    protected function create($table, $data){
        $columns = implode(', ', array_keys($data));

        $values = array_map(function ($item){
            return "'" . $item . "'";
        }, array_values($data));

        $values = implode(', ', array_values($values));

        $sql = "insert into ${table}(${columns}) values(${values})";

        $this->exeQuery($sql);
    }

    /**
     * Update resource by id
     * @param $table 'table' need to query. Example: todo_list
     * @param $id 'id' to find. Required: int. Example: 1
     * @param $data 'data' to insert into database. Require: array object.
     */
    protected function updateData($table, $id, $data)
    {
        $dataSets = [];

        foreach ($data as $k => $v){
            array_push($dataSets, "${k} = '" . $v . "'");
        }

        $dataSetString = implode(', ', $dataSets);

        $sql = "update ${table} set ${dataSetString} where id = ${id}";

        $this->exeQuery($sql);
    }

    /**
     * Delete resource by id
     * @param $id 'id' to find. Required: int. Example: 1
     */
    public function delete($table, $id)
    {
        $sql = "delete from ${table} where id = {$id}";

        $query = $this->exeQuery($sql);

        return $query;
    }
}