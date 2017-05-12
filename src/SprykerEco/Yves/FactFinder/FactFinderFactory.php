<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder;

use Spryker\Yves\Kernel\AbstractFactory;

class FactFinderFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\FactFinderApi\FactFinderApiClient
     */
    public function getFactFinderClient()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::FACT_FINDER_CLIENT);
    }

}
