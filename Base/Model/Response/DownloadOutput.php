<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


declare(strict_types=1);

namespace Awd\Base\Model\Response;

use Magento\Downloadable\Helper\Download;
use Magento\Framework\Filesystem\File\ReadInterface;

class DownloadOutput extends Download
{
    /**
     * @var ReadInterface|null
     */
    private $resourceHandler;

    public function setResourceHandler(ReadInterface $readResource): self
    {
        $this->resourceHandler = $readResource;

        return $this;
    }

    protected function _getHandle(): ?ReadInterface
    {
        return $this->resourceHandler;
    }
}
