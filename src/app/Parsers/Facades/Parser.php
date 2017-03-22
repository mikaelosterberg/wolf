<?php

namespace App\Parsers\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class Parser
 * @package App\Parsers\Facades
 */
class Parser extends Facade
{
    /**
     * just return the name in ioc binding container.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'parse';
    }
}