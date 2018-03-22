<?php

namespace SprykerEco\Zed\FactFinder;

use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class FactFinderDependencyProvider extends AbstractBundleDependencyProvider
{
    const FACT_FINDER_SDK_CLIENT = 'FACT_FINDER_SDK_CLIENT';

    /**
     * @param Container $container
     * @return Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        $container = $this->addFactFinderSdkClient($container);

        return parent::provideBusinessLayerDependencies($container);
    }

    /**
     * @param Container $container
     * @return Container
     */
    protected function addFactFinderSdkClient(Container $container)
    {
        $container[static::FACT_FINDER_SDK_CLIENT] = function (Container $container) {
            return $container->getLocator()->factFinderSdk()->client();
        };

        return $container;
    }

}