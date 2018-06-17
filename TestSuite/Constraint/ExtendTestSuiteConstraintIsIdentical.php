<?php
use SebastianBergmann\Exporter\Exporter;
class ExtendTestSuiteConstraintIsIdentical extends PHPUnit_Framework_Constraint_IsIdentical
{
    /** @var Exporter */
    protected $exporter;
    public function __construct($value)
    {
        parent::__construct($value);
        $this->exporter = new Exporter();
    }
    public function evaluate($other, $description = '', $returnResult = FALSE)
    {
        if (!is_array($this->value) || !is_array($other)) {
            return parent::evaluate($other, $description, $returnResult);
        }
        $success = $this->value === $other;
        if ($returnResult) {
            return $success;
        }
        if (!$success) {
            $f = NULL;
            // if both values are array, make sure a diff is generated
            if (is_array($this->value) && is_array($other)) {
                $ComparisonFailureClass = class_exists('PHPUnit_Framework_ComparisonFailure')
                    ? 'PHPUnit_Framework_ComparisonFailure'
                    : '\SebastianBergmann\Comparator\ComparisonFailure';
                $f = new $ComparisonFailureClass(
                    $this->value,
                    $other,
                    $this->exporter->export($this->value),
                    $this->exporter->export($other)
                );
            }
            $this->fail($other, $description, $f);
        }
    }
}