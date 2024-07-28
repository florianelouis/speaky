<?php
// connexion.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header("Content-Type: text/html; charset=utf-8");

require(__DIR__ . "/param.inc.php");
require(__DIR__ . "/src/Membres/Administrer.php");

$administrerMembres = new Membres\Administrer(MYHOST, MYDB, MYUSER, MYPASS);

if (isset($_SESSION['id_membre'])) {
  $langues = $administrerMembres->obtenirLangue();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title>TUTO PHP</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?faly=Comfortaa:wght@300..700&family=Rubik+Glitch&display=swap" rel="stylesheet">

</head>

<body class="min-h-screen bg-no-repeat bg-cover bg-center py-2 text-xl font-comfortaa overflow-y-hidden"  style="background-image: url('image/background-inscription.svg');">
	<?php
	require 'header.php';
	?>
	<main class="w-screen h-screen flex flex-col justify-center items-center md:ml-[calc(100vw/3)] xl:ml-[400px] md:w-[calc(100vw/3*2)] xl:w-[calc(100vw-400px)] ">
		<div class="flex flex-col justify-center items-center gap-6 backdrop-blur-md max-w-[300px] max-h-96 bg-transparent h-1/2 rounded-lg border-white shadow-[0_0_10px_1px_rgba(0,0,0,0.5)] p-5">
			<h1 class="text-teal-400 text-3xl py-2 text-center">Choix de la langue</h1>
			
			<?php
				foreach($langues as $langue){
					$idLangue = $langue["id_langue"];
					$nomLangue = $langue["nom_langue"];

					?><a href="choix-exercice.php?id_langue=<?php echo $idLangue?>" class="btn-langue text-white text-center"><?php echo $nomLangue ?></a><?php
				}
	
			?>




		</div>
	</main>
</body>
</html>
<?php
} else {
  header("Location: connexion.php");
}
?>