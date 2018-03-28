<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;

class RecommendationsDataProvider extends AbstractDataProvider implements RecommendationsDataProviderInterface
{
    /**
     * @param array $parameters
     *
     * @return \Generated\Shared\Transfer\StorageProductAbstractRelationTransfer[]
     */
    public function buildTemplateData(array $parameters)
    {
        $this->addSessionId($parameters);
        $recommendations = [];

        $factFinderRecommendationRequestTransfer = new FactFinderSdkRecommendationRequestTransfer();
        $factFinderRecommendationRequestTransfer->fromArray($parameters, true);

        if ($factFinderRecommendationRequestTransfer->getId() === null) {
            return $recommendations;
        }

        $factFinderRecommendationsResponseTransfer = $this->factFinderClient
            ->getRecommendations($factFinderRecommendationRequestTransfer);

        $recommendations = $factFinderRecommendationsResponseTransfer->getRecommendations();

        return $recommendations;
    }
}
