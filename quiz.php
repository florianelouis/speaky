<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
header("Content-Type: text/html; charset=utf-8");

require(__DIR__ . "/param.inc.php");
require(__DIR__ . "/src/Membres/Administrer.php");

$administrerMembres = new Membres\Administrer(MYHOST, MYDB, MYUSER, MYPASS);

if (isset($_SESSION['id_membre'])) {
    $id_membre = $_SESSION['id_membre'];
    if (isset($_GET["id_exercice"])) {
        $_SESSION["id_exercice"] = $_GET["id_exercice"];
        $_SESSION["current_question_index"] = 0;
        $id_exercice = $_GET['id_exercice'];
        $_SESSION["questions"] = $administrerMembres->obtenirQuestions($_GET["id_exercice"]);
        $_SESSION["reponses_utilisateur"] = [];
    }

    if (!isset($_SESSION["questions"])) {
        header("Location: connexion.php");
        exit();
    }

    $questions = $_SESSION["questions"];
    $current_question_index = $_SESSION["current_question_index"];
    $current_question = $questions[$current_question_index];
    $reponses = $administrerMembres->obtenirReponses($current_question['id_question']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $reponse_choisie = $_POST['question_' . $current_question['id_question']] ?? null;
        if ($reponse_choisie !== null) {
            $_SESSION["reponses_utilisateur"][$current_question['id_question']] = $reponse_choisie;
            if ($administrerMembres->verifierReponseCorrecte($current_question['id_question'], $reponse_choisie)) {
                $reponse_correcte = true;
            } else {
                $reponse_correcte = false;
            }
        }
    }

    if (isset($_POST['next_question'])) {
        if ($_SESSION["current_question_index"] >= count($questions)) {
            // Calculer le score final
            $score = 0;
            foreach ($_SESSION["reponses_utilisateur"] as $question_id => $reponse_id) {
                if ($administrerMembres->verifierReponseCorrecte($question_id, $reponse_id)) {
                    $score++;
                }
            }
            
            if ($score >= 4) {
                $administrerMembres->incrementerNiveau($id_membre, $_SESSION['id_langue']);
            }
            
            $total_questions = count($questions);
            $message_final = "Vous avez terminé l'exercice. Votre score est de $score sur $total_questions.";

            $id_langue = $_SESSION["id_langue"] ?? null;
            $lien_retour = "choix.php";

             echo "<!DOCTYPE html>
            <html lang='fr'>
            <head>
                <title>Résultats du Quiz</title>
                <meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
                <link rel='stylesheet' href='styles.css' type='text/css'>
                <link rel='stylesheet' href='moodle.css' type='text/css'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            </head>
            <body>
                <main>
                    <h1>Résultats du Quiz</h1>
                    <h2>$message_final</h2>";

            echo "<h3>Questions et bonnes réponses :</h3>";
            foreach ($questions as $question) {
                $reponses = $administrerMembres->obtenirReponses($question['id_question']);
                echo "<p><strong>{$question['question']}</strong></p>";
                echo "<ul>";
                foreach ($reponses as $reponse) {
                    if ($reponse['bonne_reponse'] == 1) {
                        echo "<li>{$reponse['texte']}</li>";
                    }
                }
                echo "</ul>";
            }

            echo "<a href='$lien_retour'>Retour à l'accueil</a>
                </main>
            </body>
            </html>";
            exit();
        }

        $current_question_index = $_SESSION["current_question_index"];
        $current_question = $questions[$current_question_index];
        $reponses = $administrerMembres->obtenirReponses($current_question['id_question']);
    }
?>
    <!DOCTYPE html>
    <html lang="fr">

    <head>
        <title>Quiz ~ Speaky</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="stylesheet" href="css/style.css" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>



    <body class="min-h-screen bg-no-repeat bg-cover bg-center py-2 text-xl font-comfortaa" style="background-image: url('image/background-inscription.svg');">
        <?php
        require 'header.php';
        ?>
        <main class="min-h-screen flex flex-col justify-start items-center my-auto md:ml-[calc(100vw/3)] xl:ml-[400px] md:w-[calc(100vw/3*2)] xl:w-[calc(100vw-400px)]">
            <form class="flex flex-col justify-center items-center w-10/12 gap-6 mb-32 backdrop-blur-md bg-transparent rounded-lg border-white shadow-[0_0_10px_1px_rgba(0,0,0,0.5)] p-5" action="quiz.php" method="post">
                <div class="question w-full flex flex-col justify-center items-center">
                    <h2 class="my-2"><?php echo $current_question['question']; ?></h2>
                    <?php
                    if ($current_question['image'] != null) {
                        echo "<img class=' w-32' src='" . $current_question['image'] . "' alt='" . $current_question['question'] . "' />";
                    }
                    if ($current_question['audio'] != null) {
                    ?>
                        <iframe title="deezer-widget" src="<?php echo $current_question['audio'] ?>" width="272px" height="272px" frameborder="0" allowtransparency="true" allow="encrypted-media; clipboard-write"></iframe>
                    <?php

                    } ?>
                    <div class="reponse flex flex-col justify-start"><?php
                                                            foreach ($reponses as $reponse) { ?>

                            <label>
                                <input type="radio" name="question_<?php echo $current_question['id_question']; ?>" value="<?php echo $reponse['id_reponse']; ?>">
                                <?php echo $reponse['texte']; ?>
                            </label>

                        <?php } ?>
                    </div>
                </div>
                <input type="hidden" name="current_question_id" value="<?php echo $current_question['id_question']; ?>">
                <hr>
                <?php if (isset($reponse_correcte)) { ?>
                    <div class="texte-reponse w-full h-full flex flex-col justify-between items-center">
                        <?php $_SESSION["current_question_index"]++;
                        if ($reponse_correcte) {
                        ?>

                            <p class="text-green-500 mb-5">Réponse : Vraie</p>
                            <ul class="boutons-apres-reponses boutons-apres-reponses w-full flex justify-around items-center gap-5">
                                <li class="w-full h-14 flex justify-center items-center bg-rose-300 rounded-full border-b-4 border-rose-400 cursor-pointer duration-200 hover:border-transparent hover:translate-y-1">
                                    <a href="choix.php"><img src="./images/icones/home.svg" alt="">Home</a>
                                </li>
                                <li class="w-full h-14 flex justify-center items-center bg-rose-300 rounded-full border-b-4 border-rose-400 cursor-pointer duration-200 hover:border-transparent hover:translate-y-1">
                                    <button type="submit" name="next_question">Suivant</button>
                                </li>
                            </ul>
                        <?php } else { ?>
                            <p class=" text-red-500 mb-5">Réponse : Fausse</p>
                            <ul class="boutons-apres-reponses boutons-apres-reponses w-full flex justify-around items-center gap-5 ">
                                <li class="w-full flex h-14 justify-center items-center bg-rose-300 rounded-full border-b-4 border-rose-400 cursor-pointer duration-200 hover:border-transparent hover:translate-y-1">
                                    <a href="choix.php"><img src="./images/icones/home.svg" alt="">Home</a>
                                </li>
                                <li class="w-full h-14 flex justify-center items-center bg-rose-300 rounded-full border-b-4 border-rose-400 cursor-pointer duration-200 hover:border-transparent hover:translate-y-1">
                                    <button type="submit" name="next_question">Suivant</button>
                                </li>
                            </ul>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <button class="w-1/2 h-14 flex justify-center items-center bg-rose-300 rounded-full border-b-4 border-rose-400 cursor-pointer duration-200 hover:border-transparent hover:translate-y-1" type="submit" name="next_question">Suivant</button>
                <?php } ?>
            </form>
        </main>
    </body>

    </html>
<?php
} else {
    header("Location: connexion.php");
}
?>