<?php

namespace Wedding\Source;

class Day extends \Wedding\Source
{
    public static function getOptions()
    {
        return ['Mon', 'Tue', 'Wed', 'Thur', 'Fri', 'Sat', 'Sun'];
    }

}
