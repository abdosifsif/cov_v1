$(".query").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "/autocomplete-search",
            data: "query=" + request.term,
            dataType: "json",
            type: "GET",
            success: function (data) {
                response(
                    $.map(data, function (item) {
                        return item.ville; // map to array of labels
                    })
                );
            },
        });
    },
    minLength: 1,
});

// Default tab
$(".tab").css("display", "none");
$("#tab-1").css("display", "block");

function run(hideTab, showTab) {
    if (hideTab < showTab) {
        // If not press previous button
        // Validation if press next button
        var currentTab = 0;
        x = $("#tab-" + hideTab);
        y = $(x).find("input");
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
        initMap(
            $("#Ladresse_de_Depart").val(),
            $("#Ladresse_de_Destination").val()
        );
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
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 8,
        center: {
            lat: -34.397,
            lng: 150.644,
        },
    });

    geocoder.geocode(
        {
            address: start,
        },
        function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                var startLatLng = results[0].geometry.location;
                var startMarker = new google.maps.Marker({
                    position: startLatLng,
                    map: map,
                    title: "Start",
                });
            }
        }
    );

    geocoder.geocode(
        {
            address: end,
        },
        function (results, status) {
            if (status === google.maps.GeocoderStatus.OK) {
                var endLatLng = results[0].geometry.location;
                var endMarker = new google.maps.Marker({
                    position: endLatLng,
                    map: map,
                    title: "End",
                });
            }
        }
    );
    var request = {
        origin: start,
        destination: end,
        travelMode: "DRIVING",
        provideRouteAlternatives: true,
    };

    directionsService.route(request, function (result, status) {
        if (status == "OK") {
            var routes = result.routes;
            var selectElement = document.getElementById("routeSelect");
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
                var option = document.createElement("option");
                var route = result.routes[i];
                var duration = route.legs[0].duration.text;
                var distance = route.legs[0].distance.text;

                // Create the option text in French
                var optionText =
                    "Route " +
                    (i + 1) +
                    ": Durée - " +
                    duration
                        .replace("hours", "heures")
                        .replace("mins", "minutes") +
                    ", Distance - " +
                    distance.replace("km", "km");

                option.value = optionText;
                option.text = optionText;
                selectElement.appendChild(option);

                // Create a new DirectionsRenderer object for each route
                var directionsRenderer = new google.maps.DirectionsRenderer({
                    map: map,
                    directions: result, // Set the DirectionsResult object
                    routeIndex: i,
                    suppressMarkers: true, // Hide the default markers
                });

                // Set the polyline options for each route
                directionsRenderer.setOptions({
                    polylineOptions: {
                        strokeColor: i === fastestRouteIndex ? "blue" : "gray",
                        strokeOpacity: i === fastestRouteIndex ? 1.0 : 0.5,
                        strokeWeight: i === fastestRouteIndex ? 6 : 4,
                    },
                });

                directionsRenderers.push(directionsRenderer);
            }

            // Create a new marker for the start location
            geocoder.geocode(
                {
                    address: start,
                },
                function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var startLatLng = results[0].geometry.location;
                        var startMarker = new google.maps.Marker({
                            position: startLatLng,
                            map: map,
                            title: "Start",
                        });
                    }
                }
            );

            // Create a new marker for the end location
            geocoder.geocode(
                {
                    address: end,
                },
                function (results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        var endLatLng = results[0].geometry.location;
                        var endMarker = new google.maps.Marker({
                            position: endLatLng,
                            map: map,
                            title: "End",
                        });
                    }
                }
            );

            // Set the default selection to the fastest route
            selectElement.value = "Route " + (fastestRouteIndex + 1);

            // Update the polyline options for the default selection
            directionsRenderers[fastestRouteIndex].setOptions({
                polylineOptions: {
                    strokeColor: "blue",
                    strokeOpacity: 1.0,
                    strokeWeight: 6,
                },
            });

            // Event listener for route selection
            selectElement.addEventListener("change", function () {
                var selectedIndex = selectElement.selectedIndex;

                // Reset polyline options for all routes
                for (var i = 0; i < directionsRenderers.length; i++) {
                    var directionsRenderer = directionsRenderers[i];
                    directionsRenderer.setOptions({
                        polylineOptions: {
                            strokeColor: "gray",
                            strokeOpacity: 1,
                            strokeWeight: 4,
                        },
                    });
                    directionsRenderer.setMap(map); // Update the renderer on the map
                }

                // Set the polyline options for the selected route
                directionsRenderers[selectedIndex].setOptions({
                    polylineOptions: {
                        strokeColor: "blue",
                        strokeOpacity: 1.0,
                        strokeWeight: 6,
                    },
                });

                directionsRenderers[selectedIndex].setMap(map); // Update the selected renderer on the map
            });
            // Set the default selection to the fastest route
            selectElement.selectedIndex = fastestRouteIndex;

            // Mark the fastest route option as selected
            var fastestOption = selectElement.options[fastestRouteIndex];
            if (fastestOption) {
                fastestOption.selected = true;
            }
        }
    });
}

// Add an event listener to the "Next" button on the first tab to update the map with the entered addresses:
$("#step-2").click(function () {
    initMap(
        $("#Ladresse_de_Depart").val(),
        $("#Ladresse_de_Destination").val()
    );
});

function selectFirstOption(selectId) {
    var selectElement = document.getElementById(selectId);
    var optionsCount = selectElement.options.length;

    if (optionsCount > 0) {
        selectElement.selectedIndex = 0;
        console.log("done");
    }
}
selectFirstOption("routeSelect");


// Get the departure date and time inputs
const departureDateInput = document.getElementById('departure-date');
const departureTimeInput = document.getElementById('departure-time');

// Set the minimum date for the departure date input to tomorrow's date
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
const tomorrowFormatted = tomorrow.toISOString().split('T')[0];
departureDateInput.setAttribute('min', tomorrowFormatted);

// Function to update the minimum time based on the selected date
function updateTimeLimit() {
  const selectedDate = new Date(departureDateInput.value);
  const today = new Date();
  const minTimeDifference = 12; // Minimum time difference in hours

  // Calculate the minimum time
  const minTime = new Date(today.getTime() + minTimeDifference * 60 * 60 * 1000);

  // Restrict the time picker to the 12-hour window from the current time
  if (selectedDate.toDateString() === today.toDateString()) {
    const minHour = minTime.getHours();
    const minMinute = minTime.getMinutes();
    const minSecond = minTime.getSeconds();
    const formattedMinHour = minHour < 10 ? '0' + minHour : minHour;
    const formattedMinMinute = minMinute < 10 ? '0' + minMinute : minMinute;
    const formattedMinSecond = minSecond < 10 ? '0' + minSecond : minSecond;
    const minTimeValue = `${formattedMinHour}:${formattedMinMinute}:${formattedMinSecond}`;
    departureTimeInput.setAttribute('min', minTimeValue);
  } else {
    departureTimeInput.removeAttribute('min');
  }
}

// Initialize the time limit on page load
updateTimeLimit();

