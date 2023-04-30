
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;600&display=swap&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<body onclick="hidMenu()">
    <header>
        
        <div>
            <nav>
                <a href="/" class="logo"> Covoiturage</a>
                <ul class="principale">
                    <li><a href="/recherche">
                            <div class="link-wrap">
                              <img src="images/search-svgrepo-com (1).svg">
                                <div>
                                    <p> Recherche</p>
                                </div>
                            </div>
                        </a></li>
                    <li><a href="/ajouter-trajet">
                            <div class="link-wrap">
                                <img src="images/add-circle-svgrepo-com.svg">
                                <div>
                                    <p> Publier un trajet</p>
                                </div>
                            </div>
                        </a></l>
                </ul>
                <img src="images/person-circle-fill-svgrepo-com.svg" class="user-pic" onclick="showMenu()">

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <a href="/login" class="sub-menu-links">
                            <p>connexion</p>
                            <span>></span>
                        </a>
                        <hr>
                        <a href="/register" class="sub-menu-links">
                            <p>inscription</p>
                            <span>></span>
                        </a>
                    </div>
                </div>
            </nav>
        </div>
       
    </header>
    <article>
        <div class="containerr">

            <div class="pre">
                <a href="Recherche.html"><img src="images/carrousel-3col_3aides-3.jpg" alt=""></a>
                <h4 class="first">Un vaste choix de trajets à petits prix,</h4><p><br>
                    alors profitez bien et réservez votre destination. </p>
            </div>
            <div class="deux">
                <img src="images/distance.avif" alt="">
                <p>Réserver un trajet devient plus simple! <br>
                    Facile d'utilisation , notre application permet de réserver un
                    trajet à proximité en un rien de temps.</p>
            </div>
            <div class="trois">
                <img src="images/covoiturage3.avif" alt="">
                <p>Voyagez en toute confiance ;<br>
                    Nous prenons le temps qu’il faut pour connaître nos membres
                    et nos compagnies de bus partenaires. Nous vérifions les avis,
                    les profils et les pièces d’identité. Vous savez donc avec qui
                    vous allez voyager pour réserver en toute confiance sur notre
                    plateforme sécurisée.
                </p>

            </div>
        </div>
    </article>
    <div class="milieu">
        <div class="container2">
            <h1>Votre déstination</h1>
            <div class="searchbar">
                <form action="">
                    <div class="Départ">
                        <label>Départ</label>
                        <input type="text" placeholder="Départ">
                    </div>
                    <div>
                        <label>Déstination</label>
                        <input type="text" placeholder="Déstination">
                    </div>
                    <div>
                        <label>Date</label>
                        <input type="date" placeholder="Ajouter la date">
                    </div>
                    <div>
                        <label>Personne</label>
                        <input type="number" placeholder="Personne" min="1" max="4">
                    </div>
                    <button type="submit"><img src="images/search-svgrepo-com (1).svg"></button>
                </form>

            </div>

        </div>

    </div>
    <footer class="footer">
        <div>

        </div>




    </footer>
    <script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</body>

</html>