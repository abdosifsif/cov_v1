<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleResult.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleRecherche.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
                            <a href="Registre" class="sub-menu-links">
                                <p>Profil</p>
                                <span>></span>
                            </a>
                            <hr>
                            <a href="Registre" class="sub-menu-links">
                                <p>Messages</p>
                                <span>></span>
                            </a>

                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" class="sub-menu-links"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <p>Déconnexion</p>
                                    <span>></span>
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
            </div> --}}
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




    <div class="wrapper">
        @foreach ($trajets as $trajet)
            <div class="card">
                <div class="card-header">
                    <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" id="userpic"
                        alt="carpool image">
                </div>
                <div class="card-body">
                    <div class="title">
                        <h4 class="card-title">{{ $trajet->{"L'adresse_de_Départ"} }}</h4>
                        <div class="circles">
                            <div class="outer_circle">
                                <div class="circle"></div>
                            </div>
                            <div class="line"></div>
                            <div class="outer_circle">
                                <div class="circle"></div>
                            </div>
                        </div>
                        <h4 class="card-title"> {{ $trajet->{"L'adresse_de_Destination"} }}</h4>
                    </div>
                    <p class="card-text">{{ $trajet->departure_date }}</p>
                    <ul class="card-features">
                        <li><i class="fas fa-users"></i> {{ $trajet->nbr_passager }} </li>
                        <li><i class="fas fa-map-marker-alt"></i> Location</li>
                    </ul>
                    <div class="card-pricing">
                        <div class="card-price">
                            <span class="card-amount">{{ $trajet->prix }}</span>
                            <span class="card-currency">dh</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-primary">Book now</button>
                </div>
            </div>
        @endforeach
    </div>
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
