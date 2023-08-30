<?php 
	require "../connectBDD.php";


	if (isset($_POST['btn_recherche'])) {

		if (isset($_POST['recherche'])) {
			$chercher=$_POST['recherche'];
			$req = $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg WHERE (soutenir.matricule='$chercher')");
		
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			if($req==null){
				$message_recherche = $chercher." introuvable!";
			$conter = $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule WHERE (soutenir.matricule='$chercher')" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
			}
		
		}
		else
		{
			$req = $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.id_org FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg " );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant JOIN soutenir ON etudiant.matricule=soutenir.matricule" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		
			
	}

	elseif (isset($_POST['bouton_TRIER'])) {
		if (isset($_POST['parcour']) and isset($_POST['annee'])) {
			//echo "string";
			$niv=$_POST['parcour'];
			$anne=$_POST['annee'];
			if ($anne==0) {
				$req= $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN annee ON annee.annee_univ=soutenir.annee_univ JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcours='$niv'");
				$req=$req->fetchall(PDO::FETCH_ASSOC);

				$conter= $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN annee ON annee.annee_univ=soutenir.annee_univ JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcours='$niv'");
				$conter=$conter->fetch(PDO::FETCH_ASSOC);
				$count = $conter['nb'];
			}
			else
			{
				$req= $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN annee ON annee.annee_univ=soutenir.annee_univ JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcours='$niv' and soutenir.annee_univ='$anne'");
				$req=$req->fetchall(PDO::FETCH_ASSOC);

				$conter= $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN annee ON annee.annee_univ=soutenir.annee_univ JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcours='$niv' and soutenir.annee_univ='$anne'");
				$conter=$conter->fetch(PDO::FETCH_ASSOC);
				$count = $conter['nb'];
				}	
		}
		elseif (isset($_POST['parcour'])) 
		{
			$niv = $_POST['parcour'];
			//echo $niv;
			$req= $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcour='$niv'");
			$req=$req->fetchall(PDO::FETCH_ASSOC);

			$conter= $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg WHERE parcour='$niv'");
			$conter=$conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		elseif (isset($_POST['annee'])) {
			$annee=$_POST['annee'];
			//echo $annee;
			if ($annee==0) {
				$req = $PDO->query("SELECT * FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg");
				$req = $req->fetchall(PDO::FETCH_ASSOC);

				$conter = $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg");
				$conter = $conter->fetch(PDO::FETCH_ASSOC);
				$count = $conter['nb'];
			}
			else{
				$req= $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg WHERE annee_univ='$annee'");
				$req=$req->fetchall(PDO::FETCH_ASSOC);

				$conter= $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule  JOIN organisme ON soutenir.idorg=organisme.idorg WHERE annee_univ='$annee'");
				$conter=$conter->fetch(PDO::FETCH_ASSOC);
				$count = $conter['nb'];
			}
		}
		else
		{
			$req = $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM etudiant JOIN soutenir ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
	}
	
	elseif (isset($_POST['btn_supprimer'])) {
		try {
			if ($_POST['matricule']!=null and $_POST['organisme']!=null and $_POST['annee']!=null)  {
				$matricule=$_POST['matricule'];

				$org=$_POST['organisme'];

				$annee=$_POST['annee'];

				$delete=$PDO->query("DELETE FROM soutenir WHERE matricule='$matricule' and id_org='$org' and annee_univ='$annee'");
				$message="<p style=\"color:blue;text-align:center;\">Suppression reussi!</p>";
				}
				else
					$message = "<p style=\"color:red;text-align:center;\">Aucune information selectionee</p>";
				$req = $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcour,mail,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.id_org FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.id_org=organisme.id_org" );
				$req = $req->fetchall(PDO::FETCH_ASSOC);
				$conter = $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg" );
				$conter = $conter->fetch(PDO::FETCH_ASSOC);
				$count = $conter['nb'];
				
			} catch (Exception $e) {
				$message = "<p style=\"color:red;text-align:center;\">Assurez vous que les informations sont correctes</p>";
			}
		
	}
	
	else
		{
			$req = $PDO->query("SELECT design,soutenir.matricule,nom,prenoms,niveau,parcours,adr_email,soutenir.annee_univ,note,president,examinateur,rapporteur_int,rapporteur_ext,soutenir.idorg FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM soutenir JOIN etudiant ON etudiant.matricule=soutenir.matricule JOIN organisme ON soutenir.idorg=organisme.idorg" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
				

	$annee=$PDO->query("SELECT DISTINCT soutenir.annee_univ FROM annee JOIN soutenir ON annee.annee_univ=soutenir.annee_univ");
	$annee=$annee->fetchall(PDO::FETCH_ASSOC);
 ?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LISTAGE</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="../srcipt.js"></script>
</head>
<body>
	<header>
		<nav>
			<a href="../ETUDIANT/index.php">ETUDIANT</a>
			<a href="../PROFESSEUR/professeur.php">PROFESSEUR</a>
			<a href="../ORGANISME/organisme.php">ORGANISME</a>
			<a style="color: #BAD7E9;" href="#">SOUTENANCE</a>
		</nav>
		<form method="POST" action="listeGenerer.php"> 
			<input type="text" name="recherche" value="<?php if (isset($message_recherche)) {
		 	echo $message_recherche;
		 } ?>" placeholder="Matricule">
			<button type="submit" name="btn_recherche"><div class="cadre"><img src="../img/recherche.png"></div></button>
		</form>
	</header>
	<main>	
		<section class="filtre">
			<form method="POST" action="listeGenerer.php" class="filtre">
				<div class="filtre">
					<fieldset>
						<div>
						<h5>Parcours</h5>
						<input type="radio" name="parcour" value="IG"><label>IG</label>
						<input type="radio" name="parcour" value="GB"><label>GB</label>
						<input type="radio" name="parcour" value="SR"><label>SR</label>
						</div>
						<div>
							<h5>Année Universitaire</h5>
						<select name="annee" size="1">
							<option value="0">Tous</option>
							<?php  
								foreach($annee as $value)
									echo "<option value=".$value['annee_univ'].">".$value['annee_univ']."</option>";
							 ?>
							
						</select>
						</div>
					</fieldset>
					
					
					<button type="submit" name="bouton_TRIER">TRIER</button>
				</div>
			
		</form>
		
		</section>
		<p class="resultat"><?php if (isset($count)) {
						echo "Résultat(s):<span style=\"color:#EB455F;\">".$count."</span>";
					} ?></p>
		
		<section class="affichage">
			<div class="titre">
				<span>Matricule</span>
				<span>Organisme</span>
				<span>Année Universitaire</span>
				<span>Niveau</span>
				<span>Parcours</span>
				<span>Note</span>
				<span>
					<a href="formulaire.php"><div class="cadre"><img src="../img/ajouter1.png"></div></a>
				</span>
				<span>
					
				</span>
				<span>
					
				</span>
			</div>
			
				<div class="cadre_liste">
				
			
			
				<?php 

				foreach ($req as $value) {
					echo "
			<form action=\"generer_pdf.php\" method=\"POST\">
			<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
			<input type=\"hidden\" name=\"parcours\" value=\"".$value['parcours']."\">
			<input type=\"hidden\" name=\"nom\" value=\"".$value['nom']."\">
			<input type=\"hidden\" name=\"prenom\" value=\"".$value['prenoms']."\">
			<input type=\"hidden\" name=\"note\" value=\"".$value['note']."\">
			<input type=\"hidden\" name=\"president\" value=\"".$value['president']."\">
			<input type=\"hidden\" name=\"examin\" value=\"".$value['examinateur']."\">
			<input type=\"hidden\" name=\"rapp_int\" value=\"".$value['rapporteur_int']."\">
			<input type=\"hidden\" name=\"rapp_ext\" value=\"".$value['rapporteur_ext']."\">";
					echo "<div class=\"liste\">
					<span>".$value['matricule']."</span>
					<span>".$value['design']."</span>
					<span>".$value['annee_univ']."</span>
					<span>".$value['niveau']."</span>
					<span>".$value['parcours']."</span>
					<span>".$value['note']."</span>
					<span class=\"btn\">
						<form action=\"generer_pdf.php\" method=\"POST\">
							<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
							<button type=\"submit\" name=\"btn_maj\"><div class=\"cadre\"><img src=\"../img/pdf-file.png\"></div></button>
						</form>
					</span>
					<span>
						<form action=\"maj_soutenance.php\" method=\"POST\">
							<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
							<input type=\"hidden\" name=\"organisme\" value=\"".$value['idorg']."\">
							<input type=\"hidden\" name=\"annee\" value=\"".$value['annee_univ']."\">
							<button type=\"submit\" name=\"btn_maj_soutenance\"><div class=\"cadre\"><img src=\"../img/crayon.png\"></div></button>
						</form>
					</span>
					<span>
						<form action=\"listeGenerer.php\" method=\"POST\">
							<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
							<input type=\"hidden\" name=\"organisme\" value=\"".$value['idorg']."\">
							<input type=\"hidden\" name=\"annee\" value=\"".$value['annee_univ']."\">
							<button type=\"submit\" name=\"btn_supprimer\"><div class=\"cadre\"><img src=\"../img/delete.png\"></div></button>
						</form>
					</span>

					</div>
				";
				}

				 ?>

			</div>
			
		</section>	
	</main>
	<?php 
		if (isset($message)) {
		 	echo $message;
		 } ?>
</body>
</html>