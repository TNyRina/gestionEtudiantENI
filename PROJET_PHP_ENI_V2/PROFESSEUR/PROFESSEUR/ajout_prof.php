	<?php require("../connectBDD.php");
	if (isset($_POST['Enregistrer'])) 
	{
		//echo "string";
		try 
		{
			//echo "champs non vide";
			$id=$_POST['Id'];
			$nom=$_POST['nom'];
			$prenoms=$_POST['prenoms'];
			$civilite=$_POST['civilite'];
			$grade=$_POST['grade'];
			
			// On ajoute une entrée dans la table ETUDIANTS

			$req = $PDO->prepare("INSERT INTO professeur VALUES(:id_prof,
			:nom_prof, :prenom_prof, :civilite, :grade)");
			$req->execute(array(
			'id_prof' => $id,
			'nom_prof' => $nom,
			'prenom_prof' => $prenoms,
			'civilite' => $civilite,
			'grade' => $grade
			));
			$message ="<p style=\"color:green;text-align:center;\">Ajout reussi!</p>";
			//echo 'ajouté !';
		}
		catch (Exception $e) {
				$message ="<p style=\"color:red;text-align:center;\">Id invalide ou deja existant!</p>";
		}
	}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Ajout professeur</title>
	<link rel="stylesheet" type="text/css" href="styleForme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="../srcipt.js"></script>
</head>
<body>
	<form method="POST" action="ajout_prof.php">
		<fieldset>
			<legend>Ajouter un professeur</legend>
			<div>
				<label>Id :</label>
				<input type="text" name="Id"  required>
			</div>
			<section>Civilité : 
				<input type="radio" name="civilite" value="Mr" id="_Mr"  required/> 
				<label for="_Mr">Mr</label>
				<input type="radio" name="civilite" value="Mlle" id="_Mlle"  required/>
				<label for="_Mlle">Mlle</label>
				<input type="radio" name="civilite" value="Mme" id="_Mme"  required/>
				<label for="_Mme">Mme</label>
			</section>
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" placeholder="" required>	
			</div>
			<div>
				<label>Prénoms :</label>
				<input type="text" name="prenoms" placeholder="" required>
				
			</div>

			
			<div>
				<label for="grade">Grade : </label>
				<select name="grade" id="grade" required>
					<option value="Professeur titulaire">Professeur titulaire</option>
					<option value="Maître de Conférences">Maître de Conférences</option>
					<option value="Assistant d’Enseignement Supérieur et de Recherche">Assistant d’Enseignement Supérieur et de Recherche</option>
					<option value="Docteur HDR">Docteur HDR</option>
					<option value="Docteur en Informatique">Docteur en Informatique</option>
					<option value="Doctorant en Informatique">Doctorant en Informatique</option>
				</select>
			</div>

			
				<button type="submit" name="Enregistrer">Enregistrer</button>
				<button type="reset" name="Effacer">Effacer</button>
			
		</fieldset>
		
	</form>
	<?php if (isset($message)) {
		echo $message;
	} ?>
	<a href="professeur.php"><img src="../img/return.png"></a>
</body>
</html>