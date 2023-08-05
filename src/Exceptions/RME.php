<?php 
namespace Damenjo\Rutin\Exceptions;

abstract class RME {
    public const TIMEZONE_EMPTY = "Timezone argument cannot be empty!";
    public const FORMAT_EMPTY = "Format argument cannot be empty!";
    public const PREDICTION_MUST_BE_BOOLEAN_RETURNED = "The callback prediction must return a boolean value!";
    public const MESSAGE_NAME_NOT_FOUND = "Error message name are not found!";
    public const INVALID_DATE_ELEMENT = "Invalid date element argument";
}