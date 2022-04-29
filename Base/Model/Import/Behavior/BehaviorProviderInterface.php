<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import\Behavior;

interface BehaviorProviderInterface
{
    /**
     * @param string $behaviorCode
     *
     * @throws \Awd\Base\Exceptions\NonExistentImportBehavior
     * @return \Awd\Base\Model\Import\Behavior\BehaviorInterface
     */
    public function getBehavior($behaviorCode);
}
