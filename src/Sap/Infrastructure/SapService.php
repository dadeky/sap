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
	    $response->processRawResponse( $rawResponse = $this->adapter->getResponse($request->getMethodName(), $request->getParams()) );
	    
	    if (isset($rawResponse->ErrorList->item) && count($rawResponse->ErrorList->item) > 0)
	    {
	        $errorMessages = [];
	        foreach ($rawResponse->ErrorList as $errItem)
	        {
	            // abort or error should be thrown
	            if ( (string)$errItem->Msgty == ErrorMessage::ERR_TYPE_ERROR || (string)$errItem->Msgty == ErrorMessage::ERR_TYPE_ABORT )
    	            throw new SoapException(
    	                (string)$errItem->Message,
    	                (string)$errItem->Msgno,
    	                (string)$errItem->Msgv1,
    	                (string)$errItem->Msgv2,
    	                (string)$errItem->Msgv3,
    	                (string)$errItem->Msgv4,
    	                (string)$errItem->Msgty,
    	                (string)$errItem->Msgid);
    	        
    	        // info or warning should be set in the response object for later   
    	        $errorMessages[] = new ErrorMessage(
    	            (string)$errItem->Msgty, 
    	            (string)$errItem->Msgno, 
    	            (string)$errItem->Msgid, 
    	            (string)$errItem->Msgv1,
    	            (string)$errItem->Msgv2,
    	            (string)$errItem->Msgv3,
    	            (string)$errItem->Msgv4,
    	            (string)$errItem->Message);
	        }
	        $response->setErrorMessages($errorMessages);
	    }
	    
	    return $response;
	}

}