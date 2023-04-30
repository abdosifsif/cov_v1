<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleRecherche.css') }}">
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
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
    <article class="body">
        <div class="container">
            <h1>Où voulez-vous aller ?</h1>
            <div class="search-bar">
                <form action="{{ route('recherche') }}" method="post" class="search-form">
                    @csrf

                    <div class="Départ">
                        <label>Départ</label>
                        <input class="query" type="text" placeholder="Départ" id="a" name="depart">
                    </div>

                    <div>
                        <label>Déstination</label>
                        <input class="query" type="text" placeholder="Déstination" id="b"
                            name="destination">
                    </div>


                    <div>
                        <label>Date</label>
                        <input type="date" placeholder="Ajouter la date" name="date" id="d">
                    </div>



                    <div>
                        <label>Personne</label>
                        <input type="number" placeholder="Personne" min="1" max="4" name="passagers">
                    </div>



                    <button type="submit"><img src="images/search-svgrepo-com (1).svg"></button>
                </form>
            </div>
    </article>
</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
<script>
    $('.query').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '/autocomplete-search',
                data: 'query=' + request.term,
                dataType: "json",
                type: "GET",
                success: function(data) {
                    response($.map(data, function(item) {
                        return item.ville;
                    }));
                }
            });
        },
        minLength: 1
    });
</script>

</html>
