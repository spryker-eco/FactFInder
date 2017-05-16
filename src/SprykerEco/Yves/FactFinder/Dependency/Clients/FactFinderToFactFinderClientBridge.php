<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Dependency\Clients;

use Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer;
use Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer;

class FactFinderToFactFinderClientBridge implements FactFinderToFactFinderClientInterface
{

    /**
     * @var \SprykerEco\Client\FactFinderApi\FactFinderApiClientInterface
     */
    protected $factFinderClient;

    /**
     * FactFinderDemoToFactFinderClientBridge constructor.
     *
     * @param \SprykerEco\Client\FactFinderApi\FactFinderApiClientInterface $factFinderClient
     */
    public function __construct($factFinderClient)
    {
        $this->factFinderClient = $factFinderClient;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSearchResponseTransfer
     */
    public function search(FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer)
    {
        return $this->factFinderClient
            ->search($factFinderSearchRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function getRecommendations(FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer)
    {
        return $this->factFinderClient
            ->getRecommendations($factFinderRecommendationRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSuggestResponseTransfer
     */
    public function getSuggestions(FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer)
    {
        return $this->factFinderClient
            ->getSuggestions($factFinderSuggestRequestTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function track(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer)
    {
        return $this->factFinderClient
            ->track($factFinderTrackingRequestTransfer);
    }

}
