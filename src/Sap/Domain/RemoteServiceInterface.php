<?php
namespace Sap\Domain;

interface RemoteServiceInterface 
{
	/**
	 * 
	 * @param SapRequestInterface $request
	 */
	public function execute(RemoteRequestInterface $request);
}