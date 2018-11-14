<?php
namespace Sap\Infrastructure;

use BeSimple\SoapClient\SoapClient;

class SoapAdapter implements AdapterInterface
{
	/** @var SoapClient */
	private $client;
	
	/** @var string */
	private $error;

	public function __construct(
		$wsdl,
		$login,
		$password,
		$soapVersion,
		$connTimeout = 60
	){	    
	    try{
    		$this->client = new SoapClient($wsdl, 
    		[
    			'login'          => $login,
    			'password'       => $password,
    			'soap_version'   => $soapVersion,
    			'cache_wsdl'     => WSDL_CACHE_DISK,
			'connection_timeout' => $connTimeout,
    		]);
	    } catch (\Exception $e) {
	        $this->error = $e->getMessage();
	    }
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Sap\Infrastructure\AdapterInterface::getResponse()
	 */
	public function getResponse($methodName, array $arguments) 
	{
	    return empty($this->error) ? $this->client->$methodName($this->prepareArguments($arguments)) : new \stdClass();
	}

	/**
	 * If the arg is null change to ''
	 * @param array $arguments
	 */
	private function prepareArguments(array $arguments)
	{
	    foreach ($arguments as &$argValue)
	    {
	        $argValue = null === $argValue ? '' : $argValue;
	    }
	    return $arguments;
	}
}
