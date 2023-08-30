<?php 
	require "../connectBDD.php";

	//_______________________________RECHERCHE
	if (isset($_POST['btn_rechercher'])) {
		if (isset($_POST['recherche'])) {
			$chercher=$_POST['recherche'];
			$req = $PDO->query("SELECT * FROM organisme WHERE idorg='$chercher' or design like '%$chercher%'");
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			if ($req==null) {
				$message_recherche = $chercher." introuvable!";
			}
			$conter = $PDO->query("SELECT count(*) as nb FROM organisme WHERE idorg='$chercher' or design like '%$chercher%'" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		else{
			$req = $PDO->query("SELECT * FROM organisme" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM organisme" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
	}
	
	

	//___________________________________SUPPRIMER
	elseif (isset($_POST['btn_supprimer'])) {
		try {
			$id = $_POST['id'];
			$req = $PDO->query("DELETE FROM organisme WHERE idorg='$id'");
			$message = "<p style=\"color:blue;text-align:center;\">Suppression reussi!</p>";
			$req = $PDO->query("SELECT * FROM organisme" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM organisme" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		} catch (Exception $e) {
			$message = "<p style=\"color:red;text-align:center;\">Erreur de suppression!</p>";	
		}
	}

	else{
		
		$req = $PDO->query("SELECT * FROM organisme" );
		$req = $req->fetchall(PDO::FETCH_ASSOC);
		$conter = $PDO->query("SELECT count(*) as nb FROM organisme" );
		$conter = $conter->fetch(PDO::FETCH_ASSOC);
		$count = $conter['nb'];
	}
	
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ORGANISME</title>
	<link rel="stylesheet" type="text/css" href="Style_organisme.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<header>
		<nav>
			<a href="../ETUDIANT/index.php">ETUDIANT</a>
			<a href="../PROFESSEUR/professeur.php">PROFESSEUR</a>
			<a style="color: #BAD7E9;" href="#">ORGANISME</a>
			<a href="../SOUTENANCE/listeGenerer.php">SOUTENANCE</a>
		</nav>
		<form method="POST" action="organisme.php"> 
			<input type="text" name="recherche" value="<?php if (isset($message_recherche)) {
				echo $message_recherche;
			} ?>" placeholder="ID/Design">
			<button type="submit" name="btn_rechercher"><div class="cadre"><img src="../img/recherche.png"></div></button>
		</form>
	</header>
	<main>
		
		<p class="resultat"><?php if (isset($count)) {
						echo "Résultat(s):<span style=\"color:#EB455F;\">".$count."</span>";
					} ?></p>
		<section class="affichage">
			<div class="titre">
				<span>ID</span>
				<span>Désignation</span>
				<span>Lieu</span>
				<span><a href="ajout_org.php"><div class="cadre"><img src="../img/ajouter1.png"></div></a></span>
			</div>
			<div class="cadre_liste">
			
				<?php 

				foreach ($req as $value) {
					echo "<div class=\"liste\">
					<span>".$value['idorg']."</span>
					<span>".$value['design']."</span>
					<span>".$value['lieu']."</span>
					<span class=\"btn\">
						<form action=\"maj_org.php\" method=\"POST\">
							<input type=\"hidden\" name=\"id\" value=\"".$value['idorg']."\">
							<button type=\"submit\" name=\"btn_maj\"><div class=\"cadre\"><img src=\"../img/crayon.png\"></div></button>
						</form>
					
						<form class=\"validation\" method=\"POST\" action=\"organisme.php\">
							<input type=\"hidden\" name=\"id\" value=\"".$value['idorg']."\">
							<button type=\"submit\" name=\"btn_supprimer\"><div class=\"cadre\"><img src=\"../img/delete.png\"></div></button>
						</form>
					</span>
					</div>
				";
				}

				 ?>

			</div>
			
		</section >
	</main>
	<?php 
		if (isset($message)) {
		 	echo $message;
		 } ?>
</body>
</html>