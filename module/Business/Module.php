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
            ),
        );
    }
}