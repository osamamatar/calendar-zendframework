<?php
namespace School\Model;

class Events
{
    public $id;
    public $title;
    public $start_event;
    public $end_event;
    public $group_id;

    public function exchangeArray($data)
    {
        $this->id     = (!empty($data['id'])) ? $data['id'] : null;
        $this->title  = (!empty($data['title'])) ? $data['title'] : null;
        $this->start_event = (!empty($data['start_event'])) ? $data['start_event'] : null;
        $this->end_event = (!empty($data['end_event'])) ? $data['end_event'] : null;
        $this->group_id = (!empty($data['group_id'])) ? $data['group_id'] : null;


    }
}