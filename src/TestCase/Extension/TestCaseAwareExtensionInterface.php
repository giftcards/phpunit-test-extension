<?php

namespace GiftCards\TestExtension\TestCase\Extension;

interface TestCaseAwareExtensionInterface extends ExtensionInterface
{
    public function setTestCase(ExtendableTestCaseInterface $testCase);
}
