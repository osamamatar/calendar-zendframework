<?php
namespace School\Model;

class Users
{
    public $id;
    public $name;
    public $group_id;


    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->name  = (!empty($data['name'])) ? $data['name'] : null;
        $this->group_id = (!empty($data['group_id'])) ? $data['group_id'] : null;

    }
}