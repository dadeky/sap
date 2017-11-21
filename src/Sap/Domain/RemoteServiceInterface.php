<?php
namespace Sap\Domain;

use src\Sap\Domain\RemoteResponseInterface;

interface RemoteServiceInterface 
{
	/**
	 * @param RemoteRequestInterface $request
	 * @param string $responseClassName FQCN of a class
	 * @return RemoteResponseInterface
	 */
    public function execute(RemoteRequestInterface $request, $responseClassName);
}