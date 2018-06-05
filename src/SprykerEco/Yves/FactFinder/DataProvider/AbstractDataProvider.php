<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use SprykerEco\Shared\FactFinder\FactFinderConstants;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractDataProvider
{
    /**
     * @var \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface
     */
    protected $factFinderClient;

    /**
     * @param \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface $factFinderClient
     */
    public function __construct(FactFinderToFactFinderClientInterface $factFinderClient)
    {
        $this->factFinderClient = $factFinderClient;
    }

    /**
     * @param array $parameters
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return void
     */
    protected function addSessionId(array &$parameters, Request $request)
    {
        if (empty($parameters[FactFinderConstants::REQUEST_PARAMETER_SID])) {
            $parameters[FactFinderConstants::REQUEST_PARAMETER_SID] = $request->cookies->get(FactFinderConstants::COOKIE_SID_NAME);
        }
    }
}
