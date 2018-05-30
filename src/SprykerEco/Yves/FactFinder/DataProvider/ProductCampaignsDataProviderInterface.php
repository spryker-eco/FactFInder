<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

use Symfony\Component\HttpFoundation\Request;

interface ProductCampaignsDataProviderInterface
{
    /**
     * @param array $parameters
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Generated\Shared\Transfer\StorageProductAbstractRelationTransfer[]
     */
    public function buildTemplateData(array $parameters, Request $request);
}
