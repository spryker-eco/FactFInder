<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Dependency\Clients;

use Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;

class FactFinderToFactFinderClientBridge implements FactFinderToFactFinderClientInterface
{
    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface
     */
    protected $factFinderClient;

    /**
     * FactFinderDemoToFactFinderClientBridge constructor.
     *
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface $factFinderClient
     */
    public function __construct($factFinderClient)
    {
        $this->factFinderClient = $factFinderClient;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer
     */
    public function search(FactFinderSdkSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        return $this->factFinderClient
            ->search($factFinderSearchRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkRecommendationResponseTransfer
     */
    public function getRecommendations(FactFinderSdkRecommendationRequestTransfer $factFinderRecommendationRequestTransfer)
    {
        return $this->factFinderClient
            ->getRecommendations($factFinderRecommendationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkSuggestResponseTransfer
     */
    public function getSuggestions(FactFinderSdkSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        return $this->factFinderClient
            ->getSuggestions($factFinderSuggestRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingResponseTransfer
     */
    public function track(FactFinderSdkTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        return $this->factFinderClient
            ->track($factFinderTrackingRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function getProductCampaigns(FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer)
    {
        return $this->factFinderClient
            ->getProductCampaigns($factFinderSdkProductCampaignRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkProductCampaignResponseTransfer
     */
    public function getShoppingCartCampaigns(FactFinderSdkProductCampaignRequestTransfer $factFinderSdkProductCampaignRequestTransfer)
    {
        return $this->factFinderClient
            ->getShoppingCartCampaigns($factFinderSdkProductCampaignRequestTransfer);
    }
}
