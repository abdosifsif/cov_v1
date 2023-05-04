
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <script defer type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>

    <title>Document</title>
</head>

<body>
    <header class="main-head">
        <nav>
            <h2 id="logo">Covoiturage</h2>
            <ul class="hover_cont">
                <li><a href="/login""><strong>Se Connecter</strong></a></li>
                <li><a href="/register"><strong> S'inscrire</strong></a></li>
            </ul>
        </nav>
    </header>
    <section class="hero">
        <h1>Covoiturage</h1>
        <h3>Réserver vos trajets à petits prix</h3>
        <button>Chercher Trajet</button>
    </section>
    <section class="description">
        <div class="mov hidden">
            <h1 class="titre">Réservez facilement</h1>
            <P> Réservez votre trajet en quelques clics avec notre application
            de covoiturage facile à utiliser.
            Grâce à notre technologie de pointe,
            vous pouvez trouver rapidement un trajet près de chez vous,
            sans tracas ni complications. Chez [nom de la plateforme de covoiturage],
            nous rendons le covoiturage simple et accessible à tous. <br><br></P>
        </div>
        <div class="mov hidden">
            <h1 class="titre">Vaste choix à petits prix</h1>
            <p>Voyagez à petit prix avec notre plateforme de covoiturage.
            Nous proposons une grande variété de destinations en bus ou
            en covoiturage, à des tarifs compétitifs. Chez [nom de la
            plateforme de covoiturage], nous sommes attachés à offrir
            des trajets abordables pour tous les budgets. Réservez dès
            maintenant et économisez sur vos déplacements.</p>
        </div>
        <div class="mov hidden">
            <h1 class="titre">Voyagez en toute confiance</h1>
            <p>
            Voyagez en toute confiance avec notre plateforme de
            covoiturage sécurisée. Nous vérifions les profils et
            les identités de tous nos membres et partenaires de
            covoiturage, pour que vous puissiez réserver votre
            trajet en toute sérénité. Chez [nom de la plateforme de covoiturage],
            nous sommes déterminés à offrir un service fiable et sécurisé pour
            tous vos déplacements en covoiturage.</p>
        </div>
    </section>
    <section class="description2">
        <img src="images/driver.jpg" alt="">   
        <div id="conduire">
            <h1>Où voulez-vous conduire ?</h1>
            <h4>Faisons de ce voyage le moins cher de tous les temps.</h4>
            <button><a id="route_add_link" href="/ajouter-trajet">Publier un trajet </a></button>
        </div> 
    </section>
    <footer>
        <h1>Savoir plus!</h1>
        <div class="ftr">
        <div class="information hidden">
            <h3> à propos de Nous</h3>
            <p>Majda et Abdellah deux étudiants qui ont décidé de créer leur application de covoiturage </p>
        </div>
        <div class="information hidden">
            <h3>notre contact</h3>
            <p>majdaelfadil4@gmail.com</p>
        </div>
        </div>
    </footer>

</body>

</html