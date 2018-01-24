<?php
namespace Sap\Domain\Idoc\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class NoIdocCreationParametersAreSetException extends DomainException
{
    private $defaultMessage = 'No parameters for idoc creation are set.';
    
    public function __construct($message=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, []);
    }
}

