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
    app.request = function (url, data, next) {
		var request = new XMLHttpRequest()
		request.onreadystatechange = function () {
			if ( this.readyState === (this.done || 4) ) {
                var result = null
                try {
                    result = JSON.parse(request.responseText)
                }
                catch (error) { // response was invalid json
                    return next(new Error('Invalid response: ' + error.message))
                }
                if ( !result.success ) { // response had error
                    return next(new Error(result.message || 'Unknown server error.'))
                }
                return next(null, result)
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
        var name = document.getElementById('name').value
        window.app.request(form.action || document.location.href, {name: name}, function (error, result) {
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
