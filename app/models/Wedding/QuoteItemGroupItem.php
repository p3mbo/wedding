<?php

namespace Wedding;

use Wedding\Base\QuoteItemGroupItem as BaseQuoteItemGroupItem;

/**
 * Skeleton subclass for representing a row from the 'quote_item_group_item' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class QuoteItemGroupItem extends BaseQuoteItemGroupItem
{
    public function getOptionString()
    {
        return implode(' ', [
            \Wedding::__($this->getName()),
            \Wedding::currency($this->getSuggestedPrice())
        ]);
    }
}
