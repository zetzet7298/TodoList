<?php

namespace TodoList\Models;

class TodoListModel extends BaseModel
{
    protected $table = 'works';

    public function get($select = ['*'], $orderBys = [], $limit = null){
        return $this->select($this->table, $select, $orderBys, $limit);
    }

    public function findById($id){
        return $this->find($this->table, $id);
    }

    public function store($data){
        return $this->create($this->table, $data);
    }

    public function update($id, $data){
        return $this->updateData($this->table, $id, $data);
    }

    public function destroy($id){
        return $this->delete($this->table, $id);
    }
}