<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
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
