<?php

namespace Wedding;

class Source
{
    public static function getOptionHtml($selected = false)
    {
        $collection = static::getOptions();


        $html = [];

        foreach($collection as $k => $v) {
            $html[] = sprintf('<option %s value="%d">%s</option>',
                $selected != false && $k == $selected ? 'selected="selected"' : '',
                $k,
                $v
            );
        }

        return implode("\n", $html);
    }


    public static function getOptions()
    {
        return [];
    }


}
