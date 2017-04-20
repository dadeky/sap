<?php
namespace Sap\Infrastructure;

use Sap\Domain\ServiceInterface;
use Sap\Domain\RequestInterface;

class SapService implements ServiceInterface
{
	/** @var AdapterInterface */
	private $adapter;
	public function __construct(
			AdapterInterface $adapter
	){
		$this->adapter = $adapter;
	}
	
	/**
	 * {@inheritDoc}
	 * @see \Sap\Domain\ServiceInterface::execute()
	 */
	public function execute(RequestInterface $request) 
	{
		return $this->adapter->getResponse($request->getMethodName(), $request->getSapParams());
	}

}