<!--
Build something like a Jupyter Notebook for PHP in PHP.
Write and execute code in small parts interactivelly.
-->

<!--
index.php
Shows how the notebook should look with some basic CSS.
-->

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Notebook</title>
	<style>
		body {
			font-family: Arial, sans-serif;
		}
		.container {
			width: 80%;
			margin: auto;
			padding-top: 20px;
		}
		.code-block {
			width: 100%;
			height: 100px;
			margin-bottom: 10px;
		}
		.output-block {
			background-color: #f4f4f4:
			padding: 10px;
			margin-bottom: 20px;
			white-space: pre-wrap;
		}
		.run-btn {
			padding: 10px 20px;
			background-color: #28a745;
			color: white;
			border: none;
			cursor: pointer;
			margin-buttom: 20px;
		}
	</style>
</head>
<body>
<div class="container">
	<h1>PHP Notebook</h1>
	<div id="notebook">
		<div class="code-cell">
			<!--
			Code that the user types.
			-->
			<textarea name="code[]" class="code-block" placeholder="Write your PHP code here..."></textarea><br>
			<button type="button" class="run-btn">Run</button>
			<!--
			Output section.
			-->
			<div class="output-block" style="display: none;"></div>
		</div>
	</div>
</div>
<!--
Type code in the text area.
Click on the "Run" button to see the output of the code.
-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!--
When the document is loaded, the listener on the "Run" button will work on different sections dinamically.
The listener works on the newly generated "Run" buttons aswell.
-->
<script>
	$(document).ready(function() {
		$("#notebook').on('click', '.run-btn', function() {
			var codeCell = $(this).closest('code-cell');
			var codeBlock = codeCell.find('.code-block');
			var outputBlock = codeCell.find('output-block');
			// After the execution, show the output.
			// Send the data to the back to work with PHP.
			// URL is "execute.php".
			// POST the data.
			// Content of the POST request, send the code that the user has written.
			$.ajax({
				url: 'execute.php',
				type: 'POST',
				data: { code: codeBlock.val() },
				// If it's successfull, show the output of the code.
				success: function (response) {
					outputblock.html(response).show();
					// If the LastBlock is not empty, create a new block to allow the user to type more code.
					if (isLastCodeBlockEmpty() === false) {
						addNewCodeBlock();
					}
				},
				// If there's an error, show it in the output.
				error: function (xhr, status, error) {
					outputblock.html('An error occurred: ' + error).show();
				}
			});
		});
		// Check if the last text area is empty
		function isLastCodeBlockEmpty() {
			var lastCodeBlock = $('#notebook .code-cell:last-child .code-block').val();
			return lastCodeBlock.trim() === '';
		}
		// Add a base "code block"
		function addNewCodeBlock() {
			var newCodeCell = '
				<div class "code-cell">
					<textarea name="code[]" class="code-block" placeholder="Write your PHP code here..."></textarea>
					<br>
					<button type="button" class="run-btn">Run</button>
					<div class="output-block" style="display: none;"></div>
				</div>
			$('notebook').append(newCodeCell);
		}
	});
</script>
</body>
</html>


