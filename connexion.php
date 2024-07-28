<?php
// connexion.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header("Content-Type: text/html; charset=utf-8");

require(__DIR__ . "/param.inc.php");

require(__DIR__ . "/src/Membres/Administrer.php");

$administrerMembres = new Membres\Administrer(MYHOST, MYDB, MYUSER, MYPASS);
if (isset($_POST['formconnexion'])) {
	try {
		$user = $administrerMembres->connecter($_POST['mailconnect'], $_POST['mdpconnect']);
		$_SESSION['id_membre'] = $user['id_membre'];
		$_SESSION['pseudo'] = $user['pseudo'];
		$_SESSION['mail'] = $user['mail'];
		header("Location: profil.php");
	} catch (Exception $e) {
		$erreur = $e->getMessage();
	}
}
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

<body class="flex justify-center items-center min-h-screen bg-no-repeat bg-cover bg-center font-comfortaa" style="background-image: url('image/background-inscription.svg');">
	<main class="grid grid-rows-custom gap-10 w-full max-w-md sm:max-w-xl p-6 text-lg ">
		<img src="image/logo-speaky.svg" class="mx-auto w-9/12">
		<h1 class="text-teal-400 text-3xl py-2 text-center">Connexion</h1>
		<form method="post" action="connexion.php" class="flex flex-col gap-4 sm:gap-7 justify-center items-center">

			<div class="relative w-80 h-12">
				<input autocomplete="off"  type="email" id="mailconnect" name="mailconnect" placeholder="Mail" aria-label="email" required class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
				<label for="mailconnect" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Email</label>
			</div>
			<div class="relative w-80 h-12">
				<input autocomplete="off" type="password" id="mdpconnect" name="mdpconnect" placeholder="Mot de passe" aria-label="mot de passe" required class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
				<label for="mdpconnect" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Mot de passe</label>
			</div>
			<div class="btn w-80">
				<input class="btn" type="submit" name="formconnexion" value="Se connecter"  />
			</div>


			<?php
			if (isset($erreur)) {
			?>
				<div class="row"></div>
				<p class="colspan-2 error"><?php echo ($erreur); ?></p>
				</div>
			<?php
			}
			?>
		</form>
		<a href="inscription.php" class="text-teal-500 text-center">Inscription</a>
	</main>
</body>

</html>