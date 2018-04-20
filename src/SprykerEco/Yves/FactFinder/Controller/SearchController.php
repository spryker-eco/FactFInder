<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkSearchRequestTransfer;
use Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer;
use Spryker\Shared\Kernel\Store;
use Spryker\Yves\Kernel\Controller\AbstractController;
use SprykerEco\Shared\FactFinder\FactFinderConstants;
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
        $requestArray[FactFinderConstants::REQUEST_PARAMETER_SID] = $request->getSession()->getId();
        $factFinderSearchRequestTransfer->setRequest($requestArray);

        $ffSearchResponseTransfer = $this->getFactory()
            ->getFactFinderClient()
            ->search($factFinderSearchRequestTransfer);

        $redirectUrl = $this->redirect($ffSearchResponseTransfer);
        if ($redirectUrl !== null) {
            return $this->redirectResponseExternal($redirectUrl);
        }

        $feedbackForm = $this->getFactory()
            ->createFeedbackForm();

        if (!$ffSearchResponseTransfer->getResult()) {
            $this->addErrorMessage('Search is not available at the moment');
        }

        return [
            'searchResponse' => $ffSearchResponseTransfer,
            'pagingRote' => 'fact-finder',
            'lang' => Store::getInstance()->getCurrentLanguage(),
            'query' => isset($requestArray['query']) ? $requestArray['query'] : '',
            'page' => isset($requestArray['page']) ? $requestArray['page'] : '',
            'feedbackForm' => $feedbackForm->createView(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkSearchResponseTransfer $factFinderSdkSearchResponseTransfer
     *
     * @return null|string
     */
    protected function redirect(FactFinderSdkSearchResponseTransfer $factFinderSdkSearchResponseTransfer)
    {
        if ($factFinderSdkSearchResponseTransfer->getCampaignIterator() !== null && $factFinderSdkSearchResponseTransfer->getCampaignIterator()->getHasRedirect()) {
            return $factFinderSdkSearchResponseTransfer->getCampaignIterator()->getRedirectUrl();
        }

        if ($factFinderSdkSearchResponseTransfer->getSearchRedirect() !== null && $factFinderSdkSearchResponseTransfer->getSearchRedirect()->getRedirect() === true) {
            return $factFinderSdkSearchResponseTransfer->getSearchRedirect()->getUrl();
        }

        return null;
    }
}
