<?php
namespace Sap\Domain\Idoc\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class NoPathParameterIsSetException extends DomainException
{
    private $defaultMessage = 'No path parameter for idoc creation is set.';
    
    public function __construct($message=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, []);
    }
}

