<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkSuggestRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Yves\FactFinder\FactFinderFactory getFactory()
 */
class SuggestionsController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function indexAction(Request $request)
    {
        $factFinderSuggestRequestTransfer = new FactFinderSdkSuggestRequestTransfer();
        $query = $request->query->get('query', '*');

        $factFinderSuggestRequestTransfer->setQuery($query);

        $response = $this->getFactory()
            ->getFactFinderClient()
            ->getSuggestions($factFinderSuggestRequestTransfer);

        return $this->jsonResponse($response->getSuggestions());
    }

}
