<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\Controller;

use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

/**
 * @method \SprykerEco\Yves\FactFinder\FactFinderFactory getFactory()
 */
class TrackController extends AbstractController
{

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function indexAction(Request $request)
    {
        $factFinderTrackingRequestTransfer = new FactFinderSdkTrackingRequestTransfer();
        $factFinderTrackingRequestTransfer->fromArray($request->query->all());

        $sessionId = $request->getSession()->getId();
        $factFinderTrackingRequestTransfer->setSid($sessionId);

        $factFinderTrackingResponseTransfer = $this->getFactory()
            ->getFactFinderClient()
            ->track($factFinderTrackingRequestTransfer);

        if (!$factFinderTrackingResponseTransfer->getResult()) {
            return $this->jsonResponse(null, 400);
        }

        return $this->jsonResponse();
    }

}
