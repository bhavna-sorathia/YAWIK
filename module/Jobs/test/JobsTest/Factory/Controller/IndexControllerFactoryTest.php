<?php
/**
 * YAWIK
 *
 * @filesource
 * @copyright (c) 2013 - 2016 Cross Solution (http://cross-solution.de)
 * @license       MIT
 */

namespace JobsTest\Factory\Controller;

use Jobs\Factory\Controller\IndexControllerFactory;
use Jobs\Controller;
use Test\Bootstrap;
use Zend\Mvc\Controller\ControllerManager;

/**
 * Class IndexControllerFactoryTest
 * @package JobsTest\Factory\Controller
 */
class IndexControllerFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var IndexControllerFactory
     */
    private $testedObj;

    /**
     *
     */
    public function setUp()
    {
        $this->testedObj = new IndexControllerFactory();
    }

    /**
     *
     */
    public function testCreateService()
    {
        $sm = clone Bootstrap::getServiceManager();
        $sm->setAllowOverride(true);

        $jobRepositoryMock = $this->getMockBuilder('Jobs\Repository\Job')
            ->disableOriginalConstructor()
            ->getMock();

        $repositoriesMock = $this->getMockBuilder('Core\Repository\RepositoryService')
            ->disableOriginalConstructor()
            ->getMock();

        $repositoriesMock->expects($this->once())
            ->method('get')
            ->with('Jobs/Job')
            ->willReturn($jobRepositoryMock);

        $sm->setService('repositories', $repositoriesMock);

        $controllerManager = new ControllerManager();
        $controllerManager->setServiceLocator($sm);

        $result = $this->testedObj->createService($controllerManager);

        $this->assertInstanceOf('Jobs\Controller\IndexController', $result);
    }
}
