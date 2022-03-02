<?php

namespace zoparga\EasyBill\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \zoparga\EasyBill\EasyBill
 */
class EasyBill extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'easybill';
    }
}
