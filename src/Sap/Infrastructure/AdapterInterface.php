<?php
namespace Sap\Infrastructure;

interface AdapterInterface 
{
	/**
	 * @param string $methodName
	 * @param array $arguments
	 */
	public function getResponse($methodName, array $arguments);
}