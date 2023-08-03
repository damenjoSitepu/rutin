<?php 
declare(strict_types=1);

namespace Damenjo\Rutin\Main;

use Damenjo\Rutin\Contracts\Core;
use Damenjo\Rutin\Exceptions\RutinException;
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
     * Define default format 
     * 
     * @var string
     */
    private const DEFAULT_FORMAT = "Y-m-d H:i:s";

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
     * @return RutinCore
     */
    public static function now(string $tZ = self::DEFAULT_TIMEZONE): RutinCore
    {    
        if (RutinValidation::isEmpty($tZ)) {
            throw new RutinException("Timezone argument cannot be empty!");
        }
        self::convertToDateTime($tZ);
        return new static();
    }

    /**
     * Format DateTime object as returned value
     *
     * @param string $format
     * @return string
     */
    public static function format(string $format = self::DEFAULT_FORMAT): string
    {
        if (RutinValidation::isEmpty($format)) {
            throw new RutinException("Format argument cannot be empty!");
        }
        return self::$resultDateTime->format($format);
    }

    /**
     * Get datetime object and store it
     *
     * @param string $tZ
     * @return void
     */
    private static function convertToDateTime(string $tZ): void
    {
        $tS = time();
        try {
            $dT = new DateTime("now",new DateTimeZone($tZ));
        } catch (\Exception $e) {
            throw new RutinException("Bad timezone argument!");
        }
        $dT->setTimestamp($tS);
        self::$resultDateTime = $dT;
    }
}