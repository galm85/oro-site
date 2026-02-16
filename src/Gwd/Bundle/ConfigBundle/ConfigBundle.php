<?php

namespace Gwd\Bundle\ConfigBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Gwd\Bundle\ConfigBundle\DependencyInjection\ConfigExtension;

class ConfigBundle extends Bundle
{
    public function getContainerExtension(): ConfigExtension
    {
        if (null === $this->extension) {
            $this->extension = new ConfigExtension();
        }

        return $this->extension;
    }
}