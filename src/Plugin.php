<?php

declare(strict_types=1);

namespace OpenDxp\PsalmPlugin;

use Psalm\Plugin\PluginEntryPointInterface;
use Psalm\Plugin\RegistrationInterface;
use SimpleXMLElement;

final class Plugin implements PluginEntryPointInterface
{
    public function __invoke(RegistrationInterface $registration, ?SimpleXMLElement $config = null): void
    {
        foreach (glob(dirname(__DIR__).'/stubs/*/*.phpstub') as $stub) {
            $registration->addStubFile($stub);
        }
    }
}
