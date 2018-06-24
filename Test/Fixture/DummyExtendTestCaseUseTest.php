<?php
App::uses('ExtendTestCase', 'ExtendTestSuite.TestSuite');

class DummyExtendTestCaseUseTest extends ExtendTestCase
{
    /**
     * Configure を上書きする
     */
    public function testConfigureWriteExample()
    {
        Configure::write('TestSuite.storedBefore', 'override!!');
        $this->assertSame('override!!', Configure::read('TestSuite.storedBefore'));
    }
}