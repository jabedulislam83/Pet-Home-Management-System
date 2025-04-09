function calculate(x) {
    var num1 = parseFloat(document.getElementById('num1').value);
    var num2 = parseFloat(document.getElementById('num2').value);
    var result;

    if (isNaN(num1) || isNaN(num2)) {
        result = "Please enter valid numbers.";
    } else {
        if (x == '+') {
            result = num1 + num2;
        } else if (x == '-') {
            result = num1 - num2;
        } else if (x === '*') {
            result = num1 * num2;
        } else if (x == '/') {
            if (num2 == 0) {
                result = "Cannot divide by 0!";
            } else {
                result = num1 / num2;
            }
        } else if (x == '%') {
            result = num1 % num2;
        } else {
            result = "Invalid operation!";
        }
    }

    document.getElementById('result').innerHTML = result;
}
