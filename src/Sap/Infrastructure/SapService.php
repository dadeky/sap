<?php
namespace Sap\Infrastructure;

use Sap\Domain\RemoteServiceInterface;
use Sap\Domain\RemoteRequestInterface;
use Sap\Domain\RemoteResponseInterface;
use Sap\Infrastructure\Exception\SoapException;
use Sap\Domain\ErrorMessage;

class SapService implements RemoteServiceInterface
{
	/** @var AdapterInterface */
	private $adapter;

	public function __construct(
			AdapterInterface $adapter
	){
		$this->adapter = $adapter;
	}
	
	/**
	 * 
	 * {@inheritDoc}
	 * @see \Sap\Domain\RemoteServiceInterface::execute()
	 */
	public function execute(RemoteRequestInterface $request, RemoteResponseInterface $response) 
	{
	    try {
	        $response->processRawResponse( $rawResponse = $this->adapter->getResponse($request->getMethodName(), $request->getParams()) );
	    }catch (\Exception $ex){
	        throw new SoapException($ex->getMessage());
	    }
	    
        if (isset($rawResponse->ErrorList->item) && count($rawResponse->ErrorList->item) > 0)
        {
            $errorMessages = [];
            foreach ($rawResponse->ErrorList as $errItem)
            {
                // abort or error should be thrown
                if ( (string)$errItem->MSGTY == ErrorMessage::ERR_TYPE_ERROR || (string)$errItem->MSGTY == ErrorMessage::ERR_TYPE_ABORT )
                    throw new SoapException(
                        (string)$errItem->MESSAGE,
                        (string)$errItem->MSGNO,
                        (string)$errItem->MSGV1,
                        (string)$errItem->MSGV2,
                        (string)$errItem->MSGV3,
                        (string)$errItem->MSGV4,
                        (string)$errItem->MSGTY,
                        (string)$errItem->MSGID);
                    
                    // info or warning should be set in the response object for later
                    $errorMessages[] = new ErrorMessage(
                        (string)$errItem->MSGTY,
                        (string)$errItem->MSGNO,
                        (string)$errItem->MSGID,
                        (string)$errItem->MSGV1,
                        (string)$errItem->MSGV2,
                        (string)$errItem->MSGV3,
                        (string)$errItem->MSGV4,
                        (string)$errItem->MESSAGE);
            }
            $response->setErrorMessages($errorMessages);
        }
        return $response;
	}
}