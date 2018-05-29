<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Symfony\Component\HttpFoundation\Request;

interface ShoppingCartCampaignsDataProviderInterface
{
    /**
     * @param array $parameters
     * @param Request $request
     *
     * @return \ArrayObject|\Generated\Shared\Transfer\FactFinderSdkDataCampaignTransfer[]
     */
    public function buildTemplateData(array $parameters, Request $request);
}
