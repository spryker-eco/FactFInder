<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;

class ShoppingCartCampaignsDataProvider extends ProductCampaignsDataProvider
{

    /**
     * @param array $parameters
     *
     * @return array|\Generated\Shared\Transfer\FactFinderSdkDataCampaignIteratorTransfer
     */
    public function buildTemplateData(array $parameters)
    {
        $factFinderProductCampaignRequestTransfer = new FactFinderSdkProductCampaignRequestTransfer();
        $factFinderProductCampaignRequestTransfer->fromArray($parameters, true);

        $factFinderProductCampaignResponseTransfer = $this->factFinderClient
            ->getShoppingCartCampaigns($factFinderProductCampaignRequestTransfer);

        $productCampaigns = $factFinderProductCampaignResponseTransfer->getCampaignIterator()->getCampaigns();

        return $productCampaigns;
    }

}
