<?php
# Server-Side Action
if ( $_POST['name'] ) {
    echo $_POST['name'] . ' deleted the internet! OH NO!!!';
} else { ?>
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<title>90s JavaScript Example</title>
	<script type="application/javascript">
	/*<![CDATA[*/
	window.app = {}
	// Client-Side Validation & Submission
	window.app.submit = function () {
	    var name = document.getElementById('name').value
	    if ( !name ) {
	        alert("You must supply a name to continue! You must be accountable!")
	        return false  // cancel form submission
	    }
		alert('Hello ' + name)
		return confirm('Are you sure you want to complete this action?') && confirm('Are you really sure?')
	}
	/*]]>*/
	</script>
</head>
<body>
<form action="" method="post" onsubmit="return window.app.submit(this)">
    <label for="name">Name:</label>
    <input id="name" type="text" name="name">
    <input type="submit" value="Delete the Internet">
</form>
</body>
</html>
<?php } ?>
