<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder;

use Spryker\Shared\Application\ApplicationConstants;
use Spryker\Yves\Kernel\AbstractFactory;
use SprykerEco\Yves\FactFinder\DataProvider\ProductCampaignsDataProvider;
use SprykerEco\Yves\FactFinder\DataProvider\RecommendationsDataProvider;
use SprykerEco\Yves\FactFinder\DataProvider\ShoppingCartCampaignsDataProvider;
use SprykerEco\Yves\FactFinder\Form\SearchResultFeedbackForm;

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
     * @return \SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToSessionClientInterface
     */
    public function getSessionClient()
    {
        return $this->getProvidedDependency(FactFinderDependencyProvider::SESSION_CLIENT);
    }

    /**
     * @return \SprykerEco\Yves\FactFinder\DataProvider\RecommendationsDataProviderInterface
     */
    public function createRecommendationsDataProvider()
    {
        return new RecommendationsDataProvider(
            $this->getFactFinderClient(),
            $this->getSessionClient()
        );
    }

    /**
     * @return \SprykerEco\Yves\FactFinder\DataProvider\ProductCampaignsDataProviderInterface
     */
    public function createProductCampaignsDataProvider()
    {
        return new ProductCampaignsDataProvider(
            $this->getFactFinderClient()
        );
    }

    /**
     * @return \SprykerEco\Yves\FactFinder\DataProvider\ShoppingCartCampaignsDataProvider
     */
    public function createShoppingCartCampaignsDataProvider()
    {
        return new ShoppingCartCampaignsDataProvider(
            $this->getFactFinderClient()
        );
    }

    /**
     * @return \SprykerEco\Yves\FactFinder\Form\SearchResultFeedbackForm
     */
    public function createFeedbackForm()
    {
        return $this->getProvidedDependency(ApplicationConstants::FORM_FACTORY)
            ->create(SearchResultFeedbackForm::class);
    }
}
