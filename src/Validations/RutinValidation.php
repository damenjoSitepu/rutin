<?php 
namespace Damenjo\Rutin\Validations;

class RutinValidation {
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