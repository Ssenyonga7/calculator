# Calculator Application

A comprehensive calculator application with multiple implementations including HTML/JavaScript, PHP, and a RESTful API.

## Features

- **Basic Operations**: Addition, subtraction, multiplication, division, modulus
- **Trigonometry**: sin, cos, tan, asin, acos, atan
- **Advanced Functions**: Square root, square, power, absolute value, rounding
- **Constants**: Pi (π)
- **Conversions**: Degrees to radians, radians to degrees
- **History Tracking**: Keep track of calculations
- **API Support**: RESTful API for programmatic access

## Files

### Frontend
- `calculator.html` - Standalone HTML/JavaScript calculator with modern UI

### Backend
- `calculator.php` - PHP web-based calculator with form interface
- `CalculatorClass.php` - Reusable PHP calculator class
- `api.php` - RESTful API for calculator operations
- `test_calculator.php` - Unit tests for the calculator class

## Installation

### Requirements
- PHP 7.0 or higher
- Web server (Apache, Nginx, or PHP built-in server)

### Setup

1. Clone or download the repository

2. For PHP files, run on a web server:
```bash
php -S localhost:8000
```

3. Access the calculator:
   - HTML version: Open `calculator.html` directly in browser
   - PHP version: Visit `http://localhost:8000/calculator.php`
   - API: Send requests to `http://localhost:8000/api.php`

## Usage

### HTML/JavaScript Calculator
Open `calculator.html` in any web browser. No server required.

### PHP Calculator
Navigate to `calculator.php` on your web server. Use the forms to perform calculations.

### Calculator Class

```php
require_once 'CalculatorClass.php';

$calc = new Calculator();

// Basic operations
$result = $calc->add(5, 3);        // 8
$result = $calc->multiply(4, 7);   // 28

// Trigonometry
$result = $calc->sin(0);           // 0
$result = $calc->cos(pi());        // -1

// Other functions
$result = $calc->sqrt(16);         // 4
$result = $calc->power(2, 3);      // 8

// Get history
$history = $calc->getHistory();
```

### API Usage

**POST request for calculations:**
```bash
curl -X POST http://localhost:8000/api.php \
  -H "Content-Type: application/json" \
  -d '{"operation": "add", "a": 5, "b": 3}'
```

**Response:**
```json
{
  "success": true,
  "result": 8,
  "operation": "add"
}
```

**Available operations:**
- add, subtract, multiply, divide, modulus
- sin, cos, tan, asin, acos, atan
- sqrt, square, power, pi, absolute, round
- degToRad, radToDeg

**GET history:**
```bash
curl http://localhost:8000/api.php/history
```

**Clear calculator:**
```bash
curl -X DELETE http://localhost:8000/api.php/clear
```

## Running Tests

Run the unit tests:
```bash
php test_calculator.php
```

## API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| POST | /api.php | Perform calculation |
| GET | /api.php | Get current result |
| GET | /api.php/history | Get calculation history |
| DELETE | /api.php/clear | Clear calculator |
| DELETE | /api.php/history | Clear history |

## Note on Trigonometry

All trigonometric functions use radians by default. To use degrees, convert first:

```php
$calc = new Calculator();
$degrees = 90;
$radians = $calc->degToRad($degrees);
$result = $calc->sin($radians);
```

## License

This project is open source and available for educational purposes.
