<?php 
	require '../connectBDD.php';
	if (isset($_POST['president']) and $_POST['examin'] and $_POST['rapp_int'] and $_POST['rapp_ext']) {
		try {
			$president=$_POST['president'];
			$examinateur=$_POST['examin'];
			$rapport_int=$_POST['rapp_int'];
			$rapport_ext=$_POST['rapp_ext'];

			$select_president = $PDO->query("SELECT * FROM professeur WHERE id_prof='$president'");
			$select_president = $select_president->fetch(PDO::FETCH_ASSOC);

			$select_examinateur = $PDO->query("SELECT * FROM professeur WHERE id_prof='$examinateur'");
			$select_examinateur = $select_examinateur->fetch(PDO::FETCH_ASSOC);

			$select_rapport_int = $PDO->query("SELECT * FROM professeur WHERE id_prof='$rapport_int'");
			$select_rapport_int = $select_rapport_int->fetch(PDO::FETCH_ASSOC);

			$select_rapport_ext = $PDO->query("SELECT * FROM professeur WHERE id_prof='$rapport_ext'");
			$select_rapport_ext = $select_rapport_ext->fetch(PDO::FETCH_ASSOC);
		} catch (Exception $e) {
			
		}
		
	}


 ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AFFICHAGE AVANT IMPRESSION</title>
</head>
<body style="padding: 10px 20px;font-size: 18px;">
	<header style="text-align: center;">
		<h2>PROCES VERBAL <br> SOUTENANCE DE FIN D'ETUDES POUR L'OBTENTION DU DIPLOME DE LICENCE PROFESSIONNELLE</h2>
		<p><strong>Mention :</strong>Informatique</p>
		<p><strong>Parcours :</strong><?=$_POST['parcour']?></p>
	</header>
	<main>
		<p>Mr/Mlle <?=$_POST['nom'].' '.$_POST['prenom']?></p>
		<p>a soutenu publiquement son mémoire de fin d’études pour l’obtention du diplôme de Licence professionnelle.</p>
		<p>Après la délibération, la commission des membres du Jury a attribué la note de <strong><?=$_POST['note']?></strong>/20 (<?php switch ($_POST['note']) {
			case 0:
				echo "zéro";
				break;
			case 1:
				echo "un";
				break;
			case 2:
				echo "deux";
				break;
			case 3:
				echo "trois";
				break;
			case 4:
				echo "quatre";
				break;
			case 5:
				echo "cinq";
				break;
			case 6:
				echo "six";
				break;
			case 7:
				echo "sept";
				break;
			case 8:
				echo "huit";
				break;
			case 9:
				echo "neuf";
				break;
			case 10:
				echo "dix";
				break;
			case 11:
				echo "onze";
				break;
			case 12:
				echo "douze";
				break;
			case 13:
				echo "treize";
				break;
			case 14:
				echo "quatorze";
				break;
			case 15:
				echo "quinze";
				break;
			case 16:
				echo "Seize";
				break;

			case 17:
				echo "dix-sept";
				break;
			case 18:
				echo "dix-huit";
				break;
			case 19:
				echo "dix-neuf";
				break;
			case 20:
				echo "vingt";
				break;
			
			default:
				echo "zero";
				break;
		} ?> sur vingt)</p>
	</main>
	<footer>
		<h4 style="text-decoration: underline;">Membres du Jury</h4>
		<p><strong>Président :</strong><?=$select_president['civilite'].' '.$select_president['nom_prof'].' '.$select_president['prenom_prof'].','.$select_president['grade']  ?></p>

		<p><strong>Examinateur :</strong><?=$select_examinateur['civilite'].' '.$select_examinateur['nom_prof'].' '.$select_examinateur['prenom_prof'].','.$select_examinateur['grade']  ?></p>

		<p style="display: flex;flex-direction: row;"><strong>Rapporteurs :</strong>
		<ul style="list-style: none;">
			<li><?=$select_rapport_int['civilite'].' '.$select_rapport_int['nom_prof'].' '.$select_rapport_int['prenom_prof'].','.$select_rapport_int['grade'] ?></li>
			<li>
				<?=$select_rapport_ext['civilite'].' '.$select_rapport_ext['nom_prof'].' '.$select_rapport_ext['prenom_prof'].','.$select_rapport_ext['grade']    ?>
			</li>
		</ul>
		</p>
	</footer>
</body>
</html>