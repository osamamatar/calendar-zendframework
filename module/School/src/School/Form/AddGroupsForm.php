<?php

namespace School\Form;
use Zend\Form\Form;
class AddGroupsForm extends Form
{
    public function __construct()
    {
        parent::__construct('addgroupsform');

        $this->add(array(
            'name'    => 'group_name',
            'type'    => 'text',
            'attributes' => array('required'=>'true'),
            'options' => array('label' => 'group name')

        ));


        $this->add(array(
            'name' => 'addgroup',
            'type' => 'submit',
            'attributes' => array(
                'value' => 'Add New group',
                'id'    => 'submitbutton',
                'class' => 'btn btn-danger')

        ));
    }
}