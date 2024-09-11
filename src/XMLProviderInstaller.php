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
    public function install(InstalledRepositoryInterface $repo, PackageInterface $package)
    {
        $result = parent::install($repo, $package);

        $downloadPath = $this->getInstallPath($package);
        $registry = $downloadPath . '/src/XML/registry.php');

        if (file_exists($downloadPath . '/src/XML/registry.php') === true) {
            $target = $this->vendorDir . '/simplesamlphp/composer-xmlprovider/classes/' . sha1($registry) . '.php';
            link($registry, $target);
var_dump($registry);
var_dump($target);
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
