# editor

Build something like a Jupyter Noteboo for PHP in PHP.

Write and execute code in small parts interactivelly.

//** index.php **//

Shows how the notebook should look with some basic CSS.

Type code in the text area.

Click on the "Run" button to see the output of the code.

If there's an error, it shows up in the output.

If the "last code block" isn't empty, then add a new base "code block".

//** execute.php **//

Gets the code submitted by the user.

Keeps track of the state of the variables for every "code block".

Stores the state in a "json" file.

Executes the PHP code.

Updates each variable state.
