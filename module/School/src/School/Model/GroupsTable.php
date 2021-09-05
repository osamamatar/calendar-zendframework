<?php

namespace School\Model;
use Zend\Db\TableGateway\TableGateway;
class GroupsTable
{
    protected $tableGateway;

    public function __construct(TableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    public function fetchAll()
    {
        return $this->tableGateway->select();
    }
    public function find_by_id($id=0)
    {
        $id     = (int)$id;
        $result = $this->tableGateway->select(array('id'=>$id));
        $row    = $result->current();

        if($row)
        {
            return $row;
        }
        else {return null;;}
    }
    public function save(Groups  $group)
    {
        $data = array('group_name' => $group->group_name,

        );
        $id = (int)$group->id;
        if($id == 0)
        {
            // insert a new record
            $this->tableGateway->insert($data);
        }
        else
        {
            // update an existing record

            if($this->find_by_id($id))
            {
                $this->tableGateway->update($data , array('id'=>$id));

            }
            else
            {
                throw new \Exception("the pizza with the id = {$id} could not be found in the database");
            }
        }

    }

}