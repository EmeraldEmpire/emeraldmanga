<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>
		Tester
	</title>
	<link rel="stylesheet" href="">
</head>
<body>
	
	{{ $categories }}

	<pre>
		{{ print_r(DB::getQueryLog()) }}
	</pre>

	<h1>Tester</h1>
</body>
</html>