<?php
namespace Sap\Infrastructure\Idoc;

use GuzzleHttp\Client;
use Sap\Domain\Idoc\AbstractIdocCreator;
use Sap\Domain\Idoc\IdocCreatorParameters;
use Sap\Domain\Idoc\Exception\NoInterfaceNameParameterIsSetException;
use Sap\Domain\Idoc\Exception\NoQosParameterIsSetException;
use Sap\Domain\Idoc\Exception\NoInterfaceNamespaceParameterIsSetException;

class HttpIdocCreator extends AbstractIdocCreator
{
    const NON_SEQUENTIAL_TRANSFER = 'EO';
    const SEQUENTIAL_TRANSFER = 'EOIO';
    
    const TYPE = AbstractIdocCreator::EXPORT_TYPE_HTTP;
    
    /** @var Client */
    private $client;
    private $uri;
    private $senderServiceName;
    
    public function __construct(
        $baseUri,
        $timeout,
        $username,
        $password,
        $uri,
        $senderServiceName
    ){
        $this->client = new Client(
            ['base_uri' => $baseUri,
                'timeout' => $timeout,
                'allow_redirects' => false,
                'auth' => [$username, $password]]);
        $this->uri = $uri;
        $this->senderServiceName = $senderServiceName;
    }
    
    /**
     * {@inheritDoc}
     * @see \Sap\Domain\Idoc\AbstractIdocCreator::createIdoc()
     */
    public function createIdoc($idocContent, $fileName=null)
    {
        if (null === $this->idocCreatorParameters->getInterfaceName())
            throw new NoInterfaceNameParameterIsSetException();
        
        if (null === $this->idocCreatorParameters->getQos())
            throw new NoQosParameterIsSetException();
        
        if (null === $this->idocCreatorParameters->getInterfaceNamespace())
            throw new NoInterfaceNamespaceParameterIsSetException();
        
        $this->client->post(
            $this->uri,
            [
                'body' => $idocContent,
                'headers'  => [
                    'Content-Type' => 'text/xml',
                ],
                'query' => [
                    'senderService' => $this->senderServiceName,
                    'interfaceNamespace' => $this->idocCreatorParameters->getInterfaceNamespace(),
                    'interface' => $this->idocCreatorParameters->getInterfaceName(),
                    'qos' => $this->idocCreatorParameters->getQos(),
                    'queueid' => $this->idocCreatorParameters->getQueueid()
                ]
            ]);
    }
    
    /**
     * {@inheritDoc}
     * @see \Sap\Domain\Idoc\AbstractIdocCreator::getType()
     */
    public function getType()
    {
        return self::TYPE;
    }
    
    /**
     * {@inheritDoc}
     * @see \Sap\Domain\Idoc\AbstractIdocCreator::setParameters()
     */
    public function setParameters(IdocCreatorParameters $idocCreatorParameters)
    {
        $this->idocCreatorParameters = $idocCreatorParameters;
        return $this;
    }

}

