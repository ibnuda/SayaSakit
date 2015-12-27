<?php
/**
 * Created by PhpStorm.
 * User: Ibnu
 * Date: 27/12/2015
 * Time: 20.46
 */

namespace Senjata;


use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoLoader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoLoader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Senjata\Model\SenjataTable' => function($sm){
                    $tableGateway = $sm->get('PrajuritTableGateway');
                    $table = new SenjataTable($tableGateway);
                    return $table;
                },
                'SenjataTableGateway' => function($sm){
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Prajurit());
                    return new TableGateway('senjata', $dbAdapter, null, $resultSetPrototype);
                }
            )
        );
    }
}