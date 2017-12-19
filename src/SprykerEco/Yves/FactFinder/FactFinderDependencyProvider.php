<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Yves\FactFinder;

use Spryker\Yves\Kernel\AbstractBundleDependencyProvider;
use Spryker\Yves\Kernel\Container;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToFactFinderClientBridge;
use SprykerEco\Yves\FactFinder\Dependency\Clients\FactFinderToSessionClientBridge;

class FactFinderDependencyProvider extends AbstractBundleDependencyProvider
{

    const FACT_FINDER_CLIENT = 'FACT_FINDER_CLIENT';
    const SESSION_CLIENT = 'SESSION_CLIENT';

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    public function provideDependencies(Container $container)
    {
        $container = $this->provideClients($container);

        return $container;
    }

    /**
     * @param \Spryker\Yves\Kernel\Container $container
     *
     * @return \Spryker\Yves\Kernel\Container
     */
    protected function provideClients(Container $container)
    {
        $container[self::FACT_FINDER_CLIENT] = function () use ($container) {
            $factFinderClient = $container->getLocator()
                ->factFinderSdk()
                ->client();

            return new FactFinderToFactFinderClientBridge($factFinderClient);
        };
        $container[self::SESSION_CLIENT] = function () use ($container) {
            $sessionClient = $container->getLocator()
                ->session()
                ->client();

            return new FactFinderToSessionClientBridge($sessionClient);
        };

        return $container;
    }

}
