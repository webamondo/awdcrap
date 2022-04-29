<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Feed;

use Awd\Base\Model\AdminNotification\Model\ResourceModel\Inbox\Collection\Expired;
use Awd\Base\Model\AdminNotification\Model\ResourceModel\Inbox\Collection\ExpiredFactory;
use Awd\Base\Model\Config;
use Awd\Base\Model\Feed\FeedTypes\News;
use Magento\AdminNotification\Model\Inbox;
use Magento\AdminNotification\Model\InboxFactory;

class NewsProcessor
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var InboxFactory
     */
    private $inboxFactory;

    /**
     * @var ExpiredFactory
     */
    private $expiredFactory;

    /**
     * @var FeedTypes\News
     */
    private $newsFeed;

    public function __construct(
        Config $config,
        InboxFactory $inboxFactory,
        ExpiredFactory $expiredFactory,
        News $newsFeed
    ) {
        $this->config = $config;
        $this->inboxFactory = $inboxFactory;
        $this->expiredFactory = $expiredFactory;
        $this->newsFeed = $newsFeed;
    }

    /**
     * @return void
     */
    public function checkUpdate()
    {
        if ($this->config->getFrequencyInSec() + $this->config->getLastUpdate() > time()) {
            return;
        }

        if ($feedData = $this->newsFeed->execute()) {
            /** @var Inbox $inbox */
            $inbox = $this->inboxFactory->create();
            $inbox->parse([$feedData]);
        }
        $this->config->setLastUpdate();
    }

    /**
     * @return void
     */
    public function removeExpiredItems()
    {
        if ($this->config->getLastRemovement() + Config::REMOVE_EXPIRED_FREQUENCY > time()) {
            return;
        }

        /** @var Expired $collection */
        $collection = $this->expiredFactory->create();
        foreach ($collection as $model) {
            $model->setIsRemove(1)->save();
        }
        $this->config->setLastRemovement();
    }
}
