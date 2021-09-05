<?php
namespace School;
use School\Model\Events;
use School\Model\Groups;
use School\Model\Users;
use School\Model\GroupsTable;
use School\Model\UsersTable;
use School\Model\EventsTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'School\Model\EventsTable' =>  function($sm) {
                    $tableGateway = $sm->get('EventsTableGateway');
                    $table = new EventsTable($tableGateway);
                    return $table;
                },
                'EventsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Events());
                    return new TableGateway('events', $dbAdapter, null, $resultSetPrototype);
                },
                'School\Model\UsersTable' =>  function($sm) {
                    $tableGateway = $sm->get('UsersTableGateway');
                    $table = new UsersTable($tableGateway);
                    return $table;
                },
                'UsersTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Users());
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'School\Model\GroupsTable' =>  function($sm) {
                    $tableGateway = $sm->get('GroupsTableGateway');
                    $table = new GroupsTable($tableGateway);
                    return $table;
                },
                'GroupsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Groups());
                    return new TableGateway('groups', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}
