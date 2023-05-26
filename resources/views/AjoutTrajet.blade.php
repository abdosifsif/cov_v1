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
            <div class="tab" id = "tab-2">
                <p>Plus de détails:</p>
                <div id="map" style="height: 400px;"></div>
                <input type = "text" placeholder="Quelle est votre route ?" name="route_details">
                <div class="index-btn-wrapper">
                  <div class="index-btn" onclick="run(2, 1);">Précédant</div>
                  <div class="index-btn" onclick="run(2, 3);">Suivant</div>
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

      function run(hideTab, showTab){
        if(hideTab < showTab){ // If not press previous button
          // Validation if press next button
          var currentTab = 0;
          x = $('#tab-'+hideTab);
          y = $(x).find("input")
          for (i = 0; i < y.length; i++){
            if (y[i].value == ""){
              $(y[i]).css("background", "#ffdddd");
              return false;
            }
          }
        }

        // Progress bar
        for (i = 1; i < showTab; i++){
          $("#step-"+i).css("opacity", "1");
        }

        // Switch tab
        $("#tab-"+hideTab).css("display", "none");
        $("#tab-"+showTab).css("display", "block");
        $("input").css("background", "#fff");
        if (showTab == 2) {
                    initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
                }
      }
      var map;

// Modify the initMap function to accept the start and end addresses as parameters:
function initMap(start, end) {
    var geocoder = new google.maps.Geocoder();
    var directionsService = new google.maps.DirectionsService();
    var directionsRenderer = new google.maps.DirectionsRenderer();
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: {
            lat: -34.397,
            lng: 150.644
        }
    });
    console.log(start);
    console.log(end);

    geocoder.geocode({ address: start }, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      var startLatLng = results[0].geometry.location;
      var startMarker = new google.maps.Marker({
        position: startLatLng,
        map: map,
        title: 'Start'
      });
    }});
    geocoder.geocode({ address: end }, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      var startLatLng = results[0].geometry.location;
      var startMarker = new google.maps.Marker({
        position: startLatLng,
        map: map,
        title: 'end'
      });
    }});




    var request = {
        origin: start,
        destination: end,
        travelMode: 'DRIVING',
        provideRouteAlternatives: true
    };

    directionsService.route(request, function(result, status) {
        if (status == 'OK') {
            var fastestRouteIndex = 0;
            var fastestRouteDuration = result.routes[0].legs[0].duration.value;

            // Determine the fastest route
            for (var i = 1; i < result.routes.length; i++) {
                var duration = result.routes[i].legs[0].duration.value;
                if (duration < fastestRouteDuration) {
                    fastestRouteIndex = i;
                    fastestRouteDuration = duration;
                }
            }

            // Create a new DirectionsRenderer object for each route
            for (var i = 0; i < result.routes.length; i++) {
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                    directions: result,
                    routeIndex: i,
                    suppressMarkers: true // Hide the default markers
                });

                // Set the polyline options for each route
                if (i == fastestRouteIndex) {
                    // Set the polyline options for the fastest route
                    directionsRenderer.setOptions({
                        polylineOptions: {
                            strokeColor: 'blue',
                            strokeOpacity: 1.0,
                            strokeWeight: 6
                        }
                    });
                } else {
                    // Set the polyline options for the other routes
                    directionsRenderer.setoptions({
                        polylineOptions: {
                            strokeColor: 'gray',
                            strokeOpacity: 0.5,
                            strokeWeight: 4
                        }
                    });
                }
            }
        }
    });
}



// Add an event listener to the "Next" button on the first tab to update the map with the entered addresses:
$('#step-2').click(function() {
    initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
});
            
var suivantButton = document.querySelector(".index-btn");
suivantButton.addEventListener("click", function() {
  var targetElement = document.getElementById("myForm");

  targetElement.style.width = "624px";

  targetElement.style.height = "837px";
});



        </script>
</body>
</html>
