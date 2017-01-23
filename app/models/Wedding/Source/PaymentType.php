<?php

namespace Wedding\Source;

class PaymentType
{
    public static function getOptions()
    {
        return [
            'Deposit',
            '3 Month Payment',
            '28 Day Payment',
            'Payment Made'
        ];
    }

}
