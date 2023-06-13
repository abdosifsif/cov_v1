<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleResult.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        crossorigin="anonymous" />

</head>

<body onclick="hidMenu()">
    <header class="main-head">
        <nav>
            <h2 id="logo">Covoiturage</h2>
            <ul class="hover_cont">
                <li><a href="/dashboard"><strong>Accueil</strong></a></li>
                <li><a href="/ajouter-trajet"><strong>Ajouter Trajet</strong></a></li>
                <li><a href="/recherche"><strong>Recherche</strong></a></li>
                <li>
                    <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" class="user-pic"
                        onclick="showMenu()">
                    <div class="sub-menu-wrap" id="subMenu">
                        <div class="sub-menu">
                            <a href="/profile" class="sub-menu-links">
                                <i class="fas fa-user"></i>
                                <div>
                                    <p id="pp">Profile</p>
                                </div>
                            </a>
                            <hr>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a href="#" class="sub-menu-links"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    <i class="fas fa-lock"></i>
                                    <p>Déconnexion</p>
                                </a>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <div class="frst">
        <section class="container">
            <div class="search-bar">
                <form action="{{ route('recherche') }}" method="post" class="search-form">
                    @csrf

                    <div class="depart-input">
                        <label>Départ</label>
                        <input class="query" type="text" placeholder="Votre départ" name="depart"
                            value="{{ $data['depart'] }}">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="destination-input">
                        <label>Destination</label>
                        <input class="query" type="text" placeholder="Votre destination" name="destination"
                            value="{{ $data['destination'] }}">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="date-input">
                        <label>Date</label>
                        <input id="date-input" class="tst" type="date" placeholder="La date" name="date"
                            value="{{ $data['date'] }}">
                    </div>
                    <span class="vertical-line"></span>
                    <div class="nbr-input">
                        <label>Passagers</label>
                        <input type="number" min="1" max="4" placeholder="Passagers" name="passagers"
                            value="{{ $data['passagers'] }}">
                    </div>
                    <div>
                        <button type="submit">Chercher</button>
                    </div>
            </div>
            </form>



            @foreach ($trajets as $trajet)
                <section id="trajets">
                    <div class="personnels">
                        <div>
                            <h3><strong>{{ $trajet->user->prenom }}&nbsp;{{ $trajet->user->nom }}</strong></h1>
                        </div>
                        <img src="storage/{{ $trajet->user->picture }}" alt="carpool image">
                        <div class="preference">
                            <i class="fas fa-music fa-lg {{ $trajet->user->preferences->music == 1 ? 'green' : '' }}"></i>
                            <i class="fas fa-paw fa-lg {{ $trajet->user->preferences->animal == 1 ? 'green' : '' }}"></i>
                            <i class="fas fa-smoking fa-lg {{ $trajet->user->preferences->fumeur == 1 ? 'green' : '' }}"></i>
                            <i class="fas fa-comment fa-lg {{ $trajet->user->preferences->discussion == 1 ? 'green' : '' }}"></i>
                        </div>
                        
                    </div>
                    <span class="line"></span>
                    <div class="container-trajet">
                        <div class="infodh">
                            <h5>{{ $trajet->departure_date }}&nbsp;<i class="fas fa-calendar-alt"></i></h5>
                            <h5>&nbsp;A&nbsp;</h5>
                            <h5>{{ $trajet->Heure }}&nbsp;<i class="far fa-clock"></i></h5>
                        </div><br>
                        <div class="infdepdes">
                            <p><strong><i class="fas fa-city"></i>&nbsp;{{ $trajet->{"L'adresse_de_Départ"} }}</strong></p>
                            <span class="arrow"></span>
                            <p>{{ $trajet->{"time"} }}</p>
                            <span class="arrow"></span>
                            <p><strong><i class="fas fa-city"></i>&nbsp;{{ $trajet->{"L'adresse_de_Destination"} }}</strong></p>
                        </div><br>
                        <div class="autre">
                            <div class="passaget">
                                <p><strong>{{ $trajet->nbr_passager }}&nbsp;<i class="fas fa-users"></i></strong></p>
                            </div>
                            
                            <div class="passaget">
                                <p><strong>{{ $trajet->user->voiture?->marque }}&nbsp;<i class="fas fa-car-alt"></i></strong></p>
                            </div>
                            <div class="passaget">
                                <p><strong>{{ $trajet->user->voiture?->modele }}&nbsp;<i class="fas fa-car-side"></i></strong></p>
                            </div>
                        </div>
                        
                    </div>
                    <span class="line"></span>
                    <div class="prix-container">
                        <div class="prix">
                            <p><strong>{{ $trajet->prix }}Dhs</strong></p>
                        </div>
                        <button id="card-btn">Sélectionner</button>
                    </div>
                </section>
            @endforeach
            <section class="trajets">
                @if (count($trajets) == 0)
                    <section class="trajets-error">
                        <div class="no-trajets-message">
                            <h4 id="dynamic-date">
                                @if ($selectedDate && \Carbon\Carbon::parse($selectedDate)->isTomorrow())
                                    Il n'y a pas encore de trajets pour demain entre ces villes.
                                @else
                                    Il n'y a pas encore de trajets pour
                                    <span id="date-placeholder">{{ $selectedDate ?? '' }}</span> entre ces villes.
                                @endif
                            </h4>
                            <div id="btn-div">
                                <button id="btn" onclick="redirectToURL('/ajouter-trajet')">Publier un
                                    trajet</button>
                            </div>
                        </div>
                    </section>
                @endif
            </section>



        </section>
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

    function redirectToURL(url) {
        window.location.href = url;
    }
</script>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>

</html>
