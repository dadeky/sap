<?php
namespace Sap\Domain\Idoc;

trait IdocCreatingTrait 
{
    /** @var AbstractIdocCreator[] */
    private $createIdocServices;
    
    /**
     * @param string $serviceType
     * @return AbstractIdocCreator|NULL
     */
    protected function getIdocService($serviceType)
    {
        foreach ($this->createIdocServices as $service)
        {
            if ($service->getType() == $serviceType)
                return $service;
        }
        return null;
    }
}

