<?php
// inscription.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");

require(__DIR__ . "/param.inc.php");

require(__DIR__ . "/src/Membres/Administrer.php");

$administrerMembres = new Membres\Administrer(MYHOST, MYDB, MYUSER, MYPASS);

if (isset($_POST['forminscription'])) {
    if (
        !empty($_POST['pseudo'])
        and !empty($_POST['mail'])
        and !empty($_POST['mail2'])
        and !empty($_POST['mdp'])
        and !empty($_POST['mdp2'])
    ) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);
        $mail2 = htmlspecialchars($_POST['mail2']);
        $mdp = $_POST['mdp'];
        $mdp2 = $_POST['mdp2'];

        if ($mail == $mail2) {
            if ($mdp == $mdp2) {
                if (mb_strlen($mdp) >= 4) {
                    try {
                        $administrerMembres->inscrire($pseudo, $mail, $mdp);
                    } catch (Exception $e) {
                        $erreur = $e->getMessage();
                    }
                } else {
                    $erreur = "Votre mot de passe doit posséder au moins 4 caractères !";
                }
            } else {
                $erreur = "Vos mots de passes ne correspondent pas !";
            }
        } else {
            $erreur = "Vos adresses mail ne correspondent pas !";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }

    $lenghtmdp = mb_strlen($mdp);
    if ($lenghtmdp < 3) {
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Speaky ~ Inscription</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="image/icone-speaky.svg" type="image/png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="flex justify-center items-center min-h-screen bg-no-repeat bg-cover bg-center font-comfortaa " style="background-image: url('image/background-inscription.svg');">
    <main class="grid  gap-10 w-full max-w-md sm:max-w-xl p-6 text-lg  ">
        <img src="image/logo-speaky.svg" class="mx-auto w-9/12">
        <h1 class="text-teal-400 text-3xl py-2 text-center">Inscription</h1>
        <form method="post" action="inscription.php" class="flex flex-col gap-4 sm:gap-7 justify-center items-center">
            <div class="relative w-80 h-12">
                <input autocomplete="off"   type="text" placeholder="" id="pseudo" name="pseudo" value="<?php if (isset($_POST['pseudo'])) {
                                                                                        echo htmlspecialchars($_POST['pseudo']);
                                                                                    } ?>" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
                <label class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm" for="pseudo">Pseudo</label>
            </div>

            <div class="relative w-80 h-12">
                <input autocomplete="off"  type="email" placeholder="" id="mail" name="mail" value="<?php if (isset($_POST['mail'])) {
                                                                                    echo htmlspecialchars($_POST['mail']);
                                                                                } ?>" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
                <label class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm" for="mail">Mail</label>
            </div>
            <div class="relative w-80 h-12">
                <input autocomplete="off"  type="email" placeholder="" id="mail2" name="mail2" value="<?php if (isset($_POST['mail2'])) {
                                                                                        echo htmlspecialchars($_POST['mail2']);
                                                                                    } ?>" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
                <label class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm" for="mail2">Confirmation du mail</label>
            </div>
            <div class="relative w-80 h-12">

                <input autocomplete="off"  type="password" placeholder="" id="mdp" name="mdp" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none  focus:border-orange-500 peer">
                <label class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm" for="mdp">Mot de passe</label>
            </div>
            <div class="relative w-80 h-12">

                <input autocomplete="off"  type="password" placeholder="" id="mdp2" name="mdp2" class="absolute top-0 left-0 w-full h-full border-2 px-3 border-teal-900 rounded bg-transparent hover:border-orange-500 focus:outline-none focus:border-orange-500 peer">
                <label class="absolute left-2 top-[-0.75rem] transition-all duration-200 bg-white px-1 peer-placeholder-shown:top-2 peer-placeholder-shown:left-3 peer-focus:top-[-0.75rem] peer-focus:left-2 peer-focus:text-sm" for="mdp2">Confirmation du mot de passe</label>
            </div>
            <div class="btn w-80">
                <input type="submit" name="forminscription" value="Je m'inscris">
            </div>
            <?php if (isset($_POST['forminscription'])) : ?>
                <?php if (isset($erreur)) : ?>
                    <div class="">
                        <p class="error text-red-500"><?php echo $erreur; ?></p>
                    </div>
                <?php else : ?>
                    <div class="">
                        <p class="text-green-500">Votre compte a bien été créé !</p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </form>
        <a href="connexion.php" class="text-teal-500 text-center ">Connexion</a>
    </main>
</body>

</html>