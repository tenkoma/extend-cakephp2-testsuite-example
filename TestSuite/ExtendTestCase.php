<?php
App::uses('ExtendTestSuiteConstraintIsIdentical', 'ExtendTestSuite.TestSuite/Constraint');
class ExtendTestCase extends CakeTestCase {
    /**
     * PHPUnit 7 の assertSame array diff が出来るようにする
     * @param mixed $expected
     * @param mixed $actual
     * @param string $message
     */
    public static function assertSame($expected, $actual, $message = '')
    {
        if (is_array($expected) && is_array($actual)) {
            $constraint = new ExtendTestSuiteConstraintIsIdentical(
                $expected
            );
            self::assertThat($actual, $constraint, $message);
            return;
        }
        parent::assertSame($expected, $actual, $message);
    }
}