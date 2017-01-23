<?php

namespace Wedding\Source;

class Year
{
    public static function getOptions()
    {
        $dt = new \DateTime();
        $opts = [];

        $currentYear = $dt->format('Y');

        for($i = ($currentYear - 5); $i <= ($currentYear+6); $i++) {
            $opts[] = $i;
        }

        return $opts;
    }

}
