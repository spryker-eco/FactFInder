<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinderDemo;

use Spryker\Yves\Kernel\AbstractFactory;

class FactFinderDemoFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Client\FactFinder\FactFinderClient
     */
    public function getFactFinderClient()
    {
        return $this->getProvidedDependency(FactFinderDemoDependencyProvider::FACT_FINDER_CLIENT);
    }

}
