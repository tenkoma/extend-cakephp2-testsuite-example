<?php
// @codingStandardsIgnoreFile
class DATABASE_CONFIG
{
    /** @var array|null */
    public $default = null;
    /** @var array|null */
    public $test = null;
    public function __construct()
    {
        $this->default = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => env('DEV_MYSQL_HOST'),
            'database' => 'test_base',
            'login' => env('DEV_MYSQL_USER'),
            'password' => env('DEV_MYSQL_PASS'),
            'prefix' => '',
            'encoding' => 'utf8',
        );
        $this->test = array(
            'datasource' => 'Database/Mysql',
            'persistent' => false,
            'host' => env('DEV_MYSQL_HOST'),
            'database' => 'test_base',
            'login' => env('DEV_MYSQL_USER'),
            'password' => env('DEV_MYSQL_PASS'),
            'prefix' => '',
            'encoding' => 'utf8',
        );
    }
}
