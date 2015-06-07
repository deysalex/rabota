<?php
/**
 * Created by PhpStorm.
 * User: Deys
 * Date: 11.04.2015
 * Time: 14:57
 */
namespace Business;

use Business\Model\Object\Vacancy;
use Business\Model\Table\VacancyTable;
use Business\Model\Object\Agency;
use Business\Model\Table\AgencyTable;
use Business\Model\Object\Group;
use Business\Model\Table\GroupTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
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

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Business\Model\Table\VacancyTable' =>  function($sm) {
                    $tableGateway = $sm->get('VacancyTableGateway');
                    $table = new VacancyTable($tableGateway);
                    return $table;
                },
                'VacancyTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Vacancy());
                    return new TableGateway('vacancy', $dbAdapter, null, $resultSetPrototype);
                },
                'Business\Model\Table\AgencyTable' =>  function($sm) {
                    $tableGateway = $sm->get('AgencyTableGateway');
                    $table = new AgencyTable($tableGateway);
                    return $table;
                },
                'AgencyTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Agency());
                    return new TableGateway('agency', $dbAdapter, null, $resultSetPrototype);
                },
                'Business\Model\Table\GroupTable' =>  function($sm) {
                    $tableGateway = $sm->get('GroupTableGateway');
                    $table = new GroupTable($tableGateway);
                    return $table;
                },
                'GroupTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Group());
                    return new TableGateway('group', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}