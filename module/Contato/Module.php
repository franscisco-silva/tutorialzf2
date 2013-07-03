<?php

/*
 * namespace no qual se encontra Module.php
 */

namespace Contato;

class Module {
    
    /*
     * include de arquivo para outras configurações
     */
    public function getConfig(){
        return include __DIR__ . '/config/module.config.php';
    }
    
    /*
     * autoloader para namespaces
     */
    public function getAutoloaderConfig(){
        return array(
            'Zend\Loader\StandardAutoloader' => array (
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
?>
