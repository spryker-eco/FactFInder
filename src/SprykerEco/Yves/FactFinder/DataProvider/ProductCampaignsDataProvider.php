<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientInterface;

class ProductCampaignsDataProvider implements ProductCampaignsDataProviderInterface
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
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer[]
     */
    public function buildTemplateData(array $parameters)
    {
        $factFinderProductCampaignRequestTransfer = new FactFinderSdkProductCampaignRequestTransfer();
        $factFinderProductCampaignRequestTransfer->fromArray($parameters, true);

        $factFinderProductCampaignResponseTransfer = $this->factFinderClient
            ->getProductCampaigns($factFinderProductCampaignRequestTransfer);

        $productCampaigns = $factFinderProductCampaignResponseTransfer->getCampaignIterator()->getCampaigns();

        return $productCampaigns;
    }

}
