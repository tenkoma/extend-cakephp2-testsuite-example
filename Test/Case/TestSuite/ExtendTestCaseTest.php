<?php
App::uses('ExtendTestCase', 'ExtendTestSuite.TestSuite');

/**
 * @covers ExtendTestCase
 */
class ExtendTestCaseTest extends CakeTestCase {

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