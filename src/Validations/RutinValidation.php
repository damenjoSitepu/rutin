<?php 
namespace Damenjo\Rutin\Validations;

use Damenjo\Rutin\Exceptions\RE;
use Damenjo\Rutin\Exceptions\RME;

class RutinValidation {
    /**
     * Error will be throwed if prediction not returning boolean values
     *
     * @param callable $callbackResult
     * @return bool
     */
    public static function errorIfCallbackNotBooleanVal(callable $callbackResult): bool
    {
        return ! is_bool($callbackResult()) ? RE::throw(RME::PREDICTION_MUST_BE_BOOLEAN_RETURNED) : $callbackResult();
    }

    /**
     * Check whether variable are empty or not
     * 
     * @return bool
     */
    public static function isEmpty(mixed $value): bool
    {
        $valueType = gettype($value);

        switch ($valueType) {
            case "string":
                $trimmed = trim($value);
                if (empty($trimmed)) return true;
                return false;
            break; 
            case "NULL":
                if (is_null($value)) return true;
            break;
            case "array":
                if (count($value) === 0) return true;
                return false;
            break;
            default: 
                return true;
        }
    }
}