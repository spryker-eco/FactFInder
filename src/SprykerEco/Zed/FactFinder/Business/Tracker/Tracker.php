<?php

namespace SprykerEco\Zed\FactFinder\Business\Tracker;

use Generated\Shared\Transfer\FactFinderSdkTrackingRequestTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use SprykerEco\Client\FactFinderSdk\FactFinderSdkClientInterface;
use SprykerEco\Shared\FactFinder\FactFinderConstants;
use SprykerEco\Shared\FactFinderSdk\FactFinderSdkConstants;

class Tracker implements TrackerInterface
{

    /**
     * @var FactFinderSdkClientInterface
     */
    protected $factFinderSdkClient;

    /**
     * Tracker constructor.
     * @param FactFinderSdkClientInterface $factFinderSdkClient
     */
    public function __construct(FactFinderSdkClientInterface $factFinderSdkClient)
    {
        $this->factFinderSdkClient = $factFinderSdkClient;
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     * @return void
     */
    public function track(QuoteTransfer $quoteTransfer)
    {
        foreach ($quoteTransfer->getItems() as $item) {
            $trackingRequest = new FactFinderSdkTrackingRequestTransfer();
            $trackingRequest->setEvent(FactFinderConstants::REQUEST_PARAMETER_CART);
            $trackingRequest->setSid($quoteTransfer->getCustomer()->getSessionId());
            $trackingRequest->setMasterId($item->getAbstractSku());
            $trackingRequest->setId($item->getSku());
            $trackingRequest->setCount($item->getQuantity());

            $this->factFinderSdkClient->track($trackingRequest);
        }
    }

}