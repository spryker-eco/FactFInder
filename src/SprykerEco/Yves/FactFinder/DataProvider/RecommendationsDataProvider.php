<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;
use Symfony\Component\HttpFoundation\Request;

class RecommendationsDataProvider extends AbstractDataProvider implements RecommendationsDataProviderInterface
{
    /**
     * @param array $parameters
     * @param Request $request
     *
     * @return \Generated\Shared\Transfer\StorageProductAbstractRelationTransfer[]
     */
    public function buildTemplateData(array $parameters, Request $request)
    {
        $this->addSessionId($parameters, $request);
        $recommendations = [];

        $factFinderRecommendationRequestTransfer = new FactFinderSdkRecommendationRequestTransfer();
        $factFinderRecommendationRequestTransfer->fromArray($parameters, true);

        if ($factFinderRecommendationRequestTransfer->getId() === null || empty($factFinderRecommendationRequestTransfer->getId())) {
            return $recommendations;
        }

        $factFinderRecommendationsResponseTransfer = $this->factFinderClient
            ->getRecommendations($factFinderRecommendationRequestTransfer);

        $recommendations = $factFinderRecommendationsResponseTransfer->getRecommendations();

        return $recommendations;
    }
}
