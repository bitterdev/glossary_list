<?php

namespace Concrete\Package\GlossaryList;

use Bitter\GlossaryList\Provider\ServiceProvider;
use Concrete\Core\Entity\Package as PackageEntity;
use Concrete\Core\Package\Package;

class Controller extends Package
{
    protected string $pkgHandle = 'glossary_list';
    protected string $pkgVersion = '00.1';
    protected $appVersionRequired = '9.0.0';
    protected $pkgAutoloaderRegistries = [
        'src/Bitter/GlossaryList' => 'Bitter\GlossaryList',
    ];

    public function getPackageDescription(): string
    {
        return t('Create an alphabetical, scrollable list of pages grouped and sorted by title.');
    }

    public function getPackageName(): string
    {
        return t('Glossary List ');
    }

    public function on_start()
    {
        /** @var ServiceProvider $serviceProvider */
        /** @noinspection PhpUnhandledExceptionInspection */
        $serviceProvider = $this->app->make(ServiceProvider::class);
        $serviceProvider->register();
    }

    public function install(): PackageEntity
    {
        $pkg = parent::install();
        $this->installContentFile("data.xml");
        return $pkg;
    }

    public function upgrade()
    {
        parent::upgrade();
        $this->installContentFile("data.xml");
    }
}