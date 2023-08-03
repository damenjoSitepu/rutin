<?php 

namespace Damenjo\Rutin\Contracts;

use Damenjo\Rutin\Main\RutinCore;
use Damenjo\Rutin\Services\RutinDateTimeObjectService;

interface Core {
    /**
     * Test and ensure that our package are running 
     * correcly inside your laravel project
     *
     * @return string
     */
    public static function ping();

    /**
     * Get now datetime 
     *
     * @param string $tZ
     * @return RutinDateTimeObjectService
     */
    public static function now(string $tZ = "Asia/Jakarta"): RutinDateTimeObjectService;
}