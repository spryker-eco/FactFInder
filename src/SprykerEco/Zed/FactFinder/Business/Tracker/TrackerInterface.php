<?php

namespace SprykerEco\Zed\FactFinder\Business\Tracker;

use Generated\Shared\Transfer\QuoteTransfer;

interface TrackerInterface
{
    /**
     * @param QuoteTransfer $quoteTransfer
     * @return void
     */
    public function track(QuoteTransfer $quoteTransfer);
}