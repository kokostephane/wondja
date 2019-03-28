<?php
include('page/connexion.php');
$array=array("name"=>"","email"=>"","password"=>"","nameError"=>"","emailError"=>"","passwordError"=>"","isSuccess"=>false);
if ($_SERVER["REQUEST_METHOD"]=="POST")
 {
	$array['name']=verifyInput($_POST["name"]);
	$array['email']=verifyInput($_POST["email"]);
	$array['password']=verifyInput($_POST["password"]);
	$array['isSuccess']=true;
	if (empty($array['name'])) 
	{
		$array['nameError']="Le champs est requis";
		$array['isSuccess']=false;
	}
	else
	{
		$array['name']=$array["name"];
	}
	if (empty($array['email'])) 
	{
		$array['emailError']="Le champs est requis";
		$array['isSuccess']=false;
	}
	else
	{
		if (!isEmail($array['email'])) {
	$array['emailError']="le mail n est pas valide..?";
	$array['isSuccess']=false;
}else{
	$array['emailError']=$array["emailError"];
}
		$array['email']=$array['email'];
	}
	if (empty($array['password'])) 
	{
		$array['passwordError']="le champs est requis";
		$array['isSuccess']=false;
	}
	else
	{
		$array['password']=$array["password"];
	}
	if (strlen($array['password'])==5) {
	$array['password'];
	
}else{
	$array["passwordError"]="le mot de passe doit contenir 5 caracteres";
}
if ($array['isSuccess']) 
{
	$array['isSuccess']="success";
}
}
if (
	$array['isSuccess']==true) {
   $array['password']=md5($array['password']);
   $list=$bdd->prepare("SELECT * FROM client WHERE email=?");
   $list->execute(array($array['email']));
   $rows=$list->rowCount();
   if ($rows==0) {
   	$insert=$bdd->prepare("INSERT INTO client(name,email,password) VALUES(?,?,?)");
   	$insert->execute(array($array["name"],$array["email"],$array["password"]));
   	$array["isSuccess"]="<p style='color:green' >Enregistrement effectué avec succès.merci</p><br>". $cnt='<a href="acceuil.php" class="btn btn-success"> connecte-toi</a>';	
		}else{
		$array["isSuccess"]="<p style='color:red'>{$array['email']} exist déja</p>";	
		}

}











function verifyInput($var){
	$var=htmlspecialchars($var);
	$var=trim($var);
	$var=stripcslashes($var);
	return $var;
}
function isEmail($email){
	$email=filter_var($email,FILTER_VALIDATE_EMAIL);
	return $email;
}
?>






<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/ali.css">
	<link rel="stylesheet" type="text/css" href="fonts/glyphicons-halflings-regular.ttf">
	<title>Formulaire</title>
</head>
<body class="piou">
	<div class="container">
		<style>
@import url('https://fonts.googleapis.com/css?family=Germania+One');
</style>
		<div class="row" style="margin: 10% 0; font-family: 'Germania One', cursive;">
			<div class="col-md-6 col-md-offset-3">
				<form method="POST">
				<div class="col-md-12">

					<h1 style="text-transform: uppercase; color: goldenrod; font-style: italic; text-align: center;">bienvenue sur <span style="font-size: 2em;" class="coloration">garba</span></h1>
					<label style="color: goldenrod;">Nom</label>
						<input type="text" name="name" class="form-control">
					<div class="comments" style="color: red;">	<?php
						if (isset($array['nameError'])) {
							echo $array['nameError'];
						}
						?>
					</div>
				</div>
				<div class="col-md-12">
					<label style="color: goldenrod;">Email</label>
						<input type="text" name="email" class="form-control">
					<div class="comments" style="color: red;"><?php
						if (isset($array['emailError'])) {
							echo $array['emailError'];
						}
						?>
					</div>
				</div>
				<div class="col-md-12">
					<label style="color: goldenrod;">mot de passe</label>
						<input type="password" name="password"class="form-control">
						<div class="comments" style="color: red;">
						<?php
						if (isset($array['passwordError'])) {
							echo $array['passwordError'];
						}
						?>
					</div>
				</div>
				
				<div>
					<input type="submit" name="submit" class=" btn btn-danger"  value="connexion" style="margin-left: 40%; margin-top: 30px;">
					<div class="comments"  style="color: green; margin-left: 35%; margin-top: 10px">
						<?php if (isset($array['isSuccess'])) {
								echo $array['isSuccess'];
							}?>
					</div>
				</div>
			</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="js/jquery-1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/docs.min.js"></script>
</body>
</html>