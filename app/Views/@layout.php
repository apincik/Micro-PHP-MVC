<!DOCTYPE html>

<head>
    <meta http-equiv="Content-type" content="text/html" />
    <meta http-equiv="Content-style-type" content="text/css" />
    <meta http-equiv="Content-scrip-type" content="text/javascript" />
    <meta charset="utf-8" />
    <meta name="author" content="Andrej Pinčík" />
    <meta description="Simple MVC app :)" />
    <title>MVC</title>
</head>

<body
    <div class="layout">
        <center>Vitajte na simpleMVC stránke. | (@layout.php)</center>
    </div>
    
    <div class='content'>
		
		<p>Form</p>
		<form id="testForm1">
			<input type="text" name="firstname">
			<input type="text" name="lastname">
			<input type="text" name="email">
			<input type="submit" name="send">
		</form>
		
        <center><?php $content ?></center>
		
        
    </div>
    
    
    
</body>

</html>