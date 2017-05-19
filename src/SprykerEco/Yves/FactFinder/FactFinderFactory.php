<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder;

use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\FactFinder\DataProvider\RecommendationsDataProvider;

class FactFinderFactory extends AbstractFactory
{

    /**
     * @return \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface
     */
    public function getFactFinderClient()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::FACT_FINDER_CLIENT);
    }

    /**
     * @return \SprykerEco\Yves\FactFinder\DataProvider\RecommendationsDataProviderInterface
     */
    public function createRecommendationsDataProvider()
    {
        return new RecommendationsDataProvider(
            $this->getFactFinderClient()
        );
    }

}
