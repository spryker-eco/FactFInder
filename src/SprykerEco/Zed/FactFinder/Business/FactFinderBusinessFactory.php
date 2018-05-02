<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinder\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\FactFinder\Business\Tracker\Tracker;
use SprykerEco\Zed\FactFinder\FactFinderDependencyProvider;

class FactFinderBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\FactFinder\Business\Tracker\TrackerInterface
     */
    public function createTracker()
    {
        return new Tracker($this->getFactFinderSdkClient());
    }

    /**
     * @return \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface
     */
    protected function getFactFinderSdkClient()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::FACT_FINDER_SDK_CLIENT);
    }
}
