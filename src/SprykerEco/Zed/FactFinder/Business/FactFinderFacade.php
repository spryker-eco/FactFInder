<?php

namespace SprykerEco\Zed\FactFinder\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method FactFinderBusinessFactory getFactory()
 */
class FactFinderFacade extends AbstractFacade
{

    /**
     * @api
     *
     * @param QuoteTransfer $quoteTransfer
     * @return void
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function track(QuoteTransfer $quoteTransfer)
    {
        $this->getFactory()->createTracker()->track($quoteTransfer);
    }

}