<?php

namespace Core\View\Helper;

use Zend\View\Helper\HelperInterface;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\EventManager\EventManager;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

abstract class AbstractEventsHelper extends EventManager implements HelperInterface, ServiceLocatorAwareInterface
{
 
    /**
     * View object
     *
     * @var Renderer
     */
    protected $view = null;
    
    protected $services;
   

    /**
     * Set the View object
     *
     * @param  Renderer $view
     * @return AbstractHelper
     */
    public function setView(Renderer $view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     * Get the view object
     *
     * @return null|Renderer
     */
    public function getView()
    {
        return $this->view;
    }
    
    public function getServiceLocator()
    {
        return $this->services;
    }
    
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator->getServiceLocator();
        return $this;
    }
}
