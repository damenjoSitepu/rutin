<?php 
declare(strict_types=1);

namespace Damenjo\Rutin\Exceptions;

class RE {
    /**
     * Default error message if no message has been inserted
     * 
     * @var string
     */
    private const DEFAULT_ERROR_MESSAGE = "Something went wrong to our package :(";

    /**
     * Throw an error to trigger RutinException
     *
     * @return void
     */
    public static function throw(string $errorMessage = self::DEFAULT_ERROR_MESSAGE): void
    {
        throw new RutinException(self::checkEmptyMessage($errorMessage));
    } 

    /**
     * Check empty message
     *
     * @param string $errorMessage
     * @return string
     */
    private static function checkEmptyMessage(string $errorMessage): string
    {
        if (empty($errorMessage)) {
            return self::DEFAULT_ERROR_MESSAGE;
        }
        $errorMessage = trim($errorMessage);
        if (empty($errorMessage)) {
            return self::DEFAULT_ERROR_MESSAGE;
        }   
        return $errorMessage;
    }
}