<?php 
namespace Damenjo\Rutin\Exceptions;

use Exception;

class RutinException extends Exception {
    /**
     * If error happened, display this message (this message 
     * exceptions only available if developer use our 
     * RutinException to trigger the error )
     *
     * @return string
     */
    public function ruinMessage(): string
    {
        return $this->getMessage();
    }
}