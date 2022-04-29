<?php
/**
 * @author Awd Team
 * @copyright Copyright (c) 2020 Awd (https://www.advancedwebsitedesign.co.uk)
 * @package Awd_Base
 */


namespace Awd\Base\Test\Unit\Model;

use Awd\Base\Helper\Module;
use Awd\Base\Model\Feed;
use Awd\Base\Test\Unit\Traits;
use Magento\Framework\HTTP\Adapter\Curl;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class FeedTest
 *
 * @see Feed
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class FeedTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @var Feed
     */
    private $model;

    /**
     * @var Module
     */
    private $moduleHelper;

    protected function setUp()
    {
        $moduleList = $this->createMock(\Magento\Framework\Module\ModuleListInterface::class);
        $this->moduleHelper = $this->createMock(Module::class);

        $moduleList->expects($this->any())->method('getNames')->willReturn(['Magento_Catalog', 'Awd_Seo']);

        $this->model = $this->getObjectManager()->getObject(
            Feed::class,
            [
                'moduleList' => $moduleList,
                'moduleHelper' => $this->moduleHelper,
            ]
        );
    }

    /**
     * @covers Feed::getInstalledAwdExtensions
     */
    public function testGetInstalledAwdExtensions()
    {
        $this->assertEquals([1 => 'Awd_Seo'], $this->invokeMethod($this->model, 'getInstalledAwdExtensions'));
    }

    /**
     * @covers Feed::validateByExtension
     * @dataProvider validateByExtensionDataProvider
     */
    public function testValidateByExtension($extensions, $result)
    {
        $this->assertEquals($result, $this->invokeMethod($this->model, 'validateByExtension', [$extensions, true]));
    }

    /**
     * Data provider for validateByExtension test
     * @return array
     */
    public function validateByExtensionDataProvider()
    {
        return [
            ['', true],
            ['Magento_Catalog,Awd_Seo', true],
            ['test', false],
        ];
    }

    /**
     * @covers Feed::validateByNotInstalled
     * @dataProvider validateByNotInstalledDataProvider
     */
    public function testValidateByNotInstalled($extensions, $result)
    {
        $this->assertEquals($result, $this->invokeMethod($this->model, 'validateByNotInstalled', [$extensions, true]));
    }

    /**
     * Data provider for validateByNotInstalled test
     * @return array
     */
    public function validateByNotInstalledDataProvider()
    {
        return [
            ['', true],
            ['Magento_Catalog,Awd_Seo', true],
            ['Awd_Seo', false],
        ];
    }

    /**
     * @covers Feed::getDependModules
     */
    public function testGetDependModules()
    {
        $this->moduleHelper->expects($this->any())->method('getModuleInfo')
            ->willReturn(['name' => 'awd', 'require' => ['magento' => 'catalog', 'awd' => 'shopby']]);
        $this->assertEquals(['Awd_Seo'], $this->invokeMethod($this->model, 'getDependModules', [['Awd_Seo']]));
    }
}
