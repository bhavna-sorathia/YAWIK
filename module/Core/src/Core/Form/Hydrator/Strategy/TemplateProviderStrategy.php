<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013 - 2016 Cross Solution (http://cross-solution.de)
 * @license   MIT
 * @author    weitz@cross-solution.de
 */

namespace Core\Form\Hydrator\Strategy;

use Zend\Hydrator\Strategy\StrategyInterface;
use Zend\ServiceManager\ServiceManager;
use Zend\ServiceManager\ServiceManagerAwareInterface;

class TemplateProviderStrategy implements StrategyInterface, ServiceManagerAwareInterface
{
    protected $serviceManager;


    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    public function extract($value, $object = null)
    {
        $templateProvider = $this->serviceManager->get('templateProvider');
        $templateProvider->setValue($value, $object);
        return $templateProvider;
    }

    public function hydrate($value)
    {

    }
}
