<?php
include('page/connexion.php');
$array=array("prix"=>"","prixError"=>"","isSuccess"=>false);
if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$array['prix']=verifyInput($_POST['prix']);
	$array['isSuccess']=true;

if (empty($array['prix'])) {
	
	$array['prixError']='les champs est vide';
	$array['prix']=false;
}else{
	$array['prix']=$array['prix'];
}

	if($array['isSuccess']==true) {

   	$insert=$bdd->prepare("INSERT INTO categorie(name) VALUES(?)");
   	$insert->execute(array($array["prix"]));

     }

}

function verifyInput($var){
	$var=htmlspecialchars($var);
	$avr=trim($var);
	$avr=stripcslashes($var);
	return $var;
}
?>




<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/ali.css">
	<link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.tff">
	<title>alimentation </title>
</head>
<body>
<div class="container site">
	<h1 class="text-logo">garba en ligne<span class="glyphicon glyphicon-ok"></span></h1>
	<nav>
		<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href  ="#1" data-toggle="tab">mini-garba</a></li>
			<li role="presentation"><a href="#2" data-toggle="tab">garba complet</a></li>
		</ul>
	</nav>
	<div class="tab-content">
		<div class="tab-pane active" id="1">
			<div class="row">
				<div class="col-xs-6 col-md-4">
					<div class="thumbnail">
						<img src="images/garba3.jpg" alt="..." class="lien">
						<div class="price">500f cfa</div>
					<div id="caption">
						<h4>menu simple</h4>
						<p>garba <br>attiéké <br>poisson <br>piments</p>
						<a href="#" class="btn btn-order" role="button" id="com1"><span class="glyphicon glyphicon-shopping-cart ">commander</span></a>
					<form method="POST">
						 <div id="conf1" style="visibility: hidden; margin:0; padding: 0;" >
							Quantité:<input type="text" name="prix" id="bae">
							<input type="submit" name="send">
							
						</div>
					</form>

					</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4">
					<div class ="thumbnail">
						<img src="images/garba3.jpg" alt="...">
						<div class="price">500f cfa</div>
					<div id="caption">
						<h4>menu simple</h4>
						<p>garba-mini <br>attiéké <br>poisson <br>piments</p>
						<a href="#" class="btn btn-order" role="button" id="com2"><span class="glyphicon glyphicon-shopping-cart ">commander</span></a>
					<form method="POST ">
						<div id="conf2" style="visibility: hidden; margin:0; padding: 0;">
							Quantité:<input type="text" name="prix" id="piou">
							<input type="submit" name="send">
						</div>
					</form>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="tab-pane" id="2">
			<div class="row">
				<div class="col-xs-6 col-md-4">
					<div class="thumbnail">
						<img src="images/im1.jpeg" alt="...">
						<img src="images/jus.3.jpg" alt="...">
						<div class="price">800f cfa</div>
					<div id="caption">
						<h4>menu complet</h4>
						<p>garba_complet <br>attiéké <br>poisson <br>  tomates <br>oignons <br>piments <br>boissons</p>
						<a href="#" class="btn btn-order" role="button" id="com3"><span class="glyphicon glyphicon-shopping-cart">commander</span></a>
						<form method="POST">
							<div id="conf3" style="visibility: hidden; margin:0; padding: 0;">
							Quantité:<input type="text" name="prix" id="var">
							<input type="submit" name="send">
						    </div>
						</form>
					</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-4">
					<div class="thumbnail">
						<img src="images/im1.jpeg" alt="...">
						<img src="images/jus.3.jpg" alt="...">

						<div class="price">800f cfa</div>
					<div id="caption">
						<h4>menu complet</h4>
						<p>garba_complet<br>attiéké <br>poisson <br> tomates <br>oignons <br>piments <br>boissons</p>
						<a href="#" class="btn btn-order" role="button" id="com4"><span class="glyphicon glyphicon-shopping-cart ">commander</span></a>
					<form method="POST">
						<div id="conf4" style="visibility: hidden; margin:0; padding: 0;">
							Quantité:<input type="text" name="prix" id="qtite">
							<input type="submit" name="send">
						</div>
					</form>
					</div>
					<div class="commande"></div>
					</div>
				</div>
			</div>
		</div>
	</div>  
</div>
<footer>
	<p>&copy;tout droits reservés</p>
</footer>
         <script type="text/javascript" src="js/qtite.js"></script>						
		<script type="text/javascript" src="js/jquery-1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/docs.min.js"></script>
	<script>
    window.SpeechRecognition = window.webkitSpeechRecognition || window.SpeechRecognition;
    let finalTranscript = '';
    let recognition = new window.SpeechRecognition();
    recognition.interimResults = true;
    recognition.maxAlternatives = 10;
    recognition.continuous = true;
    recognition.onresult = (event) => {
      let interimTranscript = '';
      for (let i = event.resultIndex, len = event.results.length; i < len; i++) {
        let transcript = event.results[i][0].transcript;
        if (event.results[i].isFinal) {
          finalTranscript += transcript;
        } else {
          interimTranscript += transcript;
        }
      }
      $('#bae').val(finalTranscript);
      $('#piou').val(finalTranscript);
      $('#var').val(finalTranscript);
      $('#qtite').val(finalTranscript);
          }
    recognition.start();
  </script>
</body>
</html>