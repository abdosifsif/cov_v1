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
                    <select name="route_details" id="routeSelect">

                    </select><br>
                </div>
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
                <div class="select-box">
                    <select name="nbr_passager" id="">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                    </select><br>
                </div>
                <p>Fixez votre prix par place</p>
                <input type="text" placeholder="prix" name="prix">
                <div class="index-btn-wrapper">
                    <div class="index-btn" onclick="run(4, 3);">Précédant</div>
                    <div class="index-btn" onclick="run(4, 5);">Suivant</div>
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
            if (showTab == 2) {
                initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
                var targetElement = document.getElementById("myForm");
                targetElement.style.width = "624px";

                targetElement.style.height = "837px";
            }
            if (showTab != 2) {
                var targetElement = document.getElementById("myForm");

                targetElement.style.width = "550px";

                targetElement.style.height = "500px";
            }
        }
        var map;

        // Modify the initMap function to accept the start and end addresses as parameters:
        function initMap(start, end) {
            var geocoder = new google.maps.Geocoder();
            var directionsService = new google.maps.DirectionsService();
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: {
                    lat: -34.397,
                    lng: 150.644
                }
            });

            geocoder.geocode({
                address: start
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var startLatLng = results[0].geometry.location;
                    var startMarker = new google.maps.Marker({
                        position: startLatLng,
                        map: map,
                        title: 'Start'
                    });
                }
            });

            geocoder.geocode({
                address: end
            }, function(results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    var endLatLng = results[0].geometry.location;
                    var endMarker = new google.maps.Marker({
                        position: endLatLng,
                        map: map,
                        title: 'End'
                    });
                }
            });
            var request = {
                origin: start,
                destination: end,
                travelMode: 'DRIVING',
                provideRouteAlternatives: true
            };

            directionsService.route(request, function(result, status) {
                if (status == 'OK') {
                    var routes = result.routes;
                    var selectElement = document.getElementById('routeSelect');
                    var directionsRenderers = [];

                    var fastestRouteIndex = 0; // Initialize with the index of the first route
                    var fastestRouteDuration = result.routes[0].legs[0].duration.value;

                    // Determine the fastest route
                    for (var i = 1; i < result.routes.length; i++) {
                        var duration = result.routes[i].legs[0].duration.value;
                        if (duration < fastestRouteDuration) {
                            fastestRouteIndex = i;
                            fastestRouteDuration = duration;
                        }
                    }

                    // Populate the select element with route options in French
                    for (var i = 0; i < routes.length; i++) {
                        var option = document.createElement('option');
                        var route = result.routes[i];
                        var duration = route.legs[0].duration.text;
                        var distance = route.legs[0].distance.text;

                        // Create the option text in French
                        var optionText =
                            'Route ' + (i + 1) + ': Durée - ' + duration.replace('hours', 'heures').replace('mins',
                                'minutes') + ', Distance - ' + distance.replace('km', 'km');

                        option.value = optionText;
                        option.text = optionText;
                        selectElement.appendChild(option);

                        // Create a new DirectionsRenderer object for each route
                        var directionsRenderer = new google.maps.DirectionsRenderer({
                            map: map,
                            directions: result, // Set the DirectionsResult object
                            routeIndex: i,
                            suppressMarkers: true // Hide the default markers
                        });

                        // Set the polyline options for each route
                        directionsRenderer.setOptions({
                            polylineOptions: {
                                strokeColor: i === fastestRouteIndex ? 'blue' : 'gray',
                                strokeOpacity: i === fastestRouteIndex ? 1.0 : 0.5,
                                strokeWeight: i === fastestRouteIndex ? 6 : 4
                            }
                        });

                        directionsRenderers.push(directionsRenderer);
                    }

                    // Create a new marker for the start location
                    geocoder.geocode({
                        address: start
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            var startLatLng = results[0].geometry.location;
                            var startMarker = new google.maps.Marker({
                                position: startLatLng,
                                map: map,
                                title: 'Start'
                            });
                        }
                    });

                    // Create a new marker for the end location
                    geocoder.geocode({
                        address: end
                    }, function(results, status) {
                        if (status === google.maps.GeocoderStatus.OK) {
                            var endLatLng = results[0].geometry.location;
                            var endMarker = new google.maps.Marker({
                                position: endLatLng,
                                map: map,
                                title: 'End'
                            });
                        }
                    });

                    // Set the default selection to the fastest route
                    selectElement.value = 'Route ' + (fastestRouteIndex + 1);

                    // Update the polyline options for the default selection
                    directionsRenderers[fastestRouteIndex].setOptions({
                        polylineOptions: {
                            strokeColor: 'blue',
                            strokeOpacity: 1.0,
                            strokeWeight: 6
                        }
                    });

                    // Event listener for route selection
                    selectElement.addEventListener('change', function() {
                        var selectedIndex = selectElement.selectedIndex;

                        // Reset polyline options for all routes
                        for (var i = 0; i < directionsRenderers.length; i++) {
                            var directionsRenderer = directionsRenderers[i];
                            directionsRenderer.setOptions({
                                polylineOptions: {
                                    strokeColor: 'gray',
                                    strokeOpacity: 1,
                                    strokeWeight: 4
                                }
                            });
                            directionsRenderer.setMap(map); // Update the renderer on the map
                        }

                        // Set the polyline options for the selected route
                        directionsRenderers[selectedIndex].setOptions({
                            polylineOptions: {
                                strokeColor: 'blue',
                                strokeOpacity: 1.0,
                                strokeWeight: 6
                            }
                        });

                        directionsRenderers[selectedIndex].setMap(
                        map); // Update the selected renderer on the map
                    });
                    selectElement.value = 'Route ' + (fastestRouteIndex + 1);

                    // Mark the fastest route option as selected
                    var fastestOption = selectElement.querySelector('option[value="' + selectElement.value + '"]');
                    fastestOption.selected = true;
                }
            });

        }



        // Add an event listener to the "Next" button on the first tab to update the map with the entered addresses:
        $('#step-2').click(function() {
            initMap($('#Ladresse_de_Depart').val(), $('#Ladresse_de_Destination').val());
        });
    </script>
</body>

</html>
