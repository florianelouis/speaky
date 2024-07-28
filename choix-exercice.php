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
  if (isset($_GET["id_langue"])) {
    $_SESSION["id_langue"] = $_GET["id_langue"];
    $id_langue = $_GET['id_langue'];
    $exercices = $administrerMembres->obtenirExercice($id_langue);
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
      <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&family=Rubik+Glitch&display=swap" rel="stylesheet">

    </head>

    <body class="min-h-screen bg-no-repeat bg-cover bg-center py-2 text-xl font-comfortaa"  style="background-image: url('image/background-inscription.svg');">
	<?php
	require 'header.php';
	?>
<main class="flex flex-col justify-start items-center md:ml-[calc(100vw/3)] xl:ml-[400px] md:w-[calc(100vw/3*2)] xl:w-[calc(100vw-400px)]">
  <h1 class="text-teal-400 text-3xl py-10">Choisis ton exercice</h1>
    <ul class="flex flex-col justify-items-center items-center text-sm sm:text-lg gap-5 mb-24">
       <?php
        foreach ($exercices as $exercice) {
          $idExercice = $exercice['id_exercice'];
          $titreExercice = $exercice['titre_exercice'];
        ?>
<li class="btn-exercice  my-2">
  <a class="w-full h-full flex items-center justify-center text-center" href="quiz.php?id_exercice=<?php echo $idExercice ?>">
    <?php echo $titreExercice ?>
  </a>
</li>
          
        <?php
        }
        ?>
</ul>
       
        <?php
        if (isset($erreur)) {
        ?>
          <p class="text-red-500 mt-4"><?php echo ($erreur); ?></p> <?php
                                                                  }
                                                                    ?>
      </main>
    </body>

    </html>
<?php
  }
} else {
  header("Location: connexion.php");
}
?>