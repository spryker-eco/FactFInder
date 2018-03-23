<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkRecommendationRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Yves\FactFinder\FactFinderFactory getFactory()
 */
class RecommendationsController extends AbstractController
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $factFinderRecommendationRequestTransfer = new FactFinderSdkRecommendationRequestTransfer();
        $factFinderRecommendationRequestTransfer->fromArray($request->query->all());

        $factFinderRecommendationsResponseTransfer = $this->getFactory()
            ->getFactFinderClient()
            ->getRecommendations($factFinderRecommendationRequestTransfer);

        if (!$factFinderRecommendationsResponseTransfer->getRecommendations()) {
            return $this->jsonResponse(null, 400);
        }
        $recommendations = $factFinderRecommendationsResponseTransfer->getRecommendations();

        return $this->jsonResponse($recommendations);
    }
}
