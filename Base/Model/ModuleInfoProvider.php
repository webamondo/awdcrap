<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/

declare(strict_types=1);

namespace Awd\Base\Model;

use Magento\Framework\Exception\FileSystemException;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Module\Dir\Reader;

class ModuleInfoProvider
{
    protected $moduleDataStorage = [];

    protected $restrictedModules = [
        'Awd_CommonRules',
        'Awd_Router'
    ];

    /**
     * @var Reader
     */
    private $moduleReader;

    /**
     * @var File
     */
    private $filesystem;

    /**
     * @var Serializer
     */
    private $serializer;

    public function __construct(
        Reader $moduleReader,
        File $filesystem,
        Serializer $serializer
    ) {
        $this->moduleReader = $moduleReader;
        $this->filesystem = $filesystem;
        $this->serializer = $serializer;
    }

    /**
     * Read info about extension from composer json file
     *
     * @param string $moduleCode
     *
     * @return mixed
     */
    public function getModuleInfo(string $moduleCode)
    {
        if (!isset($this->moduleDataStorage[$moduleCode])) {
            $this->moduleDataStorage[$moduleCode] = [];

            try {
                $dir = $this->moduleReader->getModuleDir('', $moduleCode);
                $file = $dir . '/composer.json';

                $string = $this->filesystem->fileGetContents($file);
                $this->moduleDataStorage[$moduleCode] = $this->serializer->unserialize($string);
            } catch (FileSystemException $e) {
                $this->moduleDataStorage[$moduleCode] = [];
            }
        }

        return $this->moduleDataStorage[$moduleCode];
    }

    /**
     * Check whether module was installed via Magento Marketplace
     *
     * @param string $moduleCode
     *
     * @return bool
     */
    public function isOriginMarketplace(string $moduleCode = 'Awd_Base'): bool
    {
        $moduleInfo = $this->getModuleInfo($moduleCode);
        $origin = isset($moduleInfo['extra']['origin']) ? $moduleInfo['extra']['origin'] : null;

        return 'marketplace' === $origin;
    }

    /**
     * @return array
     */
    public function getRestrictedModules(): array
    {
        return $this->restrictedModules;
    }
}
