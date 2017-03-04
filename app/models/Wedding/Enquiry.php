<?php

namespace Wedding;

use Wedding\Base\Enquiry as BaseEnquiry;

/**
 * Skeleton subclass for representing a row from the 'enquiry' table.
 */
class Enquiry extends BaseEnquiry
{
    public function getFormattedId()
    {
        return implode('', ['#', $this->getEntityId()]);
    }

    public function getCouple($sep = ' & ')
    {
        echo implode($sep, [
            $this->getName(),
            $this->getPartnerName()
        ]);
    }

    public function markPromoted()
    {
        $this->setPromotedAt(time());
        $this->setLostAt(null);
        $this->save();

        return $this;
    }

    public function markLost()
    {
        $this->setPromotedAt(null);
        $this->setLostAt(time());
        $this->save();

        return $this;
    }

    public function reset()
    {
        $this->setPromotedAt(null);
        $this->setLostAt(null);
        $this->save();

        return $this;
    }

    public function markContacted()
    {
        $this->setContactedAt(time());
        $this->save();

        return $this;
    }

    public function getStatus()
    {

    }

    public function getStatusClass()
    {
        $status = $this->getStatus();

        return '';
    }
}
