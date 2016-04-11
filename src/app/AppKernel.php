<?php
use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\Container;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    /**
     * Set the root directory path
     * @return string
     */
    public function getRootDir()
    {
        return __DIR__;
    }

    /**
     * Set the cache directory path
     * @return string
     */
    public function getCacheDir()
    {
        if (getenv('APP_CACHE_DIR') !== false) {
            return getenv('APP_CACHE_DIR');
        }

        return parent::getCacheDir();
    }

    /**
     * Set the log directory path
     * @return string
     */
    public function getLogDir()
    {
        if (getenv('APP_LOG_DIR') !== false) {
            return getenv('APP_LOG_DIR');
        }

        return parent::getLogDir();
    }

    /**
     * @param LoaderInterface $loader
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');

        // Overwrite the default parameters with the environment variables
        $envParameters = $this->getEnvParameters();
        $loader->load(function(Container $container) use ($envParameters) {
            $container->getParameterBag()->add($envParameters);
        });
    }
}
