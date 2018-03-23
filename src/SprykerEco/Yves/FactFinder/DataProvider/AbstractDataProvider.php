<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use SprykerEco\Shared\FactFinder\FactFinderConstants;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToSessionClientInterface;

abstract class AbstractDataProvider
{
    /**
     * @var \Spryker\Client\Session\SessionClientInterface
     */
    protected $sessionClient;

    /**
     * @var \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface
     */
    protected $factFinderClient;

    /**
     * @param \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface $factFinderClient
     * @param \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToSessionClientInterface $sessionClient
     */
    public function __construct(
        FactFinderToFactFinderClientInterface $factFinderClient,
        FactFinderToSessionClientInterface $sessionClient
    ) {
        $this->factFinderClient = $factFinderClient;
        $this->sessionClient = $sessionClient;
    }

    /**
     * @param array $parameters
     *
     * @return void
     */
    protected function addSessionId(array &$parameters)
    {
        if (empty($parameters[FactFinderConstants::REQUEST_PARAMETER_SID])) {
            $parameters[FactFinderConstants::REQUEST_PARAMETER_SID] = $this->sessionClient->getId();
        }
    }
}
