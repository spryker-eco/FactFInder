<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder\DataProvider;

interface ProductCampaignsDataProviderInterface
{
    /**
     * @param array $parameters
     *
     * @return \Generated\Shared\Transfer\StorageProductAbstractRelationTransfer[]
     */
    public function buildTemplateData(array $parameters);
}
