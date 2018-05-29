<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class ProductCampaignsDataProvider extends AbstractDataProvider implements ProductCampaignsDataProviderInterface
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
            ->getProductCampaigns($factFinderProductCampaignRequestTransfer);

        $productCampaigns = $factFinderProductCampaignResponseTransfer->getCampaignIterator()->getCampaigns();

        return $productCampaigns;
    }
}
