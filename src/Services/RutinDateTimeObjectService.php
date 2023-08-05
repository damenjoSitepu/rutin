<?php 
namespace Damenjo\Rutin\Services;

use Damenjo\Rutin\Exceptions\RE;
use Damenjo\Rutin\Exceptions\RME;
use Damenjo\Rutin\Validations\RutinValidation;
use DateTime;

final class RutinDateTimeObjectService {
    /**
     * Define default format 
     * 
     * @var string
     */
    private const DEFAULT_FORMAT = "Y-m-d H:i:s";

    /**
     * Define Format Of DateTime
     *
     * @var string
     */
    private string $dateTimeFormat;

    /**
     * Define Raw DateTime
     *
     * @var DateTime
     */
    private DateTime $rawDateTime;

    /**
     * Define Date Time 
     *
     * @var string
     */
    public string $dateTime;

    /**
     * Define Timestamps
     *
     * @var integer
     */
    public int $tS;

    /**
     * Define Long Timestamp Variable
     * 
     * @var integer
     */
    public int $timestamp;

    /**
     * Initialize the datas
     *
     * @param DateTime $rawDateTime
     * @param string $dateTimeFormat
     */
    public function __construct(DateTime $rawDateTime, string $dateTimeFormat = self::DEFAULT_FORMAT)
    {
        $this->rawDateTime = $rawDateTime;
        $this->dateTimeFormat = $dateTimeFormat;
        $this->extract();
    }

    /**
     * Extract All DateTime Object To Rutin DateTime Object
     *
     * @return void
     */
    private function extract(): void
    {
        $this->tS = $this->rawDateTime->getTimestamp();
        $this->timestamp = $this->rawDateTime->getTimestamp();
        if (empty($this->dateTimeFormat)) {
            $this->dateTime = $this->rawDateTime->format(self::DEFAULT_FORMAT);
        } else {
            $this->dateTime = $this->rawDateTime->format($this->dateTimeFormat);
        }
    }

    /**
     * Format DateTime object as returned value
     *
     * @param string $format
     * @return string
     */
    public function format(string $format = self::DEFAULT_FORMAT): string
    {
        if (RutinValidation::isEmpty($format)) {
            RE::throw(RME::FORMAT_EMPTY);
        }
        return $this->rawDateTime->format($format);
    }

    /**
     * Add One Day
     *
     * @return RutinDateTimeObjectService
     */
    public function addDay(): RutinDateTimeObjectService
    {
        $this->rawDateTime = $this->rawDateTime->modify("+1 day");
        $this->extract();
        return $this;
    }

    /**
     * Add Day With Condition
     *
     * @param callable $prediction
     * @return RutinDateTimeObjectService
     */
    public function addDayIf(callable $prediction): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        if (! is_bool($callbackResult)) {
            RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        }
        if ($callbackResult) {
            $this->rawDateTime = $this->rawDateTime->modify("+1 day");
            $this->extract();
        }
        return $this;
    }

    /**
     * Add N Days
     *
     * @param integer $numberOfDays
     * @return RutinDateTimeObjectService
     */
    public function addDays(int $numberOfDays = 0): RutinDateTimeObjectService
    {           
        $numberOfDaysFormatted = "+{$numberOfDays}";
        // If number of days argument less than zero, we know that (+) sign are not working anymore
        if ($numberOfDays < 0) $numberOfDaysFormatted = "-{$numberOfDays}";
        $this->rawDateTime = $this->rawDateTime->modify("{$numberOfDaysFormatted} day");
        $this->extract();
        return $this;
    }

    /**
     * Add N Days With Condition
     * 
     * @param callable $prediction
     * @param integer $numberOfDays
     * @return RutinDateTimeObjectService
     */
    public function addDaysIf(callable $prediction, int $numberOfDays = 0): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        if (! is_bool($callbackResult)) {
            RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        }
        if ($callbackResult) {
            $numberOfDaysFormatted = "+{$numberOfDays}";
            // If number of days argument less than zero, we know that (+) sign are not working anymore
            if ($numberOfDays < 0) $numberOfDaysFormatted = "-{$numberOfDays}";
            $this->rawDateTime = $this->rawDateTime->modify("{$numberOfDaysFormatted} day");
            $this->extract();
        }
        return $this;
    }
}