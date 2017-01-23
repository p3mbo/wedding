<?php

namespace Wedding\Source;

class Budget
{
    public static function getOptions()
    {
        return [
            '0-2500',
            '2501-5000',
            '5001-7500',
            '7501-10000',
            '10001-15000',
            '15001-20000',
            '20000+'
        ];
    }

}
