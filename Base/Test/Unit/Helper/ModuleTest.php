<?php
/**
 * @author Awd Team
 * @copyright Copyright (c) 2020 Awd (https://www.advancedwebsitedesign.co.uk)
 * @package Awd_Base
 */


namespace Awd\Base\Test\Unit\Helper;

use Awd\Base\Helper\Module;
use Awd\Base\Test\Unit\Traits;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * Class ModuleTest
 *
 * @see Module
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * phpcs:ignoreFile
 */
class ModuleTest extends \PHPUnit\Framework\TestCase
{
    use Traits\ObjectManagerTrait;
    use Traits\ReflectionTrait;

    /**
     * @covers Module::getFeedModuleData
     */
    public function testGetFeedModuleData()
    {
        $helper = $this->createPartialMock(Module::class, ['getAllExtensions']);

        $helper->expects($this->any())->method('getAllExtensions')->willReturn([]);

        $this->assertEquals([], $helper->getFeedModuleData('test'));

        $this->setProperty($helper, 'modulesData', [['test1', 'test2']], Module::class);
        $this->assertEquals('test1', $helper->getFeedModuleData(0));
    }
}
