<?php 
	require("../connectBDD.php");
	if (isset($_POST['id'])) {
		$id=$_POST['id'];
		$placeholder=$PDO->query("SELECT * FROM organisme WHERE idorg='$id'");
		$placeholder=$placeholder->fetch(PDO::FETCH_ASSOC);
		if($placeholder==null)
			$message="<p style=\"color:red;text-align:center;\">L'id n'est pas encore dans la base de donnee!Veuillez l'ajouter</p>";
	/*	foreach ($placeholder as $key => $value) {
			echo $value;
		}*/
	}
	if(isset($_POST['btn_modifier']))
	{	
		$id=$_POST['idorg'];
		$design=$_POST['design'];
		$lieu=$_POST['lieu'];
		$req = $PDO->prepare('UPDATE organisme SET design = :design,lieu = :lieu WHERE idorg = :id');
		$req->execute(array(
				'id' => $id,
				'design' => $design,
				'lieu' => $lieu
				));
		$message ="<p style=\"color:green;text-align:center;\">Modification reussi!</p>";
	}

 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mise à jour des Organismes</title>
	<link rel="stylesheet" type="text/css" href="styleForme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<form method="POST" action="maj_org.php">
		<fieldset>
			<legend>Mettre a jour</legend>
			<div>
				<label>ID</label>
				<input type="number" name="idorg" value="<?php if (isset($placeholder['idorg'])) { echo $placeholder['idorg'];}  ?>" required readonly>
			</div>
			<div>
				<label>Design :</label>
				<input type="text" name="design" value="<?php if (isset($placeholder['design'])) { echo $placeholder['design'];}  ?>" required>	
			</div>
			<div>
				<label>Lieu :</label>
				<input type="text" name="lieu" value="<?php if (isset($placeholder['lieu'])) { echo $placeholder['lieu'];}  ?>" required>
				
			</div>
			<button type="submit" name="btn_modifier">Modifier</button>
				
		</fieldset>
			
	</form>
	<?php if (isset($message)) {
		echo $message;
	} ?>
	<a href="organisme.php"><img src="../img/return.png"></a>
	

</body>
</html>