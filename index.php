<!DOCTYPE html>
<html lang="en">

<head>
    <title>Speaky ~ Accueil</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" type="text/css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="image/icone-speaky.svg" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="w-screen h-screen min-h-[415px] bg-orange-500 font-comfortaa">
    <main class="w-full h-full grid grid-cols-1 grid-rows-2 xl:grid-cols-2 xl:grid-rows-1 gap-0">
        <div class="bg-no-repeat bg-cover bg-center flex flex-col justify-center items-center  rounded-b-3xl xl:rounded-none xl:rounded-r-3xl  shadow-[0_0_5px_3px_rgba(0,0,0,0.5)]" style="background-image: url('image/background.svg');">
            <div class="w-4/5 h-4/5 xl:h-1/2 min-h-[310px] m-auto p-5 backdrop-blur-md backdrop-brightness-[0.7] rounded-2xl shadow-[0_0_5px_1px_rgba(0,0,0,0.2)]">
                <ul class="text-white h-full w-full flex flex-col justify-between">
                    <li>
                        <h1 class="flex flex-col w-max"><span class="md:text-xl">Bienvenue sur</span><span class="text-xl md:text-3xl">Speaky</span></h1>
                        <p class="w-1/5 h-[2px] rounded-full bg-orange-500 my-5"></p>
                        <p class="flex flex-col w-max my-1"><span class="text-xs md:text-xl">Apprenez une nouvelle langue,</span><span class="my-1 md:text-3xl ">Simplement et Efficacement !</span></p>
                        <p class="text-sm my-1 md:text-xl">Rejoingnez l'aventure</p>
                    </li>
                    <li> 
                        <ul class="flex justify-around  md:text-xl">
                            <li class=" hover:scale-125 duration-200"><a  href="inscription.php">Inscription</a></li>
                            <li class=" hover:scale-125 duration-200"><a class="" href="connexion.php">Connexion</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col justify-center items-center ">
            <img class="w-10/12 max-h-[700px]" src="image/speaky-presentation.svg" alt="Hello, moi c'est speaky ! Es-tu prêt à rejoindre l'aventure ?">
        </div>
    </main>
</body>

</html>
