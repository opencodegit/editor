<?php

// Get the code submitted by the user.
$code = $_POST['code'] ?? '';

// Keep track of the state of the variables for every code block.
// Store the state in a "json" file.
$stateFile = 'state.json';
// The "json" file and the "state" array hold the data in key value pairs.
// ["foo" => "bar"]
$state = [];

// Get the content of the "json" file.
if (file_exists($stateFile)) {
	$state = json_decode(file_get_contents($startFile), true);
}

// If it turns out that the content of the "json" file is empty, then set the state to an empty array.
if (empty($state)) {
	$state = [];
}
// Convert the key value pairs in the "state" array to PHP.
// ["foo" => "bar"] - - > $foo = "bar";
// Built-in variable "extract" does the conversion.
// It imports the variable into the current symbol table.
extract($state);

// Execute the code
// Begin output buffering, which allows to capture everything that is output from the code.
// For example, "echo" statements are captured.
ob_start();
// Execute the code with the "eval" function.
eval($code);
// Reterieve the output and clean the buffer. 
$output = ob_get_clean();


// After the code is executed, the variables might have changed.
// And new variables might have been added.
// So, we need to update their state.
// First, get the currently defined variables and their values with the "get_defined_vars()" function
$declaredVars = get_defined_vars();
// Inside the variables, also the code is stored.
// Remove the code to make sure it isn't stored in the state.
// Otherwise the program wouldn't run the updated code.
unset($delcaredVars['code']);

// Merge the "state" and the newly "declaredVars".
$state = array_merge($state, $declaredVars);
// Store all the state in the "json" file.
file_put_contents($stateFile, json_encode($state));

// Echo the output.
echo $output;