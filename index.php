<!DOCTYPE HTML> 
<html>
	<head>
		<title>МГУ</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		
		<script src="https://unpkg.com/vue"></script>
	</head>
	
	<body>
		<div id="app">
		{{ message }}
		</div>
		
		<script>
			var app = new Vue({
				el: '#app',
				data: {
					message: 'Hello Vue!'
				}
			});
		</script>
	</body>
</html>