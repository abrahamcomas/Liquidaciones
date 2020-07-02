<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Liquidaciones</title>
<style type="text/css">
		.div_Head{
			background-color: #F00;
			text-align: center;
		}

		.div_body{
			background-color: #00F;
				text-align: center;

		}
		.div_foot{
			background-color: #FF0;
				text-align: center;
		}
</style>
</head>
<body>

	<div class="div_Head">
		@yield("Head");
	</div>
	<div class="div_body">
		@yield("body");
	</div>
	<div class="div_foot">
		@yield("foot");
	</div>

</body>
</html>