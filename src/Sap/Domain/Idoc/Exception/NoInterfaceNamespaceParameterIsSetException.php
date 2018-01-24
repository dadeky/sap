<?php
namespace Sap\Domain\Idoc\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class NoInterfaceNamespaceParameterIsSetException extends DomainException
{
    private $defaultMessage = 'No interface namespace parameter for idoc creation is set.';
    
    public function __construct($message=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, []);
    }
}

