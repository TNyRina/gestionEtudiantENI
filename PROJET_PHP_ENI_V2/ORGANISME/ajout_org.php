<?php 
	require("../connectBDD.php");
	if (isset($_POST['Enregistrer'])) 
	{
		try 
		{
			$id=$_POST['Id'];
			$design=$_POST['design'];
			$lieu=$_POST['lieu'];
			
			// On ajoute une entrée dans la table ORGANISME

			$req = $PDO->prepare("INSERT INTO organisme VALUES(:id_org,
			:design, :lieu)");
			$req->execute(array(
			'id_org' => $id,
			'design' => $design,
			'lieu' => $lieu
			));
			$message ="<p style=\"color:green;text-align:center;\">Ajout reussi!</p>";


		}
		catch (Exception $e) {
				$message ="<p style=\"color:red;text-align:center;\">Id invalide ou deja existant!</p>";
		}
	}

	

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajout Organisme</title>

	<link rel="stylesheet" type="text/css" href="styleForme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="../srcipt.js"></script>
</head>
<body>
	<form method="POST" action="ajout_org.php">
		<fieldset>
			<legend>Ajouter un organisme</legend>
			<div>
				<label>Id :</label>
				<input type="number" name="Id" placeholder="" min="1">
			</div>
			<div>
				<label>Désignation :</label>
				<input type="text" name="design" placeholder="">	
			</div>
			<div>
				<label>Lieu :</label>
				<input type="text" name="lieu" placeholder="">
				
			</div>
				<button type="submit" name="Enregistrer"/>Enregistrer</button>
		</fieldset>
	
	</form>
	<?php if (isset($message)) {
		echo $message;
	} ?>
	<a href="organisme.php"><img src="../img/return.png"></a>
		
</body>
</html>