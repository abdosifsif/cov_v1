<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>s</title>
    <script src="{{ asset('scripts/jquery.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
    <script src="{{ asset('scripts/jquery-ui.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleAjout.css') }}">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAsfmS_4d2jJl_g4cs3T4A42f-DldHf7xQ&callback=initMap" async
        defer></script>
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
    <article>
        <form id="myForm" action="{{ route('trajet.store') }}" method="post" autocomplete="off">
            @csrf
            <h1 align=center>Ajouter un trajet </h1>

            <div style="text-align:center;">
                <span class="step" id="step-1">1</span>
                <span class="step" id="step-2">2</span>
                <span class="step" id="step-3">3</span>
                <span class="step" id="step-4">4</span>
            </div>

            <div class="tab" id="tab-1">
                <p>Votre trajet:</p>

                <input class="query" type="text" placeholder="L'adresse de Départ" name="L'adresse_de_Départ"
                    id="Ladresse_de_Depart">
                <input class="query" type="text" placeholder="L'adresse de Destination"
                    name="L'adresse_de_Destination" id="Ladresse_de_Destination">
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(1, 2);">Suivant</div>
                </div>
            </div>
            <div class="tab" id="tab-2">
                <p>Plus de détails:</p>
                <div id="map" style="height: 400px;"></div>
                <p>Quelle est votre route ?</p>
                <div class="select-box">
                    <select name="route_details" id="routeSelect" >

                    </select><br>
                </div>
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(2, 1);">Précédant</div>
                    <div class="index-btn" onclick="run(2, 3);calculatePrice()">Suivant</div>
                </div>
            </div>

            <div class="tab" id="tab-3">
                <p>Quand partez-vous ?:</p>
                <input type="date" placeholder="dd" name="departure_date" id="departure-date"
                    onchange="updateTimeLimit()">

                <p>À quelle heure souhaitez-vous retrouver vos passagers?</p>
                <input type="time" placeholder="Heure" name="Heure" id="departure-time">

                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(3, 2);">Précédant</div>
                    <div class="index-btn" onclick="run(3, 4);">Suivant</div>
                </div>
            </div>


            <div class="tab" id="tab-4">
                <p>Combien de passagers pouvez-vous accepter ?</p>
                <div class="select-box">
                  <select name="nbr_passager">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                  </select><br>
                </div>
                <p>Fixez votre prix par place</p>
                <input type="text" placeholder="Calculating..." id="prix" name="prix" class="your-class">
                <div class="index-btn-wrapper">
                  <div class="index-btn" onclick="run(4, 3);">Précédant</div>
                  <div class="index-btn" onclick="run(4, 5);">Suivant</div>
                </div>
              </div>

            <div class="tab" id="tab-5">
                <h3>Tu es presque là !</h3>
                <br>
                <div class="g-recaptcha" data-sitekey="6LfMmEkmAAAAADORis5FtZLeYuSni8JR_O45OoKq"></div>
                <div class="error-message" style="color: red; font-size: 14px;text-align: center;"></div>
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(5, 4);">Précédant</div>
                    <button class="index-btn" type="submit" name="submit" style="background:#184646;" onclick="return validateForm();">Ajouter trajet</button>
                </div>
            </div>
            


        </form>
    </article>
    <script defer type="text/javascript" src="{{ URL::asset('scripts/ajouttrajet.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    


</body>

</html>
