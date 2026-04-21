<?php
/**
 * Calculator Test File
 * Unit tests for the Calculator class
 */

require_once 'CalculatorClass.php';

class CalculatorTest {
    private $calculator;
    private $passed = 0;
    private $failed = 0;

    public function __construct() {
        $this->calculator = new Calculator();
    }

    private function assert($condition, $message) {
        if ($condition) {
            echo "✓ PASS: $message\n";
            $this->passed++;
        } else {
            echo "✗ FAIL: $message\n";
            $this->failed++;
        }
    }

    public function runTests() {
        echo "Running Calculator Tests...\n\n";

        // Basic Operations
        $this->testBasicOperations();
        
        // Trigonometry
        $this->testTrigonometry();
        
        // Other Functions
        $this->testOtherFunctions();

        echo "\n" . str_repeat("-", 50) . "\n";
        echo "Tests Passed: $this->passed\n";
        echo "Tests Failed: $this->failed\n";
        echo str_repeat("-", 50) . "\n";
    }

    private function testBasicOperations() {
        echo "Testing Basic Operations:\n";
        
        $result = $this->calculator->add(5, 3);
        $this->assert($result === 8, "Addition: 5 + 3 = 8");

        $result = $this->calculator->subtract(10, 4);
        $this->assert($result === 6, "Subtraction: 10 - 4 = 6");

        $result = $this->calculator->multiply(6, 7);
        $this->assert($result === 42, "Multiplication: 6 * 7 = 42");

        $result = $this->calculator->divide(20, 4);
        $this->assert($result === 5, "Division: 20 / 4 = 5");

        $result = $this->calculator->modulus(17, 5);
        $this->assert($result === 2, "Modulus: 17 % 5 = 2");

        try {
            $this->calculator->divide(10, 0);
            $this->assert(false, "Division by zero should throw exception");
        } catch (Exception $e) {
            $this->assert(true, "Division by zero throws exception");
        }

        echo "\n";
    }

    private function testTrigonometry() {
        echo "Testing Trigonometry Functions:\n";

        $result = $this->calculator->sin(0);
        $this->assert(abs($result) < 0.0001, "sin(0) ≈ 0");

        $result = $this->calculator->cos(0);
        $this->assert(abs($result - 1) < 0.0001, "cos(0) = 1");

        $result = $this->calculator->tan(0);
        $this->assert(abs($result) < 0.0001, "tan(0) ≈ 0");

        $result = $this->calculator->asin(0);
        $this->assert(abs($result) < 0.0001, "asin(0) = 0");

        $result = $this->calculator->acos(1);
        $this->assert(abs($result) < 0.0001, "acos(1) = 0");

        try {
            $this->calculator->asin(2);
            $this->assert(false, "asin(2) should throw exception");
        } catch (Exception $e) {
            $this->assert(true, "asin(2) throws exception (value out of range)");
        }

        echo "\n";
    }

    private function testOtherFunctions() {
        echo "Testing Other Functions:\n";

        $result = $this->calculator->sqrt(16);
        $this->assert($result === 4, "sqrt(16) = 4");

        $result = $this->calculator->square(5);
        $this->assert($result === 25, "5² = 25");

        $result = $this->calculator->power(2, 3);
        $this->assert($result === 8, "2³ = 8");

        $result = $this->calculator->pi();
        $this->assert(abs($result - 3.14159) < 0.0001, "π ≈ 3.14159");

        $result = $this->calculator->absolute(-10);
        $this->assert($result === 10, "abs(-10) = 10");

        $result = $this->calculator->round(3.14159, 2);
        $this->assert($result === 3.14, "round(3.14159, 2) = 3.14");

        $result = $this->calculator->degToRad(180);
        $this->assert(abs($result - pi()) < 0.0001, "180° in radians = π");

        $result = $this->calculator->radToDeg(pi());
        $this->assert(abs($result - 180) < 0.0001, "π in degrees = 180°");

        try {
            $this->calculator->sqrt(-4);
            $this->assert(false, "sqrt(-4) should throw exception");
        } catch (Exception $e) {
            $this->assert(true, "sqrt(-4) throws exception");
        }

        echo "\n";
    }
}

// Run tests
$test = new CalculatorTest();
$test->runTests();
