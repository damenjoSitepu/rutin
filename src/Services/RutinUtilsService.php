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
    public static function modifyDateTimeWithMinusOrPlusSign(int $numberOfDateElement = 0, string $dateElement): string 
    {
        return ($numberOfDateElement < 0 ? "-" : "+") . "{$numberOfDateElement} {$dateElement}";
    }    
}