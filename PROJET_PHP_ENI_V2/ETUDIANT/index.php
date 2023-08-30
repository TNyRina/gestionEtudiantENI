<?php 
	
	require "../connectBDD.php";

	//_______________________TRIE
	if (isset($_POST['btn_trier'])) {
		if (isset($_POST['niveau']) and isset($_POST['parcours'])) {
			$niveau = $_POST['niveau'];
			$parcours = $_POST['parcours'];
			
			$req = $PDO->query("SELECT * FROM etudiant WHERE niveau='$niveau' and parcours='$parcours'" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);

			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant WHERE niveau='$niveau' and parcours='$parcours'" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		elseif (isset($_POST['niveau'])) {
			$niveau = $_POST['niveau'];
			
			$req = $PDO->query("SELECT * FROM etudiant WHERE niveau='$niveau'" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);

			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant WHERE niveau='$niveau'");
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		elseif (isset($_POST['parcours'])) {
			$parcours = $_POST['parcours'];
			
			$req = $PDO->query("SELECT * FROM etudiant WHERE parcours='$parcours'" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant WHERE parcours='$parcours'" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		else
		{
			
			$req = $PDO->query("SELECT * FROM etudiant" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		
	}

	//_______________________________RECHERCHE
	elseif (isset($_POST['btn_rechercher'])) {
		if (isset($_POST['recherche'])) {
			$chercher=$_POST['recherche'];
			$req = $PDO->query("SELECT * FROM etudiant WHERE matricule='$chercher' or nom like '%$chercher%'");
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			if ($req==null) {
				$message_recherche = $chercher." introuvable!";
			}
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant WHERE matricule='$chercher' or nom like '%$chercher%'" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		else{
			$req = $PDO->query("SELECT * FROM etudiant" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
	}
	

	//___________________________________SUPPRIMER
	elseif (isset($_POST['btn_supprimer'])) {
		try {
			$matricule = $_POST['matricule'];
			$req = $PDO->query("DELETE FROM etudiant WHERE matricule='$matricule'");
			$message = "<p style=\"color:blue;text-align:center;\">Suppression reussi!</p>";
			$req = $PDO->query("SELECT * FROM etudiant" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM etudiant" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		} catch (Exception $e) {
			$message = "<p style=\"color:red;text-align:center;\">Erreur de suppression!</p>";	
		}
	}

	//______________________________NON_SOUTENANCE
	elseif (isset($_POST['btn_non_soutenance'])) {
		$req = $PDO->query("SELECT etudiant.matricule as matricule,adr_email,nom,prenoms,niveau,parcours,note FROM etudiant LEFT JOIN soutenir ON etudiant.matricule=soutenir.matricule WHERE note is null" );
		$req = $req->fetchall(PDO::FETCH_ASSOC);
		$conter = $PDO->query("SELECT count(*) as nb FROM etudiant LEFT JOIN soutenir ON etudiant.matricule=soutenir.matricule WHERE note is null" );
		$conter = $conter->fetch(PDO::FETCH_ASSOC);
		$count = $conter['nb'];
	}
	else{
		
		$req = $PDO->query("SELECT * FROM etudiant" );
		$req = $req->fetchall(PDO::FETCH_ASSOC);
		$conter = $PDO->query("SELECT count(*) as nb FROM etudiant" );
		$conter = $conter->fetch(PDO::FETCH_ASSOC);
		$count = $conter['nb'];
	}
	
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ETUDIANT</title>
	<link rel="stylesheet" type="text/css" href="style_et.css">
	<script src="../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="new_script.js"></script>
</head>
<body id="boody">
	<header>
		<nav>
			<a style="color: #BAD7E9;" href="#">ETUDIANT</a>
			<a href="../PROFESSEUR/professeur.php">PROFESSEUR</a>
			<a href="../ORGANISME/organisme.php">ORGANISME</a>
			<a href="../SOUTENANCE/listeGenerer.php">SOUTENANCE</a>
		</nav>
		<form method="POST" action="index.php"> 
			<input type="text" name="recherche" value="<?php if (isset($message_recherche)) {
				echo "";
			} ?>" placeholder="Matricule/Nom">
			<button type="submit" name="btn_rechercher"><div class="cadre"><img src="../img/recherche.png"></div></button>
		</form>
	</header>
	<main>
		
		<section class="filtre">
			<form method="POST" action="index.php" class="form_filtre">
				<div class="filtre">
					<fieldset>
						<div>
						<h5>Niveau</h5>
						<input type="radio" name="niveau" value="L1"><label>L1</label>
						<input type="radio" name="niveau" value="L2"><label>L2</label>
						<input type="radio" name="niveau" value="L3"><label>L3</label>
						<input type="radio" name="niveau" value="M1"><label>M1</label>
						<input type="radio" name="niveau" value="M2"><label>M2</label>
					</div>
					
					<div>
						<h5>Parcours</h5>
						<input type="radio" name="parcours" value="IG"><label>IG</label>
						<input type="radio" name="parcours" value="GB"><label>GB</label>
						<input type="radio" name="parcours" value="SR"><label>SR</label>
					</div>
					</fieldset>
					
					<button type="submit" name="btn_trier">TRIER</button>
					<button type="submit" name="btn_non_soutenance">Les étudiants qui n’ont pas encore effectué de soutenance</button>
				</div>				
					
			</form>
			
		</section>
		<p class="resultat"><?php if (isset($count)) {
						echo "Résultat(s):<span style=\"color:#EB455F;\">".$count."</span>";
					} ?></p>
		<section class="affichage">
			<div class="titre">
				<span>Matricule</span>
				<span>Nom</span>
				<span>Prénoms</span>
				<span>Niveau</span>
				<span>Parcours</span>
				<span>Mail</span>
				<span><a href="ajout_etudiants.php"><div class="cadre"><img src="../img/ajouter1.png"></div></a></span>
			</div>
			<div class="cadre_liste">
				
			
			
				<?php 

					foreach ($req as $value) {
						echo "<div class=\"liste\">
						<span>".$value['matricule']."</span>
						<span>".$value['nom']."</span>
						<span>".$value['prenoms']."</span>
						<span>".$value['niveau']."</span>
						<span>".$value['parcours']."</span>
						<span>".$value['adr_email']."</span>
						<span class=\"btn\">
							<form action=\"maj_etudiant.php\" method=\"POST\">
								<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
								<button type=\"submit\" name=\"btn_maj\"><div class=\"cadre\"><img src=\"../img/crayon.png\"></div></button>
							</form>
							<div class=\"cadre click \"><img src=\"../img/delete.png\"></div>
							<form  id=\"".$value['matricule']."\" class=\"suppression\" method=\"POST\" action=\"index.php\">
								<input type=\"hidden\" name=\"matricule\" value=\"".$value['matricule']."\">
								<p>Voulez-vous vraiment supprimer cet etudiant ?</p>
							<div class=\"btn\">
								<button type=\"submit\" name=\"btn_supprimer\">Supprimer</button>
								<button type=\"reset\" class=\"non\">Annuler</button>
							</div>

						</form>
						</span>
						</div>
					";
					}
				?>

			</div>

			
		</section >
		<?php 
		if (isset($message)) {
		 	echo $message;
		 } ?>
	</main>
	
</body>
</html>