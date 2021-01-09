<?php

/**
 * @project:   Glossary List Add-on for concrete5
 *
 * @author     Fabian Bitter (fabian@bitter.de)
 * @copyright  (C) 2018 Fabian Bitter (www.bitter.de)
 * @version    1.0.0
 */

namespace Concrete\Package\GlossaryList;

use Bitter\GlossaryList\Provider\ServiceProvider;
use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected $pkgHandle = 'glossary_list';
    protected $pkgVersion = '1.2.0';
    protected $appVersionRequired = '8.0.0';
    protected $pkgAutoloaderRegistries = [
        'src/Bitter/GlossaryList' => 'Bitter\GlossaryList',
    ];

    public function getPackageDescription()
    {
        return t('Block Element for displaying a glossary.');
    }

    public function getPackageName()
    {
        return t('Glossary List');
    }

    public function on_start()
    {
        /** @var ServiceProvider $serviceProvider */
        $serviceProvider = $this->app->make(ServiceProvider::class);
        $serviceProvider->register();
    }

    public function install()
    {
        parent::install();
        $this->installContentFile('install.xml');
    }
}
