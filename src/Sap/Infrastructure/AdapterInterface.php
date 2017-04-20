<?php
namespace Sap\Infrastructure;

use Sap\Domain\Response;

interface AdapterInterface 
{
	/**
	 * @param string $methodName
	 * @param array $arguments
	 * @return Response
	 */
	public function getResponse($methodName, array $arguments);
}