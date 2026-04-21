<?php
/**
 * Calculator API
 * RESTful API for calculator operations
 */

header('Content-Type: application/json');

require_once 'CalculatorClass.php';

$calculator = new Calculator();
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

// Parse request body for POST requests
$input = json_decode(file_get_contents('php://input'), true);

try {
    switch ($method) {
        case 'GET':
            if ($path === '/history') {
                echo json_encode(['success' => true, 'history' => $calculator->getHistory()]);
            } else {
                echo json_encode(['success' => true, 'result' => $calculator->getResult()]);
            }
            break;

        case 'POST':
            $operation = $input['operation'] ?? '';
            $a = $input['a'] ?? 0;
            $b = $input['b'] ?? null;

            switch ($operation) {
                case 'add':
                    $result = $calculator->add($a, $b);
                    break;
                case 'subtract':
                    $result = $calculator->subtract($a, $b);
                    break;
                case 'multiply':
                    $result = $calculator->multiply($a, $b);
                    break;
                case 'divide':
                    $result = $calculator->divide($a, $b);
                    break;
                case 'modulus':
                    $result = $calculator->modulus($a, $b);
                    break;
                case 'sin':
                    $result = $calculator->sin($a);
                    break;
                case 'cos':
                    $result = $calculator->cos($a);
                    break;
                case 'tan':
                    $result = $calculator->tan($a);
                    break;
                case 'asin':
                    $result = $calculator->asin($a);
                    break;
                case 'acos':
                    $result = $calculator->acos($a);
                    break;
                case 'atan':
                    $result = $calculator->atan($a);
                    break;
                case 'sqrt':
                    $result = $calculator->sqrt($a);
                    break;
                case 'square':
                    $result = $calculator->square($a);
                    break;
                case 'power':
                    $result = $calculator->power($a, $b);
                    break;
                case 'pi':
                    $result = $calculator->pi();
                    break;
                case 'absolute':
                    $result = $calculator->absolute($a);
                    break;
                case 'round':
                    $precision = $input['precision'] ?? 2;
                    $result = $calculator->round($a, $precision);
                    break;
                case 'degToRad':
                    $result = $calculator->degToRad($a);
                    break;
                case 'radToDeg':
                    $result = $calculator->radToDeg($a);
                    break;
                default:
                    throw new Exception("Invalid operation");
            }

            echo json_encode([
                'success' => true,
                'result' => $result,
                'operation' => $operation
            ]);
            break;

        case 'DELETE':
            if ($path === '/clear') {
                $calculator->clear();
                echo json_encode(['success' => true, 'message' => 'Calculator cleared']);
            } elseif ($path === '/history') {
                $calculator->clearHistory();
                echo json_encode(['success' => true, 'message' => 'History cleared']);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'error' => 'Not found']);
            }
            break;

        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'error' => 'Method not allowed']);
            break;
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
