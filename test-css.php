<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Speaky ~ Profil</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="image/icone-speaky.svg" type="image/png">
	<link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
	<script src="scripts/main.js"></script>
</head>
<?php
require 'header.php';
?>

<body class="min-h-screen bg-no-repeat bg-cover bg-center py-2 pt-5 text-white text-xl font-comfortaa overflow-y-hidden" style="background-image: url('image/background.svg');">
	<main class="relative h-screen w-full">
		<div class="absolute z-10 top-[calc(20vh-72px)] -translate-x-1/2 left-1/2 md:left-2/3 lg:left-[calc(100vw/3*2)] xl:left-[calc(100vw/2+200px)]">
			<img src="image/pdp.png" class="border-4 border-white rounded-full w-32 h-32 md:w-40 md:h-40 ">
		</div>
		<div class="main-phone-profil md:main-tab-profil">
			<form method="post" action="editionprofil.php" enctype="multipart/form-data" class="flex flex-col mt-20 md:mt-28 gap-4 sm:gap-7 sm:text-lg justify-center items-center">
				<div class="relative w-80 h-12">
					<input type="text" name="newpseudo" id="newpseudo" placeholder="" value="<?php echo $user['pseudo']; ?>" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer" />
					<label for="newpseudo" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Pseudo :</label>
				</div>
				<div class="relative w-80 h-12">
					<input type="email" name="newmail" id="newmail" placeholder="" value="<?php echo $user['mail']; ?>"class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer" />
					<label for="newmail" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Mail :</label>
				</div>
				<div class="relative w-80 h-12">
					<input type="password" name="newmdp1" id="newmdp1" placeholder=""class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer" />
					<label for="newmdp1" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Mot de passe :</label>
				</div>
				<div class="relative w-80 h-12">
					<input type="password" name="newmdp2" id="newmdp2" placeholder="" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer"/>
					<label for="newmdp2" class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm">Confirmation - mot de passe :</label>
				</div>
				<div class="">
					<input class="underline-effect" type="submit" name="formeditionprofil" value="Mettre à jour mon profil !" />
				</div>
				<a class="mb-28" href="profil.php">
                    <span class="underline-effect ">Annuler</span>
                </a>
				<?php if (isset($erreur)) { ?>
					<div class="row">
						<div class="colspan-2 error"><?php echo ($erreur); ?></div>
					</div>
				<?php } ?>
			</form>
		</div>
	</main>
</body>

</html>