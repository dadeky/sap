<?php
namespace Sap\Domain;

use src\Sap\Domain\RemoteResponseInterface;

interface RemoteServiceInterface 
{
	/**
	 * @param RemoteRequestInterface $request
	 * @param class $responseClass
	 * @return RemoteResponseInterface
	 */
    public function execute(RemoteRequestInterface $request, $responseClass);
}