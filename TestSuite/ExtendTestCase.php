<?php
App::uses('ExtendTestSuiteConstraintIsIdentical', 'ExtendTestSuite.TestSuite/Constraint');
class ExtendTestCase extends CakeTestCase {

    /** @var array */
    protected $backupConfigure = [];

    public function setUp()
    {
        parent::setUp();

        $this->backupConfigure = Configure::read();
    }

    public function tearDown()
    {
        Configure::clear();
        Configure::write($this->backupConfigure);

        parent::tearDown();
    }

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
