<?php

namespace Wedding\Source;

class ExclusiveUse extends \Wedding\Source
{
    public static function getOptions()
    {
        return [
            1 => 'Yes',
            2 => 'No',
            3 => 'Half Day'
        ];
    }

}
