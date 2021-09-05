<?php

namespace School\Controller;

use School\Model\Events;
use School\Model\Groups;
use School\Model\Users;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use School\Form\AddEventsForm;
use School\Form\AddUsersForm;
use School\Form\AddGroupsForm;

class SchoolController extends AbstractActionController
{
    protected $groupTable;
    protected $userTable;
    protected $eventTable;
    public function indexAction()
    {
        return array('groups'=>$this->getGroupsTable()->fetchAll(),'users'=>$this->getUsersTable()->fetchAll());
    }
    public function addUserAction()
    {
        $add_form = new AddUsersForm();
        $fetched_groups=$this->getGroupsTable()->fetchAll();
        $groups=array();
        foreach ($fetched_groups as $g){
            $groups[$g->id]=$g->group_name;
        }
        $request  = $this->getRequest();
        if($request->isPost())
        {
            $user = new Users();
            $add_form->setData($request->getPost());

                $user->exchangeArray($request->getPost());
                $this->getUsersTable()->save($user);

            return $this->redirect()->toRoute('school');
        }
        return array('form' => $add_form,'groups'=>$groups);
    }
    public function addGroupAction(){
        $add_form = new AddGroupsForm();
        $request  = $this->getRequest();
        if($request->isPost())
        {
            $group = new Groups();
            $add_form->setData($request->getPost());

            if($add_form->isValid())
            {
                $group->exchangeArray($add_form->getData());
                $this->getGroupsTable()->save($group);
            }
            return $this->redirect()->toRoute('school');
        }
        return array('form' => $add_form);
    }
    public function calendarAction(){
        $data=array();
        $id = (int) $this->params()->fromRoute('id',0);
        if($id == 0)
        {
            // redirect to index action route
            return $this->redirect()->toRoute('school');
        }
        else {
            $group=$this->getGroupsTable()->find_by_id($id);

            $result=$this->getEventsTable()->fetch_all_by_group_id($id);
            foreach($result as $row)
            {
                $data[] = array(
                    'id'   => $row->id,
                    'title'   => $row->title,
                    'start'   => $row->start_event,
                    'end'   => $row->end_event,

                );
            }

            return array('group'=>$group,'data'=>json_encode($data));
        }


    }

    public function addEventAction(){
        $request = $this->getRequest();
        if($request->isPost()){
            $event =new Events();
            $event->title=$request->getPost('title');
            $event->start_event=$request->getPost('start');
            $event->end_event=$request->getPost('end');
            $event->group_id=$request->getPost('group_id');

            $this->getEventsTable()->save($event);
            return $this->redirect()->toRoute('school');
        }


    }

    public function getEventsTable()
    {
        if (!$this->eventTable) {
            $sm = $this->getServiceLocator();
            $this->eventTable = $sm->get('School\Model\EventsTable');
        }
        return $this->eventTable;
    }
    public function getGroupsTable(){
        if (!$this->groupTable) {
            $sm = $this->getServiceLocator();
            $this->groupTable = $sm->get('School\Model\GroupsTable');
        }
        return $this->groupTable;
    }
    public function getUsersTable(){
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('School\Model\UsersTable');
        }
        return $this->userTable;
    }

}