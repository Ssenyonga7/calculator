<?php
/**
 * Calculator Class
 * A reusable PHP calculator class for mathematical operations
 */

class Calculator {
    private $result;
    private $history = [];

    public function __construct() {
        $this->result = 0;
    }

    // Basic Operations
    public function add($a, $b) {
        $this->result = $a + $b;
        $this->addToHistory("$a + $b = {$this->result}");
        return $this->result;
    }

    public function subtract($a, $b) {
        $this->result = $a - $b;
        $this->addToHistory("$a - $b = {$this->result}");
        return $this->result;
    }

    public function multiply($a, $b) {
        $this->result = $a * $b;
        $this->addToHistory("$a * $b = {$this->result}");
        return $this->result;
    }

    public function divide($a, $b) {
        if ($b == 0) {
            throw new Exception("Division by zero is not allowed");
        }
        $this->result = $a / $b;
        $this->addToHistory("$a / $b = {$this->result}");
        return $this->result;
    }

    public function modulus($a, $b) {
        $this->result = $a % $b;
        $this->addToHistory("$a % $b = {$this->result}");
        return $this->result;
    }

    // Trigonometry Functions (radians)
    public function sin($value) {
        $this->result = sin($value);
        $this->addToHistory("sin($value) = {$this->result}");
        return $this->result;
    }

    public function cos($value) {
        $this->result = cos($value);
        $this->addToHistory("cos($value) = {$this->result}");
        return $this->result;
    }

    public function tan($value) {
        $this->result = tan($value);
        $this->addToHistory("tan($value) = {$this->result}");
        return $this->result;
    }

    // Inverse Trigonometry Functions
    public function asin($value) {
        if ($value < -1 || $value > 1) {
            throw new Exception("Value must be between -1 and 1 for asin");
        }
        $this->result = asin($value);
        $this->addToHistory("asin($value) = {$this->result}");
        return $this->result;
    }

    public function acos($value) {
        if ($value < -1 || $value > 1) {
            throw new Exception("Value must be between -1 and 1 for acos");
        }
        $this->result = acos($value);
        $this->addToHistory("acos($value) = {$this->result}");
        return $this->result;
    }

    public function atan($value) {
        $this->result = atan($value);
        $this->addToHistory("atan($value) = {$this->result}");
        return $this->result;
    }

    // Other Functions
    public function sqrt($value) {
        if ($value < 0) {
            throw new Exception("Cannot calculate square root of negative number");
        }
        $this->result = sqrt($value);
        $this->addToHistory("sqrt($value) = {$this->result}");
        return $this->result;
    }

    public function square($value) {
        $this->result = $value * $value;
        $this->addToHistory("$value² = {$this->result}");
        return $this->result;
    }

    public function power($base, $exponent) {
        $this->result = pow($base, $exponent);
        $this->addToHistory("$base^$exponent = {$this->result}");
        return $this->result;
    }

    public function pi() {
        $this->result = pi();
        $this->addToHistory("π = {$this->result}");
        return $this->result;
    }

    public function absolute($value) {
        $this->result = abs($value);
        $this->addToHistory("abs($value) = {$this->result}");
        return $this->result;
    }

    public function round($value, $precision = 2) {
        $this->result = round($value, $precision);
        $this->addToHistory("round($value, $precision) = {$this->result}");
        return $this->result;
    }

    // Getters
    public function getResult() {
        return $this->result;
    }

    public function getHistory() {
        return $this->history;
    }

    public function clearHistory() {
        $this->history = [];
    }

    public function clear() {
        $this->result = 0;
        $this->history = [];
    }

    // Helper
    private function addToHistory($entry) {
        $this->history[] = $entry;
        if (count($this->history) > 100) {
            array_shift($this->history);
        }
    }

    // Degree to Radian conversion
    public function degToRad($degrees) {
        return $degrees * (pi() / 180);
    }

    // Radian to Degree conversion
    public function radToDeg($radians) {
        return $radians * (180 / pi());
    }
}
