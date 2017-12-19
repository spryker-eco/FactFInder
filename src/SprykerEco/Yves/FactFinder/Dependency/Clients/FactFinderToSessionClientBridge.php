<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Dependency\Clients;

use Spryker\Client\Session\SessionClientInterface;

class FactFinderToSessionClientBridge implements FactFinderToSessionClientInterface
{

    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClient;

    /**
     * FactFinderToSessionClientBridge constructor.
     *
     * @param \Spryker\Client\Session\SessionClientInterface $sessionClient
     */
    public function __construct(SessionClientInterface $sessionClient)
    {
        $this->sessionClient = $sessionClient;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->sessionClient->getId();
    }

}
