<?php 
	require("../connectBDD.php");
	if (isset($_POST['matricule'])) {
		$matricule=$_POST['matricule'];
		$placeholder=$PDO->query("SELECT * FROM etudiant WHERE matricule='$matricule'");
		$placeholder=$placeholder->fetch(PDO::FETCH_ASSOC);
	}

	if(isset($_POST['btn_modifier']))
	{	
		try {
			$matricule=$_POST['matricule'];
			$nom=$_POST['nom'];
			$prenoms=$_POST['prenom'];
			$niveau=$_POST['niveau'];
			$parcours=$_POST['parcour'];
			$adr_email=$_POST['mail'];
			$req = $PDO->prepare('UPDATE etudiant SET nom = :nom,prenoms = :prenoms,niveau = :niveau,parcours = :parcours,adr_email = :adr_email WHERE matricule = :matricule');
			$req->execute(array(
					'nom' => $nom,
					'prenoms' => $prenoms,
					'niveau' => $niveau,
					'parcours' => $parcours,
					'adr_email' => $adr_email,
					'matricule' => $matricule
					));
			$message ="<p style=\"color:green;text-align:center;\">Modification reussi!</p>";
		} catch (Exception $e) {
			$message="<p style=\"color:red;text-align:center;\">Erreur de Modification!</p>";
		}
	
	}
	?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mise à jour etudiant</title>
	<link rel="stylesheet" type="text/css" href="styleForme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<form method="POST" action="maj_etudiant.php">
		<fieldset>
			<legend>Mettre a jour</legend>
		<div>
			<label>Matricule:</label>
			<input type="text" name="matricule" value="<?php if (isset($placeholder['matricule'])) { echo $placeholder['matricule'];}  ?>" required readonly>
		</div>
		
		<div>
			<label>Nom:</label>
			<input type="text" name="nom" value="<?php if (isset($placeholder['nom_etudiant'])) { echo $placeholder['nom_etudiant'];}  ?>" required>	
		</div>
		<div>
			<label>Prénoms:</label>
			<input type="text" name="prenom" value="<?php if (isset($placeholder['prenom_etudiant'])) { echo $placeholder['prenom_etudiant'];}  ?>" required>
			
		</div>
		<div>
			<label>Adresse e-mail :</label>
			<input type="email" name="mail" value="<?php if (isset($placeholder['mail'])) { echo $placeholder['mail'];}  ?>" required/>
		</div>
		<hr>
		<section>Niveau :
			<input type="radio" name="niveau" value="L1" id="_L1" <?php if (isset($placeholder['niveau']) and $placeholder['niveau']=='L1')  {echo "checked";} ?> required/> 
			<label for="_L1">L1</label>
			<input type="radio" name="niveau" value="L2" id="_L2" <?php if (isset($placeholder['niveau']) and $placeholder['niveau']=='L2')  {echo "checked";} ?> required/>
			<label for="_L2">L2</label>
			<input type="radio" name="niveau" value="L3" id="_L3" <?php if (isset($placeholder['niveau']) and $placeholder['niveau']=='L3')  {echo "checked";} ?> required/>
			<label for="_L3">L3</label>
			<input type="radio" name="niveau" value="M1" id="_M1" <?php if (isset($placeholder['niveau']) and $placeholder['niveau']=='M1')  {echo "checked";} ?> required/>
			<label for="_M1">M1</label>
			<input type="radio" name="niveau" value="M2" id="_M2" <?php if (isset($placeholder['niveau']) and $placeholder['niveau']=='M2')  {echo "checked";} ?> required/>
			<label for="_M2">M2</label>
		</section>
		<section>Parcours : 
			<input type="radio" name="parcour" value="GB" id="_GB" <?php if (isset($placeholder['parcour']) and $placeholder['parcour']=='GB')  {echo "checked";} ?> required/> 
			<label for="_GB">GB</label>
			<input type="radio" name="parcour" value="SR" id="_SR" <?php if (isset($placeholder['parcour']) and $placeholder['parcour']=='SR')  {echo "checked";} ?> required/>
			<label for="_SR">SR</label>
			<input type="radio" name="parcour" value="IG" id="_IG" <?php if (isset($placeholder['parcour']) and $placeholder['parcour']=='IG')  {echo "checked";} ?> required/>
			<label for="_IG">IG</label>
		</section>
		<hr>
		<button type="submit" name="btn_modifier">Modifier</button>
		
		</fieldset>
		
	</form>
	<?php if (isset($message)) {
		echo $message;
	} ?>
	<a href="index.php"><img src="../img/return.png"></a>
	
	

</body>
</html>