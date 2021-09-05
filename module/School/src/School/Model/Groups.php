<?php

namespace School\Model;

class Groups
{
    public $id;
    public $group_name;


    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->group_name  = (!empty($data['group_name'])) ? $data['group_name'] : null;



    }
}