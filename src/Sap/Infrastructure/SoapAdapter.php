<?php
namespace Sap\Infrastructure;

class SoapAdapter implements AdapterInterface
{
	/** @var \SoapClient */
	private $client;
	public function __construct(
			$wsdl, $login, $password, $soapVersion
	){
		$this->client = new \SoapClient($wsdl, 
		[
			'login'=>$login,
			'password'=>$password,
			'soap_version'=>$soapVersion
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