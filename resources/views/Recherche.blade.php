<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleRecherche.css') }}">
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
</head>

<body onclick="hidMenu()">
    <header class="main-head">
        <nav>
            <h2 id="logo">Covoiturage</h2>
            <ul class="hover_cont">
                <li><a href="/ajouter-trajet"><strong>Ajouter Trajet</strong></a></li>
                <li><a href="/recherche"><strong>Recherche</strong></a></li>
                <li>
                    <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" class="user-pic"
                        onclick="showMenu()">
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="/profile" class="sub-menu-links">
                                <p>Profile</p>

                            </a>
                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" class="sub-menu-links"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <p>Déconnexion</p>
                                </a>
                            </form>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    {{-- <article class="body">
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
    </article> --}}


    <div class="frst">
        <section class="container">
            <h1>Trouvez votre destination</h1>
            <div class="search-bar">
                <form action="{{ route('recherche') }}" method="post" class="search-form">
                    @csrf

                    <div class="depart-input">
                        <label>Départ</label>
                        <input class="query" type="text" placeholder="Votre départ" name="depart">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="destination-input">
                        <label>Destination</label>
                        <input class="query" type="text" placeholder="Votre destination" name="destination">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="date-input">
                        <label>Date</label>
                        <input class="tst" type="date" placeholder="La date" name="date">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="nbr-input">
                        <label>Passagers</label>
                        <input type="number" min="1" max="4" placeholder="Passagers" name="passagers">
                    </div>
                    <div>
                        <button type="submit">Chercher</button>
                    </div>
            </div>
            </form>

        </section>
    </div>








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
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</body>
</html>
