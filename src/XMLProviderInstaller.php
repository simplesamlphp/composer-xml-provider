<?php

declare(strict_types=1);

namespace SimpleSAML\Composer\XMLProvider;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

use function in_array;

class XMLProviderInstaller extends LibraryInstaller
{
    /** @var array */
    public const SUPPORTED = ['simplesamlphp-xmlprovider'];


    /**
     * @inheritDoc
     */
    public function ensureBinariesPresence(PackageInterface $package)
    {
        $result = parent::ensureBinariesPresence($package);

        $downloadPath = $this->getInstallPath($package);
        $registry = $downloadPath . '/src/XML/element.registry.php';

        if (file_exists($registry) === true) {
            $classesDir = $this->vendorDir . '/simplesamlphp/composer-xml-provider/classes/';
            $target = $classesDir . 'element.registry.' . sha1($registry) . '.php';
            link($registry, $target);
        }

        return $result;
    }


    /**
     * @inheritDoc
     */
    public function uninstall(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $result = parent::uninstall($repo, $package);

        $downloadPath = $this->getInstallPath($package);
        $registry = $downloadPath . '/src/XML/element.registry.php';
        if (file_exists($registry) === true) {
            $classesDir = $this->vendorDir . '/simplesamlphp/composer-xml-provider/classes/';
            $target = $classesDir . 'element.registry.' . sha1($registry) . '.php';
            @unlink($target);
        }

        return $result;
    }


    /**
     * {@inheritDoc}
     */
    public function supports($packageType)
    {
        return in_array($packageType, self::SUPPORTED);
    }
}
