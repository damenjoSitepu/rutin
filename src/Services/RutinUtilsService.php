<?php 
namespace Damenjo\Rutin\Services;

class RutinUtilsService {
    /**
     * Will arranged to be first argument of modify() which is belongs to DateTime object
     *
     * @param integer $numberOfDateElement
     * @param string $dateElement
     * @return string
     */
    public static function modifyDateTimeWithMinusOrPlusSign(int $numberOfDateElement = 0, string $dateElement = "day"): string 
    {
        /**
         * If date element was timestamp, we will return 
         * string with both of two parameter 
         * and separated by space
         */
        if ($dateElement === "timestamp") {
            return "{$dateElement} {$numberOfDateElement}";
        }
        return ($numberOfDateElement < 0 ? "-" : "+") . "{$numberOfDateElement} {$dateElement}";
    }    
}