<?php 
namespace Damenjo\Rutin\Exceptions;

use Exception;

class RutinException extends Exception {
    /**
     * If error happens, display this custom message
     *
     * @return string
     */
    public function ruinMessage(): string
    {
        return $this->getMessage();
    }
}