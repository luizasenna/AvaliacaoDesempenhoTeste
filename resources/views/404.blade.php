<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Desculpe, página não encontrada</title>
  
    <!-- global level css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- end of globallevel css-->
    <!-- page level styles-->
    
    <!-- end of page level styles-->
</head>

<body>

    
    <div class="container-fluid" style="margin-top:10%">
		<div class="col-md-2"></div>
        <div class="col-md-8 col-xs-12 col-sm-12">
			<img src="/assets/images/404.gif" />
			<div class="col-md-3"></div>
			<div class="col-md-6 col-xs-12 col-sm-12 middle"></div>
					<a href="{{ route('home') }}">
						<button type="button" class="btn btn-primary btn-lg"><h3>Ir para a página inicial</h3></button>
					</a>
			<div class="col-md-3 "></div>
        </div>
        <div class="col-md-2"></div>
    </div>
   
</body>
</html>
