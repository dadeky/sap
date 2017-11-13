<?php
namespace Sap\Infrastructure;

use BeSimple\SoapClient\SoapClient;

class SoapAdapter implements AdapterInterface
{
	/** @var SoapClient */
	private $client;
	public function __construct(
			$wsdl, $login, $password, $soapVersion
	){
		$this->client = new SoapClient($wsdl, 
		[
			'login'          => $login,
			'password'       => $password,
			'soap_version'   => $soapVersion,
			'cache_wsdl'     => WSDL_CACHE_DISK
		]);
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Sap\Infrastructure\AdapterInterface::getResponse()
	 */
	public function getResponse($methodName, array $arguments) 
	{
		return $this->client->$methodName($arguments);
	}

}