<?php
namespace Sap\Domain\Idoc\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class NoQosParameterIsSetException extends DomainException
{
    private $defaultMessage = 'No qos parameter for idoc creation is set.';
    
    public function __construct($message=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, []);
    }
}

