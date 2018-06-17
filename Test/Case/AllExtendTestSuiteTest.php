<?php
class AllExtendTestSuiteTest extends CakeTestCase {
    public static function suite() {
        $suite = new CakeTestSuite('All ExtendTestSuite classes tests');
        $suite->addTestDirectoryRecursive(__DIR__);
        return $suite;
    }
}
