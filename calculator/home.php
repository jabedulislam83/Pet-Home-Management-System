<html>
<head>
    <title>Calculator</title>
    <script src="calculator.js"></script>
</head>
<body style="font-family: Arial; background-color: #f2f2f2; padding: 20px;">
    <h2 align="center">Calculator</h2>

    <div style="text-align: center;">
        <input type="number" id="num1" placeholder="Enter first number" style="padding: 8px; margin: 5px;"><br><br>
        <input type="number" id="num2" placeholder="Enter second number" style="padding: 8px; margin: 5px;"><br><br>

        <button onclick="calculate('+')" style="padding: 10px; margin: 2px;">+</button>
        <button onclick="calculate('-')" style="padding: 10px; margin: 2px;">-</button>
        <button onclick="calculate('*')" style="padding: 10px; margin: 2px;">*</button>
        <button onclick="calculate('/')" style="padding: 10px; margin: 2px;">/</button>
        <button onclick="calculate('%')" style="padding: 10px; margin: 2px;">%</button>

        <br><br>
        <h3>Result:</h3>
        <h4 id="result">--</h4>
    </div>
</body>
</html>
