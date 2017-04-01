<?php

namespace Wedding\Source;

class Ceremony extends \Wedding\Source
{
    public static function getOptions()
    {
        return [
            1 => 'Outdoor',
            2 => 'Indoor',
            3 => 'Church',
            4 => 'Outdoor Marquee',
            5 => 'Indoor Conservatory'
        ];
    }

}
