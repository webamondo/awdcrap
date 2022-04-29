<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Response;

use Magento\Framework\App;
use Magento\Framework\Filesystem\File\ReadInterface;

interface OctetResponseInterface extends App\Response\HttpInterface, App\PageCache\NotCacheableInterface
{
    const FILE = 'file';
    const FILE_URL = 'url';

    public function sendOctetResponse();

    public function getContentDisposition(): string;

    public function getReadResourceByPath(string $readResourcePath): ReadInterface;

    public function setReadResource(ReadInterface $readResource): OctetResponseInterface;

    public function getFileName(): ?string;

    public function setFileName(string $fileName): OctetResponseInterface;
}
