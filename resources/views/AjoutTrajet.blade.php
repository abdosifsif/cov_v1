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
                    <div class="index-btn" onclick="run(1, 2);">Next</div>
                </div>
            </div>
            <div class="tab" id="tab-2">
                
                <div><div id="map"></div></div>
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(2, 1);">Previous</div>
                    <div class="index-btn" onclick="run(2, 3);">Next</div>
                </div>
            </div>

            <div class="tab" id="tab-3">
                <p>Quand partez-vous ?:</p>
                <input type="date" placeholder="dd" name="departure_date">

                <p>À quelle heure souhaitez-vous retrouver vos passagers?</p>
                <input type="text" placeholder="Heure" name="Heure">
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(3, 2);">Previous</div>
                    <div class="index-btn" onclick="run(3, 4);">Next</div>
                </div>
            </div>

            <div class="tab" id="tab-4">
                <p>Combien de passagers pouvez-vous accepter ?</p>
                <select name="nbr_passager" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br>
                <label for="">Fixez votre prix par place</label>
                <input type="text" placeholder="prix" name="prix">
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(4, 3);">Previous</div>
                    <div class="index-btn" onclick="run(4, 5);">Next</div>
                </div>
            </div>

            <div class="tab" id="tab-5">
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(5, 4);">Previous</div>
                    <button class="index-btn" type="submit" name="submit" style="background:#184646;">Ajouter
                        trajet</button>
                </div>
            </div>
        </form>
    </article>

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
        return item.ville; // map to array of labels
        }));
        }
        });
        },
        minLength: 1
        });
        
            // Default tab
            $(".tab").css("display", "none");
            $("#tab-1").css("display", "block");
        
            function run(hideTab, showTab) {
                if (hideTab < showTab) { // If not press previous button
                    // Validation if press next button
                    var currentTab = 0;
                    x = $('#tab-' + hideTab);
                    y = $(x).find("input")
                    for (i = 0; i < y.length; i++) {
                        if (y[i].value == "") {
                            $(y[i]).css("background", "#ffdddd");
                            return false;
                        }
                    }
                }
        
                // Progress bar
                for (i = 1; i < showTab; i++) {
                    $("#step-" + i).css("opacity", "1");
                }
        
                // Switch tab
                $("#tab-" + hideTab).css("display", "none");
                $("#tab-" + showTab).css("display", "block");
                $("input").css("background", "#fff");
        
                // If on the map tab, initialize the map
                if (showTab == 2) {
                    initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
                }
            }
        
            // Modify the initMap function to accept the start and end addresses as parameters:
            function initMap(start, end) {
                var directionsService = new google.maps.DirectionsService();
                var directionsRenderer = new google.maps.DirectionsRenderer();
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 8,
                    center: {
                        lat: -34.397,
                        lng: 150.644
                    }
                });
                directionsRenderer.setMap(map);
        
                var request = {
                    origin: start,
                    destination: end,
                    travelMode: 'DRIVING'
                };
        
                directionsService.route(request, function(result, status) {
                    if (status == 'OK') {
                        directionsRenderer.setDirections(result);
                    }
                });
            }
        
            window.addEventListener('load', function() {
                // Initialize the map with default values
                initMap('Paris', 'Marseille');
            });
        
            // Add an event listener to the "Next" button on the first tab to update the map with the entered addresses:
            $('#step-1').click(function() {
                initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
            });
        </script>
</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>

</html>
