<?php
namespace Sap\Domain\Idoc;

abstract class AbstractIdocCreator
{
    const EXPORT_TYPE_FILE = 'file';
    const EXPORT_TYPE_HTTP = 'http';
    
    /** @var IdocCreatorParameters */
    protected $idocCreatorParameters;
    
    abstract public function createIdoc($idocContent);
    abstract public function getType();
    /**
     * @param IdocCreatorParameters $idocCreatorParameters
     * @return self
     */
    abstract public function setParameters(IdocCreatorParameters $idocCreatorParameters);
}

