<?php

namespace GiftCards\TestExtension\TestCase\Extension;

interface ExtendableTestCaseInterface
{
    public function getExtensionClasses(array $defaultExtensions);

    public function addExtension(ExtensionInterface $extension);
}
