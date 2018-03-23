<?php

namespace SprykerEco\Zed\FactFinder\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface FactFinderFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function track(QuoteTransfer $quoteTransfer);
}
