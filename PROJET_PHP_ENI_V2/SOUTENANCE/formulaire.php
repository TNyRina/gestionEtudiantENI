<?php 
	require '../connectBDD.php';

	
	$select_nom_prof = $PDO->query("SELECT nom from professeur");
	$select_nom_prof=$select_nom_prof->fetchall(PDO::FETCH_ASSOC);
	
	function selection_nom_prof($select,$value,$prenom)
	{
		foreach($select as $val)
			echo "<option value=\"".$val[$value]."\">".$val[$value]." ".$val[$prenom]."</option>";
	}
	
	if (isset($_POST['btn_enregistrer'])) 
	{
		$matricule=$_POST['matricule'];
		$verification = $PDO->query("SELECT * FROM etudiant WHERE matricule='$matricule'");
		$verification = $verification->fetch(PDO::FETCH_ASSOC);
		if ($verification==null) {
			$message ="<p style=\"color:red;text-align:center;\">Matricule inconnu!(Veuillez l'ajouter)</p>";	;
		}
		else{
			try {
				$org=$_POST['organisme'];
				$select_org = $PDO->query("SELECT idorg FROM organisme WHERE design='$org'");
				$select_org = $select_org->fetch(PDO::FETCH_ASSOC);
				$org=$select_org['idorg'];

				$annee=$_POST['annee'];
				$note=$_POST['note'];

				$pres=$_POST['president'];
				$select_pres=$PDO->query("SELECT idprof FROM professeur WHERE nom='$pres'");
				$select_pres=$select_pres->fetch(PDO::FETCH_ASSOC);
				$pres=$select_pres['idprof'];

				$exam=$_POST['examinateur'];
				$select_exam=$PDO->query("SELECT idprof FROM professeur WHERE nom='$exam'");
				$select_exam=$select_exam->fetch(PDO::FETCH_ASSOC);
				$exam=$select_exam['idprof'];

				$rap_int=$_POST['rapp_int'];
				$select_rap_int=$PDO->query("SELECT idprof FROM professeur WHERE nom='$rap_int'");
				$select_rap_int=$select_rap_int->fetch(PDO::FETCH_ASSOC);
				$rap_int=$select_rap_int['idprof'];

				$rap_ext=$_POST['rapp_ext'];
				$select_rap_ext=$PDO->query("SELECT idprof FROM professeur WHERE nom='$rap_ext'");
				$select_rap_ext=$select_rap_ext->fetch(PDO::FETCH_ASSOC);
				$rap_ext=$select_rap_ext['idprof'];
				
				// On ajoute une entrée dans la table ETUDIANTS

				$req = $PDO->prepare("INSERT INTO soutenir VALUES(:matricule,
				:idorg, :Anne_univ, :note, :president, :examinateur, :rapporteur_int, :rapporteur_ext)");
				$req->execute(array(
				'matricule' => $matricule,
				'idorg' => $org,
				'Anne_univ' => $annee,
				'note' => $note,
				'president' => $pres,
				'examinateur' => $exam,
				'rapporteur_int' => $rap_int,
				'rapporteur_ext' => $rap_ext
				));
			$message ="<p style=\"color:green;text-align:center;\">Ajout reussi!</p>";
		} catch (Exception $e) {
			$message ="<p style=\"color:red;text-align:center;\">Matricule invalide ou deja existant!</p>";	
		}
		}
	
		
		


	}
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Generation PDF</title>
	<link rel="stylesheet" type="text/css" href="../styleForme.css">

	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="../srcipt.js"></script>
</head>
<body>
	<main>
		<form action="formulaire.php" method="POST" class="generPDF">
			<fieldset>
				<legend>Ajouter un soutenance</legend>
				<div>
					<label>Matricule<span>*</span></label>
					<input type="text" name="matricule" required>
				</div>
				<div>
					<label>Organisme<span>*</span></label>
					<select name="organisme" size="1">
						<?php 
							$org=$PDO->query("SELECT * FROM organisme");
							$org=$org->fetchall(PDO::FETCH_ASSOC);

							foreach($org as $value)
								echo "<option value=".$value['design'].">".$value['design']."</option>";
						 ?>
						
					</select>
				</div>
				<div>
					<label>Annee universitaire</label>
					<select name="annee" size="1">
						<?php 
							$annee=$PDO->query("SELECT * FROM annee");
							$annee=$annee->fetchall(PDO::FETCH_ASSOC);

							foreach($annee as $value)
								echo "<option value=".$value['annee_univ'].">".$value['annee_univ']."</option>";
						 ?>
						
					</select>
				</div>
				<hr>
				<div>
					<label>President(e)<span>*</span></label>
					<select name="president" required>
						<?php 
							selection_nom_prof($select_nom_prof,"nom","prenoms");
						 ?>
					</select>
				</div>
				<div>
					<label>Examinateur<span>*</span></label>
					<select name="examinateur" required>
						<?php 
							selection_nom_prof($select_nom_prof,"nom","prenoms");
						 ?>
					</select>
				</div>
				<div>
					<label>Rapporteur interieur<span>*</span></label>
					<select name="rapp_int" required>
						<?php 
							selection_nom_prof($select_nom_prof,"nom","prenoms");
						 ?>
					</select>
				</div>
				<div>
					<label>Rappoteur exterieur<span>*</span></label>
					<select name="rapp_ext" required>
						<?php 
							selection_nom_prof($select_nom_prof,"nom","prenoms");
						 ?>
					</select>
				</div>
				<hr>
				<div>
					<label>Note :</label>
					<input type="number" name="note" min="0" max="20" required>
				</div>
				
			
			</fieldset>
			<button type="submit" name="btn_enregistrer">Enregistrer</button>
			<button type="reset">Effacer</button>
		</form>
		<?php if (isset($message)) {
				echo $message;
			} ?>
	<a href="listeGenerer.php"><img src="../img/return.png"></a>
	</main>
</body>
</html>