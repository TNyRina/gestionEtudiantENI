<?php 
	require("../connectBDD.php");
	if (isset($_POST['id'])) {
		$id=$_POST['id'];
		$placeholder=$PDO->query("SELECT * FROM professeur WHERE id_prof='$id'");
		$placeholder=$placeholder->fetch(PDO::FETCH_ASSOC);
		if($placeholder==null)
			$message="<p style=\"color:red;text-align:center;\">L'id n'est pas encore dans la base de donnee!Veuillez l'ajouter</p>";
		/*foreach ($placeholder as $key => $value) {
			echo $value;
		}*/
	}

	if(isset($_POST['btn_modifier']))
	{	
		$id=$_POST['id'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$civilite=$_POST['civilite'];
		$grade=$_POST['grade'];
		$req = $PDO->prepare('UPDATE professeur SET nom_prof = :nom,prenom_prof = :prenom,civilite = :civilite,grade = :grade WHERE id_prof = :id');
		$req->execute(array(
				'nom' => $nom,
				'prenom' => $prenom,
				'civilite' => $civilite,
				'grade' => $grade,
				'id' => $id
				));
		$message ="<p style=\"color:green;text-align:center;\">Modification reussi!</p>";
	}
		
	
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Mise à jour professeur</title>
	<link rel="stylesheet" type="text/css" href="styleForme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<form method="POST" action="maj_prof.php">
		<fieldset>
			<legend>Mettre a jour</legend>
			<div>	
				<label>ID ;</label>
				<input type="text" name="id" value="<?php if (isset($placeholder['id_prof'])) { echo $placeholder['id_prof'];}  ?>" required readonly>
			</div>
			<div>
				<label>Nom :</label>
				<input type="text" name="nom" value="<?php if (isset($placeholder['nom_prof'])) { echo $placeholder['nom_prof'];}  ?>" required>	
			</div>
			<div>
				<label>Prénoms :</label>
				<input type="text" name="prenom" value="<?php if (isset($placeholder['prenom_prof'])) { echo $placeholder['prenom_prof'];}  ?>" required>	
			</div>
			<section>
				<p>Civilité : <br>
				<input type="radio" name="civilite" value="Mr" id="_Mr"  <?php if (isset($placeholder['civilite']) and $placeholder['civilite']=='Mr')  {echo "checked";} ?> required /> 
				<label for="_Mr">Mr</label>
				<input type="radio" name="civilite" value="Mlle" id="_Mlle"  <?php if (isset($placeholder['civilite']) and $placeholder['civilite']=='Mlle')  {echo "checked";} ?> required/>
				<label for="_Mlle">Mlle</label>
				<input type="radio" name="civilite" value="Mme" id="_Mme"  <?php if (isset($placeholder['civilite']) and $placeholder['civilite']=='<Mme')  {echo "checked";} ?> required/>
				<label for="_Mme">Mme</label>
			</section>
				
			
			<div>
				<label for="grade">Grade : </label><br />
				<select name="grade" id="grade">
					<option value="Professeur titulaire"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Professeur titulaire")  {echo "selected";} ?> required>Professeur titulaire</option>
					<option value="Maitre de conference"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Maitre de conference")  {echo "selected";} ?> required>Maître de conférence</option>
					<option value="Assistant d'enseignement superieur et de recherche"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Assistant d'enseignement superieur et de recherche")  {echo "checked";} ?> required>Assistant d'enseignement superieur et de recherche</option>
					<option value="Docteur HDR"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Docteur HDR")  {echo "selected";} ?> required>Docteur HDR</option>
					<option value="Docteur en informatique"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Docteur en informatique")  {echo "selected";} ?> required>Docteur en informatique</option>
					<option value="Doctorant en informatique"  <?php if (isset($placeholder['grade']) and $placeholder['grade']=="Doctorant en informatique")  {echo "selected";} ?> required>Doctorant en informatique</option>			
				</select>
			</div>
			<button type="submit" name="btn_modifier">Modifier</button>
		</fieldset>
	</form>	
	<?php if (isset($message)) {
		echo $message;
	} ?>
	<a href="professeur.php"><img src="../img/return.png"></a>
</body>
</html>