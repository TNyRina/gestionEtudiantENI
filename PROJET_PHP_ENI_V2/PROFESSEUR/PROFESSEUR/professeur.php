<?php 
	require "../connectBDD.php";

	//_______________________________RECHERCHE
	if (isset($_POST['btn_rechercher'])) {
		if (isset($_POST['recherche'])) {
			$chercher=$_POST['recherche'];
			$req = $PDO->query("SELECT * FROM professeur WHERE id_prof='$chercher' or nom_prof like '%$chercher%'");
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			if ($req==null) {
				$message_recherche = $chercher." introuvable!";
			}
			$conter = $PDO->query("SELECT count(*) as nb FROM professeur WHERE id_prof='$chercher' or nom_prof like '%$chercher%'" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
		else{
			$req = $PDO->query("SELECT * FROM professeur" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM professeur" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		}
	}
	
	

	//___________________________________SUPPRIMER
	elseif (isset($_POST['btn_supprimer'])) {
		try {
			$id = $_POST['id'];
			$req = $PDO->query("DELETE FROM professeur WHERE id_prof='$id'");
			$message = "<p style=\"color:blue;text-align:center;\">Suppression reussi!</p>";
			$req = $PDO->query("SELECT * FROM professeur" );
			$req = $req->fetchall(PDO::FETCH_ASSOC);
			$conter = $PDO->query("SELECT count(*) as nb FROM professeur" );
			$conter = $conter->fetch(PDO::FETCH_ASSOC);
			$count = $conter['nb'];
		} catch (Exception $e) {
			$message = "<p style=\"color:red;text-align:center;\">Erreur de suppression!</p>";	
		}
	}

	else{
		
		$req = $PDO->query("SELECT * FROM professeur" );
		$req = $req->fetchall(PDO::FETCH_ASSOC);
		$conter = $PDO->query("SELECT count(*) as nb FROM professeur" );
		$conter = $conter->fetch(PDO::FETCH_ASSOC);
		$count = $conter['nb'];
	}
	
	

 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PROFESSEUR</title>
	<link rel="stylesheet" type="text/css" href="Style.css">
	<script src="../../jquery-3.6.4.min.js"></script>
	<script type="text/javascript" src="script.js"></script>
</head>
<body>
	<header>
		<nav>
			<a href="../ETUDIANT/index.php">ETUDIANT</a>
			<a style="color: #BAD7E9;" href="#">PROFESSEUR</a>
			<a href="../ORGANISME/organisme.php">ORGANISME</a>
			<a href="../SOUTENANCE/listeGenerer.php">SOUTENANCE</a>
		</nav>
		<form method="POST" action="professeur.php"> 
			<input type="text" name="recherche" value="<?php if (isset($message_recherche)) {
				echo $message_recherche;
			} ?>" placeholder="ID/Nom">
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
				<span>Nom</span>
				<span>Prénoms</span>
				<span>Civilité</span>
				<span>Grade</span>
				<span><a href="ajout_prof.php"><div class="cadre"><img src="../img/ajouter1.png"></div></a></span>
			</div>
			<div class="cadre_liste">
			
				<?php 

				foreach ($req as $value) {
					echo "<div class=\"liste\">
					<span>".$value['id_prof']."</span>
					<span>".$value['nom_prof']."</span>
					<span>".$value['prenom_prof']."</span>
					<span>".$value['civilite']."</span>
					<span>".$value['grade']."</span>
					<span class=\"btn\">
						<form action=\"maj_prof.php\" method=\"POST\">
							<input type=\"hidden\" name=\"id\" value=\"".$value['id_prof']."\">
							<button type=\"submit\" name=\"btn_maj\"><div class=\"cadre\"><img src=\"../img/crayon.png\"></div></button>
						</form>
					
						<form class=\"validation\" method=\"POST\" action=\"professeur.php\">
							<input type=\"hidden\" name=\"id\" value=\"".$value['id_prof']."\">
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