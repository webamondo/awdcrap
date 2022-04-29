<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Test\Unit\Model\Feed\FeedTypes;

use Awd\Base\Helper\Module;
use Awd\Base\Model\Feed\FeedTypes\News;
use Awd\Base\Model\ModuleInfoProvider;
use Awd\Base\Test\Unit\Traits;
use Magento\Framework\DataObjectFactory;

class NewsTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @var News
     */
    private $model;

    /**
     * @var Module
     */
    private $moduleInfoProvider;

    protected function setUp(): void
    {
        $moduleList = $this->createMock(\Magento\Framework\Module\ModuleListInterface::class);
        $this->moduleInfoProvider = $this->createMock(ModuleInfoProvider::class);

        $moduleList->expects($this->any())->method('getNames')->willReturn(['Magento_Catalog', 'Awd_Seo']);

        $dataObjectFactory = $this->createPartialMock(DataObjectFactory::class, ['create']);
        $dataObjectFactory->expects($this->any())->method('create')->willReturn(
            new \Magento\Framework\DataObject()
        );

        $this->model = $this->getObjectManager()->getObject(
            News::class,
            [
                'moduleList' => $moduleList,
                'moduleInfoProvider' => $this->moduleInfoProvider,
                'dataObjectFactory' => $dataObjectFactory
            ]
        );
    }

    /**
     * @covers NewsProcessor::getInstalledAwdExtensions
     */
    public function testGetInstalledAwdExtensions()
    {
        $this->assertEquals([1 => 'Awd_Seo'], $this->invokeMethod($this->model, 'getInstalledAwdExtensions'));
    }

    /**
     * @covers NewsProcessor::validateByExtension
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
     * @covers NewsProcessor::validateByNotInstalled
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
     * @covers NewsProcessor::getDependModules
     */
    public function testGetDependModules()
    {
        $this->moduleInfoProvider->expects($this->any())->method('getModuleInfo')
            ->willReturn(['name' => 'awd', 'require' => ['magento' => 'catalog', 'awd' => 'shopby']]);
        $this->assertEquals(['Awd_Seo'], $this->invokeMethod($this->model, 'getDependModules', [['Awd_Seo']]));
    }
}
