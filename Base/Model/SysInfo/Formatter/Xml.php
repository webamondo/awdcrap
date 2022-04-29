<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


declare(strict_types=1);

namespace Awd\Base\Model\SysInfo\Formatter;

use Awd\Base\Model\SysInfo\FormatterInterface;
use Magento\Framework\Xml\Generator as XmlGenerator;

class Xml implements FormatterInterface
{
    const XML_ROOT_NODE_NAME = 'info';
    const FILE_EXTENSION = 'xml';

    /**
     * @var XmlGenerator
     */
    private $xmlGenerator;

    public function __construct(
        XmlGenerator $xmlGenerator
    ) {
        $this->xmlGenerator = $xmlGenerator;
    }

    public function format(array $info): array
    {
        $content = $this->xmlGenerator
            ->arrayToXml([self::XML_ROOT_NODE_NAME => $info])
            ->getDom()
            ->saveXML();

        return [$content, self::FILE_EXTENSION];
    }
}
