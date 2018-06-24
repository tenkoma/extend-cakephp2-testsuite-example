<?php
App::uses('ExtendTestCase', 'ExtendTestSuite.TestSuite');
App::uses('DummyExtendTestCaseUseTest', 'ExtendTestSuite.Test/Fixture');

/**
 * @covers ExtendTestCase
 */
class ExtendTestCaseTest extends CakeTestCase {
    /** @var array */
    private $originalConfigure;

    public function setUp()
    {
        parent::setUp();
        $this->originalConfigure = Configure::read();
    }

    public function tearDown()
    {
        Configure::clear();
        Configure::write($this->originalConfigure);
        parent::tearDown();
    }

    public function testConfigureRestore()
    {
        Configure::write('TestSuite.storedBefore', 'stored_before');
        $case = new DummyExtendTestCaseUseTest('testConfigureWriteExample');
        $result = $case->run();
        $this->assertSame(0, $result->errorCount());
        $this->assertSame(1, $result->count());
        $this->assertSame('stored_before', Configure::read('TestSuite.storedBefore'));
        $this->assertTrue($result->wasSuccessful());
    }

    /**
     * @covers ::assertSame()
     */
    public function testAssertSame()
    {
        $case = new ExtendTestCase();
        $expected = array(
            '1' => '1',
            '2' => '2',
        );
        $actual = array(
            '1' => '1',
            '2' => 2,
        );
        $this->setExpectedException('PHPUnit_Framework_ExpectationFailedException');
        try {
            $case->assertSame($expected, $actual);
        } catch (PHPUnit_Framework_ExpectationFailedException $e) {
            $this->assertSame(
                <<<EOF
Failed asserting that Array (
    1 => '1'
    2 => 2
) is identical to Array (
    1 => '1'
    2 => '2'
).
--- Expected
+++ Actual
@@ @@
 Array &0 (
     1 => '1'
-    2 => '2'
+    2 => 2
 )
EOF
                ,
                PHPUnit_Framework_TestFailure::exceptionToString($e)
            );
            throw $e;
        }
    }
}