<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


declare(strict_types=1);

namespace Awd\Base\Model\SysInfo\Provider;

use Awd\Base\Model\SysInfo\InfoProviderInterface;
use Awd\Base\Model\ModuleInfoProvider;
use Magento\Framework\Module\ModuleListInterface;

class Module implements InfoProviderInterface
{
    const MODULE_VERSION_KEY = 'version';

    /**
     * @var ModuleInfoProvider
     */
    private $moduleInfoProvider;

    /**
     * @var ModuleListInterface
     */
    private $moduleList;

    public function __construct(
        ModuleInfoProvider $moduleInfoProvider,
        ModuleListInterface $moduleList
    ) {
        $this->moduleInfoProvider = $moduleInfoProvider;
        $this->moduleList = $moduleList;
    }

    public function generate(): array
    {
        $modulesData = [];
        $moduleNames = $this->moduleList->getNames();

        foreach ($moduleNames as $moduleName) {
            if (strpos($moduleName, 'Magento_') !== false) {
                continue;
            }

            $modulesData[$moduleName] = $this->getModuleData($moduleName);
        }

        return $modulesData;
    }

    protected function getModuleData(string $moduleName): array
    {
        $moduleInfo = $this->moduleInfoProvider->getModuleInfo($moduleName);
        $moduleVersion = $moduleInfo[self::MODULE_VERSION_KEY] ?? '';

        return [self::MODULE_VERSION_KEY => $moduleVersion];
    }
}
