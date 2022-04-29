<?php
/**
* @author Awd Team
* @copyright Copyright (c) 2021 Awd (https://www.advancedwebsitedesign.co.uk)
* @package Awd_Base
*/


namespace Awd\Base\Model\Import;

class ImportCounter
{
    /**
     * @var int
     */
    private $created = 0;

    /**
     * @var int
     */
    private $updated = 0;

    /**
     * @var int
     */
    private $deleted = 0;

    public function incrementCreated($incrementOn = 1)
    {
        $this->created += (int)$incrementOn;
    }

    public function incrementUpdated($incrementOn = 1)
    {
        $this->updated += (int)$incrementOn;
    }

    public function incrementDeleted($incrementOn = 1)
    {
        $this->deleted += (int)$incrementOn;
    }

    /**
     * @return int
     */
    public function getCreatedCount()
    {
        return $this->created;
    }

    /**
     * @return int
     */
    public function getUpdatedCount()
    {
        return $this->updated;
    }

    /**
     * @return int
     */
    public function getDeletedCount()
    {
        return $this->deleted;
    }
}
