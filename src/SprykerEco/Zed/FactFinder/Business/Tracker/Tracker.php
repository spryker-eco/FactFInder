<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinder\Business\Tracker;

use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface;

class Tracker implements TrackerInterface
{
    const CHECKOUT_TRACK_EVENT_NAME = 'checkout';

    /**
     * @var \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface
     */
    protected $factFinderSdkClient;

    /**
     * Tracker constructor.
     *
     * @param \SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface $factFinderSdkClient
     */
    public function __construct(FactFinderSdkClientInterface $factFinderSdkClient)
    {
        $this->factFinderSdkClient = $factFinderSdkClient;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function track(QuoteTransfer $quoteTransfer)
    {
        $trackingRequests = [];

        foreach ($quoteTransfer->getItems() as $item) {
            if (isset($trackingRequests[$item->getSku()])) {
                $trackingRequest = $trackingRequests[$item->getSku()];
                $trackingRequest->setCount($trackingRequest->getCount() + $item->getQuantity());
            } else {
                $trackingRequests[$item->getSku()] = $this->createTrackingRequest($item, $quoteTransfer);
            }
        }
        $this->trackItemsCheckout($trackingRequests);
    }

    /**
     * @param \Generated\Shared\Transfer\ItemTransfer $itemTransfer
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer
     */
    protected function createTrackingRequest(ItemTransfer $itemTransfer, QuoteTransfer $quoteTransfer)
    {
        $trackingRequest = new FactFinderSdkTrackingRequestTransfer();
        $trackingRequest->setEvent(static::CHECKOUT_TRACK_EVENT_NAME);
        $trackingRequest->setSid($quoteTransfer->getCustomer()->getSessionId());
        $trackingRequest->setMasterId($itemTransfer->getAbstractSku());
        $trackingRequest->setId($itemTransfer->getSku());
        $trackingRequest->setCount($itemTransfer->getQuantity());
        $trackingRequest->setPrice($itemTransfer->getUnitPrice() / 100);

        return $trackingRequest;
    }

    /**
     * @param \Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer[] $trackingRequests
     *
     * @return void
     */
    protected function trackItemsCheckout($trackingRequests)
    {
        foreach ($trackingRequests as $trackingRequest) {
            $this->factFinderSdkClient->track($trackingRequest);
        }
    }
}
