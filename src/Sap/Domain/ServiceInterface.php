<?php
namespace Sap\Domain;

interface ServiceInterface 
{
	/**
	 * 
	 * @param SapRequestInterface $request
	 */
	public function execute(RequestInterface $request);
}