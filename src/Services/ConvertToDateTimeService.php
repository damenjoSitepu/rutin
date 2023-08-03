<?php 
namespace Damenjo\Rutin\Services;

use Damenjo\Rutin\Exceptions\RutinException;
use DateTime;
use DateTimeZone;

final class ConvertToDateTimeService {
    /**
     * Define timezone
     *
     * @var string
     */
    private string $tZ; 

    /**
     * Initialize The Data
     */
    public function __construct(string $tZ)
    {
        $this->tZ = $tZ;
    }

    /**
     * Get back the converted date time object
     *
     * @return DateTime
     */
    public function get(): DateTime
    {
        $tS = time();
        try {
            $dT = new DateTime("now",new DateTimeZone($this->tZ));
        } catch (\Exception $e) {
            throw new RutinException("Bad timezone argument!");
        }
        $dT->setTimestamp($tS);
        return $dT;
    }
}