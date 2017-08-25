<?php
namespace src\Sap\Domain;

use Sap\Domain\ErrorMessage;

interface RemoteResponseInterface
{
    /**
     * @return ErrorMessage[]
     */
    public function getErrorMessages();
}

