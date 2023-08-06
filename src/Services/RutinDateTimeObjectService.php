<?php 
namespace Damenjo\Rutin\Services;

use Damenjo\Rutin\Exceptions\RE;
use Damenjo\Rutin\Exceptions\RME;
use Damenjo\Rutin\Validations\RutinValidation;
use DateTime;

final class RutinDateTimeObjectService {
    /**
     * Define that while() method is called or not 
     *
     * @var boolean
     */
    private bool $isWhileCalled = false;

    /**
     * Define is callback passed ( generally using while() to change this value )
     *
     * @var boolean
     */
    private bool $isWhileConditionPassed = false;

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
        RutinValidation::isEmpty($format) && RE::throw(RME::FORMAT_EMPTY);
        return $this->rawDateTime->format($format);
    }

    /**
     * Synchronized the datetime data after they've been modified
     *
     * @param string $modifiedDateElements
     * @return RutinDateTimeObjectService
     */
    private function synchronized(string $modifiedDateElements): RutinDateTimeObjectService
    {
        if ($this->isWhileCalled && ! $this->isWhileConditionPassed) return $this; 
        $this->rawDateTime = $this->rawDateTime->modify($modifiedDateElements);
        $this->extract();
        $this->isWhileCalled = false;
        return $this;
    }

    /**
     * Synchronized the datetime data after they've been modified using timestamp 
     *
     * @param integer $timestamp
     * @return RutinDateTimeObjectService
     */
    private function synchronizedWithTimestamp(int $timestamp = 0): RutinDateTimeObjectService
    {
        if ($this->isWhileCalled && ! $this->isWhileConditionPassed) return $this; 
        $this->rawDateTime = $this->rawDateTime->setTimestamp($this->rawDateTime->getTimestamp() + $timestamp);
        $this->extract();
        $this->isWhileCalled = false;
        return $this;
    }

    /**
     * Add One Day
     *
     * @return RutinDateTimeObjectService
     */
    public function addDay(): RutinDateTimeObjectService
    {
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"day"));
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
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"day")) : $this;
    }

    /**
     * Add N Days
     *
     * @param integer $numberOfDays
     * @return RutinDateTimeObjectService
     */
    public function addDays(int $numberOfDays = 1): RutinDateTimeObjectService
    {           
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfDays,"day"));
    }

    /**
     * Add N Days With Condition
     * 
     * @param callable $prediction
     * @param integer $numberOfDays
     * @return RutinDateTimeObjectService
     */
    public function addDaysIf(callable $prediction, int $numberOfDays = 1): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfDays,"day")) : $this;
    }

    /**
     * Add One Month
     *
     * @return RutinDateTimeObjectService
     */
    public function addMonth(): RutinDateTimeObjectService
    {
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"month"));
    }

    /**
     * Add Month With Condition
     *
     * @param callable $prediction
     * @return RutinDateTimeObjectService
     */
    public function addMonthIf(callable $prediction): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);       
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"month")) : $this;
    }

    /**
     * Add N Months
     *
     * @param integer $numberOfMonths
     * @return RutinDateTimeObjectService
     */
    public function addMonths(int $numberOfMonths = 1): RutinDateTimeObjectService
    {           
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfMonths,"month"));
    }

    /**
     * Add N Months With Condition
     * 
     * @param callable $prediction
     * @param integer $numberOfMonths
     * @return RutinDateTimeObjectService
     */
    public function addMonthsIf(callable $prediction, int $numberOfMonths = 1): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfMonths,"month")) : $this;
    }

    /**
     * Add One Year
     *
     * @return RutinDateTimeObjectService
     */
    public function addYear(): RutinDateTimeObjectService
    {
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"year"));
    }

    /**
     * Add Year With Condition
     *
     * @param callable $prediction
     * @return RutinDateTimeObjectService
     */
    public function addYearIf(callable $prediction): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign(1,"year")) : $this;
    }

    /**
     * Add N Years
     *
     * @param integer $numberOfYears
     * @return RutinDateTimeObjectService
     */
    public function addYears(int $numberOfYears = 1): RutinDateTimeObjectService
    {           
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfYears,"year"));
    }

    /**
     * Add N Years With Condition
     * 
     * @param callable $prediction
     * @param integer $numberOfYears
     * @return RutinDateTimeObjectService
     */
    public function addYearsIf(callable $prediction, int $numberOfYears = 1): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfYears,"year")) : $this;
    }

    /**
     * Add Timestamp
     *
     * @param int $numberOfTimestamp
     * @return RutinDateTimeObjectService
     */
    public function addTimestamp(int $numberOfTimestamp = 0): RutinDateTimeObjectService
    {
        return $this->synchronizedWithTimestamp($numberOfTimestamp);
    }

    /**
     * Add N Timestamp With Condition
     * 
     * @param callable $prediction
     * @param integer $numberOfTimestamp
     * @return RutinDateTimeObjectService
     */
    public function addTimestampIf(callable $prediction, int $numberOfTimestamp = 0): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        return $callbackResult ? $this->synchronizedWithTimestamp($numberOfTimestamp) : $this;
    }

    /**
     * Add One or N for the specified date element
     *
     * @param string $dateElement | Possible Value: "day","month","year","timestamp","ts"
     * @param int $numberOfDateElement
     * @return RutinDateTimeObjectService
     */
    public function add(string $dateElement, int $numberOfDateElement = 1): RutinDateTimeObjectService
    {
        ! in_array($dateElement, ["day","month","year","timestamp","ts"]) && RE::throw(RME::INVALID_DATE_ELEMENT);
        if (in_array($dateElement,["timestamp","ts"])) return $this->synchronizedWithTimestamp($numberOfDateElement);
        return $this->synchronized(RutinUtilsService::modifyDateTimeWithMinusOrPlusSign($numberOfDateElement,$dateElement));
    }

    /**
     * Define a condition that will trigger addition / 
     * substraction for the datetime to 
     * be executed or not
     *
     * @param callable $prediction
     * @return RutinDateTimeObjectService
     */
    public function while(callable $prediction): RutinDateTimeObjectService
    {
        $callbackResult = $prediction();
        ! is_bool($callbackResult) && RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED);
        $this->isWhileCalled = true;
        $callbackResult ? $this->isWhileConditionPassed = true : $this->isWhileConditionPassed = false;
        return $this;
    }  
}