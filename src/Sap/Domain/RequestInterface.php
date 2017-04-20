<?php
namespace Sap\Domain;

interface RequestInterface 
{
	public function getMethodName();
	
	public function toSapParams();
}