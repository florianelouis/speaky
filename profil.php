<?php
// profil.php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
header("Content-Type: text/html; charset=utf-8");

require(__DIR__ . "/param.inc.php");
require(__DIR__ . "/src/Membres/Administrer.php");

$administrerMembres = new Membres\Administrer(MYHOST, MYDB, MYUSER, MYPASS);

if (isset($_SESSION['id_membre']) && $_SESSION['id_membre'] > 0) {

    $user = $administrerMembres->obtenirMembre($_SESSION['id_membre']);

    $defis = $administrerMembres->obtenirDefis($_SESSION['id_membre']);
    if (!empty($defis)) {
        foreach ($defis as $defi) {
            if ($defi['id_langue'] == 1) {
                $niveauAnglais = $defi['niveau'];
            } elseif ($defi['id_langue'] == 2) {
                $niveauEspagnol = $defi['niveau'];
            }
        }
    }
?>

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


    <body class="min-h-screen bg-no-repeat bg-cover bg-center py-2 pt-5 text-white text-xl font-comfortaa overflow-y-hidden" style="background-image: url('image/background.svg');">
    <?php
    require 'header.php';
    ?>
        <main class="relative h-screen w-full">
        <div class="absolute z-10 top-[calc(20vh-72px)] -translate-x-1/2 left-1/2 md:left-2/3 lg:left-[calc(100vw/3*2)] xl:left-[calc(100vw/2+200px)]">
    <img src="data:image/jpeg;base64,<?php echo base64_encode($user['photo']); ?>" alt="Photo de profil" class="border-4 border-white rounded-full w-32 h-32 md:w-40 md:h-40" />
</div>
            <div class="main-phone-profil md:main-tab-profil bg-no-repeat bg-cover bg-center" style="background-image: url('image/background-inscription.svg');">
                <div class="mt-28 flex flex-col justify-center items-center text-center text-2xl gap-5">
                    <h1 class="h-16">Profil</h1>
                    <p class=""><?php echo isset($_SESSION['pseudo']) ? $_SESSION['pseudo'] : 'Pseudo non disponible'; ?></p>
                    <p class=""><?php echo ($_SESSION['mail']) ? $_SESSION['mail'] : 'Mail non disponible';; ?></p>
                    <div class="h-[150px] max-w-[346px] mx-9 overflow-hidden grid border-2 bg-white border-gray-400 rounded-3xl shadow-[0_0_5px_1px_rgba(0,0,0,0.5)]">
                        <ul class="slider-list m-5">
                            <li class="slider-list-item">
                                <p class="mb-2 text-lg">Progression en Anglais</p>
                                <div class="w-full bg-gray-300 rounded-full h-6">
                                    <div class="bg-rose-400 h-6 rounded-full" style="width: <?php echo $niveauAnglais; ?>%;"></div>
                                </div>
                            </li>
                            <li class="slider-list-item">
                                <p class="mb-2 text-lg">Progression en Espagnol</p>
                                <div class="w-full bg-gray-300 rounded-full h-6">
                                    <div class="bg-green-400 h-6 rounded-full" style="width: <?php echo $niveauEspagnol; ?>%;"></div>
                                </div>
                            </li>
                        </ul>
                        <div class="slider-dots">
                            <button class="slider-dot current" type="button" data-slide-to="0"></button>
                            <button class="slider-dot" type="button" data-slide-to="1" aria-label="1"></button>
                        </div>
                    </div>
                    <a class="btn max-w-[346px] mx-9 mt-5 text-lg" href="editionprofil.php">Editer mon profil</a>
                    <a class="heading-text mb-28" href="deconnexion.php">
                        <span class="underline-effect"> Déconnexion</span>
                    </a>
                </div>
            </div>
        </main>
    </body>

    </html>
<?php
} else {
    header("Location: connexion.php");
}
?>