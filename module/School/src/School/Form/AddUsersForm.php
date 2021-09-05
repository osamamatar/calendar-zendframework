<?php

namespace School\Form;
use Zend\Form\Form;
class AddUsersForm extends Form
{
    public function __construct()
    {
        parent::__construct('addusersform');

        $this->add(array(
            'name'    => 'name',
            'type'    => 'text',
            'attributes' => array('required'=>'true'),
            'options' => array('label' => 'name')));
        $this->add(array(
            'type' => 'Zend\Form\Element\Select',
            'name' => 'group_id',
            'options' => array(
                'label' => 'which school group ?',
            ), 'attributes' => array(
                'class' => 'btn btn-danger',
                'required'=>'true'
            ),
        ));

        $this->add(array(
            'name' => 'addusers',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Add New user',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            )));
    }
}