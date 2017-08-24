<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Yves\FactFinder\FactFinderFactory getFactory()
 */
class SearchController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $factFinderSearchRequestTransfer = new FactFinderSdkSearchRequestTransfer();
        $requestArray = $request->query->all();
        $factFinderSearchRequestTransfer->setRequest($requestArray);

        $ffSearchResponseTransfer = $this->getFactory()
            ->getFactFinderClient()
            ->search($factFinderSearchRequestTransfer);

        $feedbackForm = $this->getFactory()
            ->createFeedbackForm();

        return [
            'searchResponse' => $ffSearchResponseTransfer,
            'pagingRote' => 'fact-finder',
            'lang' => Store::getInstance()->getCurrentLanguage(),
            'query' => isset($requestArray['query']) ? $requestArray['query'] : '',
            'page' => isset($requestArray['page']) ? $requestArray['page'] : '',
            'feedbackForm' => $feedbackForm->createView(),
        ];
    }

}
