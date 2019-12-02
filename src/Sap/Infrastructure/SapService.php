<?php
namespace Sap\Infrastructure;

use Sap\Domain\RemoteServiceInterface;
use Sap\Domain\RemoteRequestInterface;
use Sap\Domain\RemoteResponseInterface;
use Sap\Infrastructure\Exception\SoapException;
use Sap\Domain\ErrorMessage;
use Sap\Domain\Exception\Constants;
use Sap\Infrastructure\Exception\BatchNumberNotUniqueException;

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
	    
	    if (isset($rawResponse->ErrorList->item)){
	        $errItems = is_array($rawResponse->ErrorList->item) ? $rawResponse->ErrorList->item : [$rawResponse->ErrorList->item];
	        if (count($errItems) > 0)
	        {
	            $errorMessages = [];
	            foreach ($errItems as $errItem)
	            {
	                $Msgty = property_exists($errItem, "Msgty") ? $errItem->Msgty : $errItem->MSGTY;
	                $Message = property_exists($errItem, "Message") ? $errItem->Message : $errItem->MESSAGE;
	                $Msgno = property_exists($errItem, "Msgno") ? $errItem->Msgno : $errItem->MSGNO;
	                $Msgv1 = property_exists($errItem, "Msgv1") ? $errItem->Msgv1 : $errItem->MSGV1;
	                $Msgv2 = property_exists($errItem, "Msgv2") ? $errItem->Msgv2 : $errItem->MSGV2;
	                $Msgv3 = property_exists($errItem, "Msgv3") ? $errItem->Msgv3 : $errItem->MSGV3;
	                $Msgv4 = property_exists($errItem, "Msgv4") ? $errItem->Msgv4 : $errItem->MSGV4;
	                $Msgid = property_exists($errItem, "Msgid") ? $errItem->Msgid : $errItem->MSGID;
	                
	                // abort or error should be thrown
	                if ( $Msgty == ErrorMessage::ERR_TYPE_ERROR || $Msgty == ErrorMessage::ERR_TYPE_ABORT ){
	                    // if batch is not unique
	                    if ( $Msgno == Constants::BATCH_NUMBER_NOT_UNIQUE ){
	                        throw new BatchNumberNotUniqueException( $Msgv1 );
	                    }
	                    
	                    throw new SoapException( $Message, $Msgno, $Msgv1, $Msgv2, $Msgv3, $Msgv4, $Msgid );
	                }
	                
	                // info or warning should be set in the response object for later
	                $errorMessages[] = new ErrorMessage( $Msgty, $Msgno, $Msgid, $Msgv1, $Msgv2, $Msgv3, $Msgv4, $Message );
	            }
	            $response->setErrorMessages($errorMessages);
	        }
	    }
	    
	    return $response;
	}
}
