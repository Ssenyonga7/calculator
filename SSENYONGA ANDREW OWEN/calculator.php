<?php
$result = '';
$display = '0';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num1 = isset($_POST['num1']) ? floatval($_POST['num1']) : 0;
    $num2 = isset($_POST['num2']) ? floatval($_POST['num2']) : 0;
    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
    $trig_operation = isset($_POST['trig_operation']) ? $_POST['trig_operation'] : '';
    $trig_value = isset($_POST['trig_value']) ? floatval($_POST['trig_value']) : 0;
    
    if ($trig_operation) {
        switch ($trig_operation) {
            case 'sin':
                $result = sin($trig_value);
                $display = $result;
                break;
            case 'cos':
                $result = cos($trig_value);
                $display = $result;
                break;
            case 'tan':
                $result = tan($trig_value);
                $display = $result;
                break;
            case 'asin':
                if ($trig_value >= -1 && $trig_value <= 1) {
                    $result = asin($trig_value);
                    $display = $result;
                } else {
                    $error = 'Error: Value must be between -1 and 1 for asin';
                }
                break;
            case 'acos':
                if ($trig_value >= -1 && $trig_value <= 1) {
                    $result = acos($trig_value);
                    $display = $result;
                } else {
                    $error = 'Error: Value must be between -1 and 1 for acos';
                }
                break;
            case 'atan':
                $result = atan($trig_value);
                $display = $result;
                break;
            case 'sqrt':
                if ($trig_value >= 0) {
                    $result = sqrt($trig_value);
                    $display = $result;
                } else {
                    $error = 'Error: Cannot calculate square root of negative number';
                }
                break;
            case 'square':
                $result = $trig_value * $trig_value;
                $display = $result;
                break;
            case 'pi':
                $result = pi();
                $display = $result;
                break;
        }
    } elseif ($operation) {
        switch ($operation) {
            case '+':
                $result = $num1 + $num2;
                $display = $result;
                break;
            case '-':
                $result = $num1 - $num2;
                $display = $result;
                break;
            case '*':
                $result = $num1 * $num2;
                $display = $result;
                break;
            case '/':
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                    $display = $result;
                } else {
                    $error = 'Error: Division by zero';
                }
                break;
            case '%':
                $result = $num1 % $num2;
                $display = $result;
                break;
        }
    }
    
    if ($error) {
        $display = $error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Calculator</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .calculator {
            background: #1a1a2e;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .display {
            background: #16213e;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            text-align: right;
        }

        .display .result {
            color: #fff;
            font-size: 36px;
            font-weight: 300;
            word-wrap: break-word;
        }

        .display .error {
            color: #e94560;
            font-size: 24px;
        }

        .section {
            margin-bottom: 25px;
        }

        .section h3 {
            color: #888;
            font-size: 14px;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }

        input[type="number"] {
            flex: 1;
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            background: #2a2a4a;
            color: #fff;
        }

        input[type="number"]:focus {
            outline: 2px solid #667eea;
        }

        .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }

        button {
            padding: 15px;
            font-size: 18px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
            color: #fff;
        }

        button:hover {
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.95);
        }

        .operator {
            background: #4a4a6a;
        }

        .operator:hover {
            background: #5a5a7a;
        }

        .trig {
            background: #9b59b6;
            font-size: 14px;
        }

        .trig:hover {
            background: #8e44ad;
        }

        .constant {
            background: #3498db;
        }

        .constant:hover {
            background: #2980b9;
        }

        .submit {
            background: #667eea;
            grid-column: span 4;
            font-size: 20px;
            padding: 20px;
        }

        .submit:hover {
            background: #5568d3;
        }

        .clear {
            background: #e94560;
        }

        .clear:hover {
            background: #d63550;
        }

        .note {
            color: #888;
            font-size: 12px;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="calculator">
        <h1>PHP Calculator</h1>
        
        <div class="display">
            <?php if ($error): ?>
                <div class="result error"><?php echo htmlspecialchars($display); ?></div>
            <?php else: ?>
                <div class="result"><?php echo $display !== '0' ? number_format($display, 10) : '0'; ?></div>
            <?php endif; ?>
        </div>

        <!-- Basic Operations -->
        <div class="section">
            <h3>Basic Operations</h3>
            <form method="POST">
                <div class="input-group">
                    <input type="number" name="num1" step="any" placeholder="First number" required>
                    <input type="number" name="num2" step="any" placeholder="Second number" required>
                </div>
                <div class="buttons">
                    <button type="submit" name="operation" value="+" class="operator">+</button>
                    <button type="submit" name="operation" value="-" class="operator">−</button>
                    <button type="submit" name="operation" value="*" class="operator">×</button>
                    <button type="submit" name="operation" value="/" class="operator">÷</button>
                    <button type="submit" name="operation" value="%" class="operator">%</button>
                </div>
            </form>
        </div>

        <!-- Trigonometry Functions -->
        <div class="section">
            <h3>Trigonometry Functions</h3>
            <form method="POST">
                <div class="input-group">
                    <input type="number" name="trig_value" step="any" placeholder="Enter value (in radians)" required>
                </div>
                <div class="buttons">
                    <button type="submit" name="trig_operation" value="sin" class="trig">sin</button>
                    <button type="submit" name="trig_operation" value="cos" class="trig">cos</button>
                    <button type="submit" name="trig_operation" value="tan" class="trig">tan</button>
                    <button type="submit" name="trig_operation" value="asin" class="trig">asin</button>
                    <button type="submit" name="trig_operation" value="acos" class="trig">acos</button>
                    <button type="submit" name="trig_operation" value="atan" class="trig">atan</button>
                    <button type="submit" name="trig_operation" value="sqrt" class="constant">√</button>
                    <button type="submit" name="trig_operation" value="square" class="constant">x²</button>
                    <button type="submit" name="trig_operation" value="pi" class="constant">π</button>
                </div>
            </form>
        </div>

        <div class="note">
            Note: Trigonometric functions use radians. To convert degrees to radians, multiply by π/180.
        </div>
    </div>
</body>
</html>
