<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class ShoppingCartCampaignsDataProvider extends AbstractDataProvider implements ShoppingCartCampaignsDataProviderInterface
{
    /**
     * @param array $parameters
     * @param Request $request
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer[]
     */
    public function buildTemplateData(array $parameters, Request $request)
    {
        $this->addSessionId($parameters, $request);

        $factFinderProductCampaignRequestTransfer = new FactFinderSdkProductCampaignRequestTransfer();
        $factFinderProductCampaignRequestTransfer->fromArray($parameters, true);

        $factFinderProductCampaignResponseTransfer = $this->factFinderClient
            ->getShoppingCartCampaigns($factFinderProductCampaignRequestTransfer);

        $productCampaigns = $factFinderProductCampaignResponseTransfer->getCampaignIterator()->getCampaigns();

        return $productCampaigns;
    }
}
