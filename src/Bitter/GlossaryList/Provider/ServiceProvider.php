<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace Bitter\GlossaryList\Provider;

use Bitter\GlossaryList\RouteList;
use Concrete\Core\Foundation\Service\Provider;
use Concrete\Core\Http\Response;
use Concrete\Core\Http\ResponseFactory;
use Concrete\Core\Package\Package;
use Concrete\Core\Package\PackageService;
use Concrete\Core\Routing\Router;
use Concrete\Core\Support\Facade\Application;

class ServiceProvider extends Provider
{
    public function register()
    {
        /** @var Router $router */
        $router = $this->app->make("router");

        $app = Application::getFacadeApplication();
        /** @var PackageService $packageService */
        $packageService = $app->make(PackageService::class);
        $package = $packageService->getByHandle("glossary_list");
        /** @var Package $packageController */
        $packageController = $package->getController();
        /** @var $responseFactory ResponseFactory */
        $responseFactory = $app->make(ResponseFactory::class);

        /** @noinspection PhpDeprecationInspection */
        $router->register("/bitter/glossary_list/hide_reminder", function () use ($packageController, $responseFactory, $app) {
            $packageController->getConfig()->save('reminder.hide', true);
            $responseFactory->create("", Response::HTTP_OK)->send();
            $app->shutdown();
        });

        /** @noinspection PhpDeprecationInspection */
        $router->register("/bitter/glossary_list/hide_did_you_know", function () use ($packageController, $responseFactory, $app) {
            $packageController->getConfig()->save('did_you_know.hide', true);
            $responseFactory->create("", Response::HTTP_OK)->send();
            $app->shutdown();
        });

        /** @noinspection PhpDeprecationInspection */
        $router->register("/bitter/glossary_list/hide_license_check", function () use ($packageController, $responseFactory, $app) {
            $packageController->getConfig()->save('license_check.hide', true);
            $responseFactory->create("", Response::HTTP_OK)->send();
            $app->shutdown();
        });

        $list = new RouteList();
        $list->loadRoutes($router);
    }
}