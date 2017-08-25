<?php
namespace src\Sap\Domain;

use Sap\Domain\ErrorMessage;

interface RemoteResponseInterface
{
    public function __construct(\stdClass $rawResponse);
    
    /**
     * @return ErrorMessage[]
     */
    public function getErrorMessages();
}

