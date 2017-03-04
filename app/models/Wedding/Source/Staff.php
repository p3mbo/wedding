<?php

namespace Wedding\Source;

class Staff
{
    public static function getOptions()
    {
        $collection = self::getCollection();

        $opts = [];
        /** @var \Wedding\Staff $staff */
        foreach($collection as $staff) {
            $opts[$staff->getEntityId()] = $staff->getName();
        }

        return $opts;
    }

    public static function getCollection()
    {
        $collection = \Wedding\StaffQuery::create()->filterByArchivedAt(null);
        return $collection;
    }

}
