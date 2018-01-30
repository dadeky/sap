<?php
namespace Sap\Infrastructure\Idoc;

use File\CreatorService;
use Sap\Domain\Idoc\AbstractIdocCreator;
use Sap\Domain\Idoc\IdocCreatorParameters;
use Sap\Domain\Idoc\Exception\NoPathParameterIsSetException;

class FileIdocCreator extends AbstractIdocCreator
{
    const TYPE = AbstractIdocCreator::EXPORT_TYPE_FILE;
    
    private $creatorService;
    
    public function createIdoc($idocContent, $fileName=null)
    {
        if (null === $this->idocCreatorParameters->getPath())
            throw new NoPathParameterIsSetException();
        
        $this->creatorService = new CreatorService($this->idocCreatorParameters->getPath());
        
        if (null === $fileName)
            $fileName = (new \DateTime())->format('Ymd-his-u');
        
        $this->creatorService->createFile(
            $fileName,
            $idocContent);
    }
    
    public function getType()
    {
        return self::TYPE;
    }
    
    public function setParameters(IdocCreatorParameters $idocCreatorParameters)
    {
        $this->idocCreatorParameters = $idocCreatorParameters;
        return $this;
    }

}

