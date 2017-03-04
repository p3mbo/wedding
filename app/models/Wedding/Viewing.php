<?php

namespace Wedding;

use Wedding\Base\Viewing as BaseViewing;

/**
 * Skeleton subclass for representing a row from the 'viewing' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class Viewing extends BaseViewing
{
    public static function add($data)
    {
        $enquiry = \Wedding\EnquiryQuery::create()->findOneByEntityId($data['enquiry_id']);
        if($enquiry) {
            $dt = implode(' ', [$data['date'], $data['time']]);

            $viewing = new \Wedding\Viewing();
            $viewing->setAssignedTo($data['assigned_to']);
            $viewing->setViewingAt($dt);
            $viewing->setEnquiryId($data['enquiry_id']);
            $viewing->setCreatedAt(time());

            if($viewing->save()) {
                return true;
            }
        }

        return false;
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
