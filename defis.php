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
    $defis = $administrerMembres->obtenirDefis($_SESSION['id_membre']);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Speaky ~ Accueil</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/style.css" type="text/css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="image/icone-speaky.svg" type="image/png">
        <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
        <script src="scripts/main.js"></script>
    </head>

    <body class="bg-no-repeat bg-cover bg-center h-screen w-screen font-comfortaa" style="background-image: url('image/background-inscription.svg');">
        <?php
        require 'header.php';
        ?>
        <main class="w-screen h-screen min-h-[400px] flex flex-col justify-start pt-7 items-center md:ml-[calc(100vw/3)] xl:ml-[400px] md:w-[calc(100vw/3*2)] xl:w-[calc(100vw-400px)] ">
            <h1 class="text-3xl">Défis</h1>
            <div class=" mx-8 pb-10 overflow-hidden grid border-2 bg-white border-gray-400 rounded-3xl shadow-[0_0_5px_1px_rgba(0,0,0,0.5)]">
                <ul class="slider-list m-5 gap-10">
                    <?php
                    if (!empty($defis)) { //normalement, $defis ne peut pas être vide 
                        foreach ($defis as $defi) {
                            if ($defi['id_langue'] == 1) {
                                $defi1Anglais = $defi['defi1'];
                                $defi2Anglais = $defi['defi2'];
                                $defi3Anglais = $defi['defi3'];
                                $niveauAnglais = $defi['niveau'];
                            } elseif ($defi['id_langue'] == 2) {
                                $defi1Espagnol = $defi['defi1'];
                                $defi2Espagnol = $defi['defi2'];
                                $defi3Espagnol = $defi['defi3'];
                                $niveauEspagnol = $defi['niveau'];
                            }
                        }
                    }
                    ?>
                    <li class="slider-list-item">
                        <p class="mb-7 text-xl text-center">Score en anglais</p>

                        <p class="mb-2 text-lg">Progression des exercices :</p>
                        <p class="w-full flex justify-between text-xs"><span>0%</span><span>100%</span></p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-teal-400 h-6 rounded-full" style="width: <?php echo $niveauAnglais; ?>%;"></div>
                        </div>
                        <p class="mb-2 text-lg">Défi 1 : </p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-teal-400 h-6 rounded-full" style="width:<?php echo $defi1Anglais ?>%"></div>
                        </div>
                        <p class="mb-2 text-lg">Défi 2 :</p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-teal-400 h-6 rounded-full" style="width:<?php echo $defi2Anglais ?>%"></div>
                        </div>
                        <p class="mb-2 text-lg">Défi 3 :</p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-teal-400 h-6 rounded-full" style="width:<?php echo $defi3Anglais ?>%"></div>
                        </div>
                    </li>
                    <li class="slider-list-item">
                        <p class=" mb-7 text-xl text-center">Score en Espagnol</p>
                        <p class="mb-2 text-lg">Progression des exercices :</p>
                        <p class="w-full flex justify-between text-xs"><span>0%</span><span>100%</span></p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-rose-400 h-6 rounded-full" style="width: <?php echo $niveauEspagnol; ?>%;"></div>
                        </div>

                        <p class="mb-2 text-lg">Défi 1 : </p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-rose-400  h-6 rounded-full" style="width:<?php echo $defi1Espagnol ?>%"></div>
                        </div>
                        <p class="mb-2 text-lg">Défi 2 :</p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-rose-400  h-6 rounded-full" style="width:<?php echo $defi2Espagnol ?>%"></div>
                        </div>
                        <p class="mb-2 text-lg">Défi 3 :</p>
                        <div class="w-full bg-gray-300 rounded-full h-6">
                            <div class="bg-rose-400  h-6 rounded-full" style="width:<?php echo $defi3Espagnol ?>%"></div>
                        </div>
                    </li>
                </ul>
                <div class="slider-dots">
                    <button class="slider-dot current" type="button" data-slide-to="0"></button>
                    <button class="slider-dot" type="button" data-slide-to="1" aria-label="1"></button>
                </div>
            </div>
        </main>


    </body>

    </html>
<?php

} else {
    header("Location: connexion.php");
}
