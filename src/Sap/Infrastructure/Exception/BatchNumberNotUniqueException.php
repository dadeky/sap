<?php
namespace Sap\Infrastructure\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class BatchNumberNotUniqueException extends DomainException
{
    private $defaultMessage = 'Batch number %1$s is not unique.';
    
    public function __construct($message=null, $batchNr)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, [$batchNr]);
    }
}