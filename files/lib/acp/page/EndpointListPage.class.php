<?php

namespace wcf\acp\page;

use wcf\event\endpoint\ControllerCollecting;
use wcf\page\AbstractPage;
use wcf\system\endpoint\RequestType;
use wcf\system\event\EventHandler;
use wcf\system\WCF;

class EndpointListPage extends AbstractPage
{
    /**
     * @inheritDoc
     */
    public $activeMenuItem = 'wcf.acp.menu.link.devtools.endpointList';

    /**
     * @inheritDoc
     */
    public $neededModules = ['ENABLE_DEVELOPER_TOOLS'];

    /**
     * @inheritDoc
     */
    public $neededPermissions = ['admin.configuration.package.canInstallPackage'];

    /**
     * @var array[
     *     'name' => string,
     *     'namespace' => string,
     *     'method' => string
     *     'uri' => string
     * ]
     */
    protected $controllers = [];
    
    /**
     * @inheritDoc
     */
    public function readParameters()
    {
        parent::readParameters();

        $event = new ControllerCollecting();
        EventHandler::getInstance()->fire($event);

        foreach ($event->getControllers() as $controller) {
            $reflectionClass = new \ReflectionClass($controller);
            $attribute = current($reflectionClass->getAttributes(RequestType::class, \ReflectionAttribute::IS_INSTANCEOF));
            \assert($attribute !== false);
            $apiController = $attribute->newInstance();
            $this->controllers[] = [
                'name' => $reflectionClass->getShortName(),
                'namespace' => $reflectionClass->getNamespaceName(),
                'method' => $apiController->method->name,
                'uri' => $apiController->uri
            ];
        }
    }

    /**
     * @inheritDoc
     */
    public function assignVariables()
    {
        parent::assignVariables();

        WCF::getTPL()->assign('controllers', $this->controllers);
    }
}
