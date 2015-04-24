<!doctype html>
<!--[if IE 8]> <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
  <head>  	
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
	<meta name="description" content="Gestion Documental Orfeo Version 4"/>
	<meta name="keywords" content="Gestion Documental, Document Management System, Digital Sign, " />
	<meta name="author" content="Mindfreakerstuff"/>
    <link rel="shortcut icon" href="favicon.png"> 
    
	<title>Sistema de Gestion Documental Orfeo+</title>
    <!-- Bootstrap core CSS -->
    <link href="./js/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">
   
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
    <body>
    	<!-- start Login box -->
    	<div class="container" id="login-block">
    		<div class="row">
			    <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4 col-lg-12">
			       <div class="login-box clearfix animated flipInY">
			    	<h3 class="animated bounceInDown">ORFEO+</h3>
			        	<hr/>
			        	<div class="login-form">
			        		<div class="alert alert-error hide">
								  <button type="button" class="close" data-dismiss="alert">&times;</button>
								  <h4>Error!</h4>
								   Your Error Message goes here
							</div>
			        		<form action="{$_ACCION}" method="post" autocomplete="off">
						   		 <input name="krd" type="text" placeholder="Usuario" required/> 
						   		 <input name="drd" type="password"  placeholder="Password" required/> 
						   		 <button type="submit" class="btn btn-login">Entrar</button> 
							</form>	
							<div class="login-links"> 
					      <a href="forgot-password.html"><!--Olvido su Contrase&ntilde;a?--></a>
						  </div>
			        </div>
			       </div>
			    </div>
			</div>
    	</div>
     
      	<!-- End Login box -->
     	<footer class="container">
     		<p id="footer-text"><small><a href="http://www.supersolidaria.gov.co/">Superintendencia de la Economia Solidaria</a></small></p>
     		<p id="footer-text"><small>Copyleft 2014, Creado por la fundacion, <a href="http://www.correlibre.org/">Correlibre</a></small></p>
     	</footer>
		
      <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
      <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script> 
      <script src="./js/bootstrap/js/bootstrap.min.js"></script> 
      <script src="js/placeholder-shim.min.js"></script>        
      <script src="js/custom.js"></script>
    </body>
</html>
