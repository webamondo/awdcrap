<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


declare(strict_types=1);

namespace Awd\Base\Model\Response\File;

use Awd\Base\Model\MagentoVersion;
use Awd\Base\Model\Response\AbstractOctetResponse;
use Awd\Base\Model\Response\DownloadOutput;
use Awd\Base\Model\Response\OctetResponseInterface;
use Magento\Framework\App;
use Magento\Framework\Filesystem\File\ReadFactory;
use Magento\Framework\Filesystem\File\ReadInterface;
use Magento\Framework\Session\Config\ConfigInterface;
use Magento\Framework\Stdlib;

class FileOctetResponse extends AbstractOctetResponse
{
    /**
     * @var ReadFactory
     */
    private $fileReadFactory;

    public function __construct(
        ReadFactory $fileReadFactory,
        DownloadOutput $downloadHelper,
        MagentoVersion $magentoVersion,
        App\Request\Http $request,
        Stdlib\CookieManagerInterface $cookieManager,
        Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
        App\Http\Context $context,
        Stdlib\DateTime $dateTime,
        ConfigInterface $sessionConfig = null
    ) {
        $this->fileReadFactory = $fileReadFactory;

        parent::__construct(
            $downloadHelper,
            $magentoVersion,
            $request,
            $cookieManager,
            $cookieMetadataFactory,
            $context,
            $dateTime,
            $sessionConfig
        );
    }

    public function getReadResourceByPath(string $readResourcePath): ReadInterface
    {
        return $this->fileReadFactory->create($readResourcePath, OctetResponseInterface::FILE);
    }
}
