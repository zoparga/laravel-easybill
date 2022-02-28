<?php

namespace zoparga\EasyBill\Facade;

use Illuminate\Support\Facades\Facade;

class EasyBill extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'easybill';
    }
}
