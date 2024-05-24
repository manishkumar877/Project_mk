<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Form</title>
    <style>
        .form-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<form id="dynamicForm">
    <div class="form-group">
        <label for="options">Choose an option:</label>
        <select id="options" onchange="addInputField()">
            <option value="">Select an option</option>
            <option value="text">Text Input</option>
            <option value="number">Number Input</option>
            <option value="date">Date Input</option>
        </select>
    </div>
    <div id="additionalInputs"></div>
</form>

<script>
    function addInputField() {
        const selectedOption = document.getElementById('options').value;
        const additionalInputsDiv = document.getElementById('additionalInputs');
        
        additionalInputsDiv.innerHTML = '';
        
        if (selectedOption) {
            let inputField;
            switch (selectedOption) {
                case 'text':
                    inputField = '<div class="form-group"><label for="textInput">Text Input:</label><input type="text" id="textInput" name="textInput"></div>';
                    break;
                case 'number':
                    inputField = '<div class="form-group"><label for="numberInput">Number Input:</label><input type="number" id="numberInput" name="numberInput"></div>';
                    break;
                case 'date':
                    inputField = '<div class="form-group"><label for="dateInput">Date Input:</label><input type="date" id="dateInput" name="dateInput"></div>';
                    break;
                default:
                    inputField = '';
            }
            additionalInputsDiv.innerHTML = inputField;
        }
    }
</script>

</body>
</html>
