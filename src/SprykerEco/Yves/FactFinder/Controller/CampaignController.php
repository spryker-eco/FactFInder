<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Yves\FactFinder\FactFinderFactory getFactory()
 */
class CampaignController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $factFinderProductCampaignRequestTransfer = new FactFinderSdkProductCampaignRequestTransfer();
        $factFinderProductCampaignRequestTransfer->fromArray($request->query->all());

        $factFinderProductCampaignResponseTransfer = $this->getFactory()
            ->getFactFinderClient()
            ->getProductCampaigns($factFinderProductCampaignRequestTransfer);

        if (!$factFinderProductCampaignResponseTransfer->getCampaigns()) {
            return $this->jsonResponse(null, 400);
        }
        $campaigns = $factFinderProductCampaignResponseTransfer->getCampaigns();

        return $this->jsonResponse($campaigns);
    }
}
