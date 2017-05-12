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

interface FactFinderToFactFinderClientInterface
{

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSearchResponseTransfer
     */
    public function search(FactFinderApiSearchRequestTransfer $factFinderSearchRequestTransfer);

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiRecommendationResponseTransfer
     */
    public function getRecommendations(FactFinderApiRecommendationRequestTransfer $factFinderRecommendationRequestTransfer);

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiSuggestResponseTransfer
     */
    public function getSuggestions(FactFinderApiSuggestRequestTransfer $factFinderSuggestRequestTransfer);

    /**
     * @param \Generated\Shared\Transfer\FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderApiTrackingResponseTransfer
     */
    public function track(FactFinderApiTrackingRequestTransfer $factFinderTrackingRequestTransfer);

}
