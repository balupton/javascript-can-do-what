<?php
# Server-Side Validation
if ( $_SERVER['HTTP_X_REQUESTED_WITH'] ) {
    $data = json_decode($_POST['data'], true);
    if ( $data['name'] ) {
        echo '{"success": true}';
    }
    else {
        echo '{"success": false, "message": "You must supply a name to continue! You must be accountable!"}';
    }
}
# Server-Side Action
else if ( $_POST['name'] ) {
    echo $_POST['name'] . ' deleted the internet! OH NO!!!';
} else { ?>
<!<!DOCTYPE HTML>
<html>
<head>
	<title>00s JavaScript Example</title>
	<style>
	    #error {
            color: #D8000C;
            background-color: #FFBABA;
	    }
	</style>
	<script>(function () {
	var app = window.app = {}
	// Server-Side Validation
    app.validate = function (url, data, next) {
		var request = new XMLHttpRequest()
		request.onreadystatechange = function () {
			var DONE = this.DONE || 4
			if (this.readyState === DONE) {
			    try {
			        var result = JSON.parse(request.responseText)
			        if ( !result.success ) {
			            throw new Error(result.message || 'Validation of the form failed')
			        }
			    }
			    catch (error) {
			        return next(error)
			    }
			    return next()
			}
		}
		request.open('POST', url, true)
		request.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
		request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
		request.send('data='+JSON.stringify(data))
	}
	// Client-Side Asynchronous Submission
	app.submit = function (form) {
	    if ( form.validated ) {
	        return true  // continue with form submission
	    }
	    else {
	        var name = document.getElementById('name').value
	        window.app.validate(form.action || document.location.href, {name: name}, function (error) {
	            if ( error ) {
			        document.getElementById('error').innerHTML = error.message || error.toString()
			        form.validated = false
	            }
	            else {
	                form.validated = true
	                form.submit()
	            }
	        })
	        return false  // cancel form submission
	    }
	}
	})()</script>
</head>
<body>
<form action="" method="post" onsubmit="return window.app.submit(this)">
    <div id="error"></div>
    <label for="name">Name:</label>
    <input id="name" type="text" name="name">
    <input type="submit" value="Delete the Internet">
</form>
</body>
</html>
<?php } ?>
