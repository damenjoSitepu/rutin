<?php 

namespace Damenjo\Rutin\Contracts;

use Damenjo\Rutin\Main\RutinCore;

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
     * @return RutinCore
     */
    public static function now(string $tZ = "Asia/Jakarta"): RutinCore;

    /**
     * Format DateTime object as returned value
     *
     * @param string $format
     * @return string
     */
    public static function format(string $format = "Y-m-d H:i:s"): string;
}