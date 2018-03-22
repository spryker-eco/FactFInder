<?php

namespace SprykerEco\Zed\FactFinder\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\FactFinder\Business\Tracker\Tracker;
use SprykerEco\Zed\FactFinder\Business\Tracker\TrackerInterface;
use SprykerEco\Zed\FactFinder\FactFinderDependencyProvider;

class FactFinderBusinessFactory extends AbstractBusinessFactory
{

    /**
     * @return TrackerInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createTracker()
    {
        return new Tracker($this->getFactFinderSdkClient());
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getFactFinderSdkClient()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::FACT_FINDER_SDK_CLIENT);
    }

}