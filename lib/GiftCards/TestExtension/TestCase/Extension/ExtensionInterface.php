<?php

namespace GiftCards\TestExtension\TestCase\Extension;

interface ExtensionInterface
{

    public function supportsMethod($method, array $arguments = array());

    public function executeMethod($method, array $arguments = array());
}
