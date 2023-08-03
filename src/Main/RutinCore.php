<?php 
declare(strict_types=1);

namespace Damenjo\Rutin\Main;

use Damenjo\Rutin\Contracts\Core;
use Damenjo\Rutin\Exceptions\RutinException;
use Damenjo\Rutin\Services\ConvertToDateTimeService;
use Damenjo\Rutin\Services\RutinDateTimeObjectService;
use Damenjo\Rutin\Validations\RutinValidation;
use DateTime;
use DateTimeZone;

abstract class RutinCore implements Core {
    /**
     * Define default timezone 
     * 
     * @var string
     */
    private const DEFAULT_TIMEZONE = "Asia/Jakarta";

    /**
     * Result date time
     *
     * @var DateTime
     */
    private static $resultDateTime;

    /**
     * Test and ensure that our package are running 
     * correcly inside your laravel project
     *
     * @return string
     */
    public static function ping(): string
    {
        return "Congratulations, Rutin has been running correctly!";
    }

    /**
     * Get now datetime 
     *
     * @param string $tZ
     * @return RutinDateTimeObjectService
     */
    public static function now(string $tZ = self::DEFAULT_TIMEZONE): RutinDateTimeObjectService
    {    
        if (RutinValidation::isEmpty($tZ)) {
            throw new RutinException("Timezone argument cannot be empty!");
        }
        self::$resultDateTime = (new ConvertToDateTimeService($tZ))->get();
        return new RutinDateTimeObjectService(self::$resultDateTime);
    }
}