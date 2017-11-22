<?php
namespace Sap\Infrastructure\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class SoapException extends DomainException
{
    private $defaultMessage = 'SOAP error: %1$s %2$s %3$s %4$s %5$s';
    
    public function __construct($message=null, $msgNo=null, $msgv1=null, $msgv2=null, $msgv3=null, $msgv4=null, $msgty=null, $msgid=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, [$msgNo, $msgv1, $msgv2, $msgv3, $msgv4, $msgty, $msgid]);
    }
}

