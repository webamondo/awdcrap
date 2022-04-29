<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/

declare(strict_types=1);

namespace Awd\Base\Model\Feed\Response;

interface FeedResponseInterface
{
    public function getContent(): ?string;

    public function setContent(?string $content): FeedResponseInterface;

    public function getStatus(): ?string;

    public function setStatus(?string $status): FeedResponseInterface;

    public function isNeedToUpdateCache(): bool;

    public function isFailed(): bool;
}
