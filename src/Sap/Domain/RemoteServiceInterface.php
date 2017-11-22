<?php
namespace Sap\Domain;

interface RemoteServiceInterface 
{
	/**
	 * @param RemoteRequestInterface $request
	 * @param RemoteResponseInterface $response
	 * @return RemoteResponseInterface
	 */
    public function execute(RemoteRequestInterface $request, RemoteResponseInterface $response);
}