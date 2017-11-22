<?php
namespace Sap\Domain;

interface RemoteResponseInterface
{
    /**
     * @param \stdClass $rawResponse
     */
    public function processRawResponse(\stdClass $rawResponse);
    
    /**
     * @return ErrorMessage[]
     */
    public function getErrorMessages();
    
    /**
     * 
     * @param ErrorMessage[] $errorMessages
     */
    public function setErrorMessages(array $errorMessages);
}

