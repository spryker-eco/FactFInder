<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */
namespace SprykerEco\Zed\FactFinder;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FactFinderDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACT_FINDER_SDK_CLIENT = 'FACT_FINDER_SDK_CLIENT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addFactFinderSdkClient($container);

        return parent::provideBusinessLayerDependencies($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addFactFinderSdkClient(Container $container)
    {
        $container[static::FACT_FINDER_SDK_CLIENT] = function (Container $container) {
            return $container->getLocator()->factFinderSdk()->client();
        };

        return $container;
    }
}
