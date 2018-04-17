<?php
namespace Sap\Infrastructure\Exception;

use Dadeky\Ddd\Domain\Exception\DomainException;

class SoapException extends DomainException
{
    private $msgNo;
    private $msgv1;
    private $msgv2;
    private $msgv3;
    private $msgv4;
    private $msgty; 
    private $msgid;
    
    private $defaultMessage = 'SOAP error: %1$s %2$s %3$s %4$s %5$s';
    
    public function __construct($message=null, $msgNo=null, $msgv1=null, $msgv2=null, $msgv3=null, $msgv4=null, $msgty=null, $msgid=null)
    {
        parent::__construct((null === $message) ? $this->defaultMessage : $message, [$msgNo, $msgv1, $msgv2, $msgv3, $msgv4, $msgty, $msgid]);
        $this->msgNo = $msgNo;
        $this->msgv1 = $msgv1;
        $this->msgv2 = $msgv2;
        $this->msgv3 = $msgv3;
        $this->msgv4 = $msgv4;
        $this->msgty = $msgty;
        $this->msgid = $msgid;
    }
    
    public function getMsgNo()
    {
        return $this->msgNo;
    }

    public function getMsgv1()
    {
        return $this->msgv1;
    }

    public function getMsgv2()
    {
        return $this->msgv2;
    }

    public function getMsgv3()
    {
        return $this->msgv3;
    }

    public function getMsgv4()
    {
        return $this->msgv4;
    }

    public function getMsgty()
    {
        return $this->msgty;
    }

    public function getMsgid()
    {
        return $this->msgid;
    }

    public function getDefaultMessage()
    {
        return $this->defaultMessage;
    }
}

