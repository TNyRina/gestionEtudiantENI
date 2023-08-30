<?php require("../connectBDD.php");

	if (isset($_POST['Enregistrer'])) 
	{
		try {
			
			$matricule=$_POST['matricule'];
			$nom=$_POST['nom'];
			$prenoms=$_POST['prenoms'];
			$niveau=$_POST['niveau'];
			$parcours=$_POST['parcours'];
			$email=$_POST['email'];
			
			// On ajoute une entrée dans la table ETUDIANTS

			$req = $PDO->prepare("INSERT INTO etudiant VALUES(:matricule,
			:nom_etudiant, :prenom_etudiant, :niveau, :parcour, :mail)");
			$req->execute(array(
			'matricule' => $matricule,
			'nom_etudiant' => $nom,
			'prenom_etudiant' => $prenoms,
			'niveau' => $niveau,
			'parcour' => $parcours,
			'mail' => $email
			));
			$message ="<p style=\"color:green;text-align:center;\">Ajout reussi!</p>";

			
		} catch (Exception $e) {
				$message ="<p style=\"color:red;text-align:center;\">Matricule invalide ou deja existant!</p>";
		}
		
	}
	

	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>formulaire etudiant</title>
	<link rel="stylesheet" type="text/css" href="styleForme.css">
</head>
<body>
	<form method="POST" action="ajout_etudiants.php">
		<fieldset>
			<legend>Ajouter un etudiant </legend>
			<div>
				<label>Matricule <span style="color: #EB455F;">*</span>:</label>
				<input type="text" name="matricule"  required>
			</div>
			<div>
				<label>Nom <span style="color: #EB455F;">*</span>:</label>
				<input type="text" name="nom"  required>	
			</div>
			<div>
				<label>Prénoms <span style="color: #EB455F;">*</span>:</label>
				<input type="text" name="prenoms"  required>
				
			</div>
			<div>
				<label>Adresse e-mail <span style="color: #EB455F;">*</span>:</label>
				<input type="email" name="email"  required/>
			</div>
			<hr>
			<section>Niveau <span style="color: #EB455F;">*</span>:
				<input type="radio" name="niveau" value="L1" required/> 
				<label>L1</label>
				<input type="radio" name="niveau" value="L2"  required/>
				<label>L2</label>
				<input type="radio" name="niveau" value="L3"  required/>
				<label>L3</label>
				<input type="radio" name="niveau" value="M1"  required/>
				<label>M1</labe>
				<input type="radio" name="niveau" value="M2"  required/>
				<label>M2</label>
			</section>
			<section>Parcours <span style="color: #EB455F;">*</span>:
				<input type="radio" name="parcours" value="GB" id="_GB"  required/> 
				<label for="_GB">GB</label>
				<input type="radio" name="parcours" value="SR" id="_SR"  required/>
				<label for="_SR">SR</label>
				<input type="radio" name="parcours" value="IG" id="_IG" required/>
				<label for="_IG">IG</label>
			</section>
			<hr>
			
				<button type="submit" name="Enregistrer"/>Enregistrer</button>
				<button type="reset" name="Effacer"/>Effacer</button>
			
		</fieldset>
	</form>
	<?php if (isset($message)) {
				echo $message;
			} ?>
	<a href="index.php"><img src="../img/return.png"></a>

</body>
</html>