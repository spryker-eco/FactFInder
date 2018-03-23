<?php

namespace SprykerEco\Zed\FactFinder\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\FactFinder\Business\FactFinderBusinessFactory getFactory()
 */
class FactFinderFacade extends AbstractFacade implements FactFinderFacadeInterface
{
    /**
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return void
     */
    public function track(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()->createTracker()->track($quoteTransfer);
    }
}
