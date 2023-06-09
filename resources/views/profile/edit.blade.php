<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleProfile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" crossorigin="anonymous" />

    <title>Document</title>
</head>

<body>
    <header class="main-head">
        <nav>
            <h2 id="logo">Covoiturage</h2>
            <ul class="hover_cont">
                <li><a href="/ajouter-trajet"><strong>Ajouter Trajet</strong></a></li>
                <li><a href="/recherche"><strong>Recherche</strong></a></li>
                <li>
                    <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" class="user-pic" onclick="showMenu()">
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
    <div class="frst">
        <section class="pre">
            <div class="navv">
                <ul>
                    <li><a href="#profile" id="btnprofile">Profile</a></li>
                    <li><a href="#" id="btntrajets">Mes trajets</a></li>
                    <li><a href="#preference" id="btnpreferences">Mes préferences</a></li>
                    <li><a href="#" id="btnvoiture">Ma véhicule</a></li>
                </ul>
            </div>
        </section>
        <section id="profile">
            <header>Informations personnelles</header>
            <form action="#" class="form">
              <div class="input-box">
                <label>Nom</label>
                <input type="text" placeholder="Votre nom" value="{{ $user->nom }}" />
              </div>
              <div class="input-box">
                <label>Prénom</label>
                <input type="text" placeholder="Votre Prénom" value="{{ $user->prenom }}" />
              </div>
              <div class="column">
                <div class="input-box">
                  <label>Numéro de téléphone</label>
                  <input type="number" placeholder="Votre numéro de téléphone" value="{{ $user->telephone }}" />
                </div>
                <div class="input-box">
                  <label>Date de naissance</label>
                  <input type="date" placeholder="Enter birth date" value="{{ $user->date}}" />
                </div>
              </div>
              <div class="input-box address">
                <label>Ville</label>
                <input type="text" placeholder="Votre ville" value="{{ $user->ville }}" />
                <label>Email</label>
                <input type="text" placeholder="Votre adresse" value="{{ $user->email }}" />
                <label>Mot de passe</label>
                <input type="password" placeholder="Votre mot de passe"/>
              </div>
              <button>Enregistrer les modifications</button>
            </form>
          </section>
          
        <section id="trajets">
            <div class="personnels">
                <img src="images/profile-circle-svgrepo-com.svg" alt="">
                <p><strong>MAJIDA EL-FADIL</strong></p>
            </div>
            <span class="vertical-line"></span>
            <div class="container">
                <div class="infodh">
                    <h5>15/10/2022</h5>
                    <h5>&nbsp;A&nbsp;</h5>
                    <h5>10:50</h5>
                </div><br>
                <div class="infdepdes">
                    <p><strong>agadir</strong></p>&nbsp;&nbsp;
                    <img src="images/arrow-right-svgrepo-com (1).svg" alt="">&nbsp;&nbsp;
                    <p><strong>casablancacasa</strong></p>
                </div><br>
                <div class="autre">
                    <div class="depart">
                        <img src="images/location-svgrepo-com.svg" alt="">&nbsp;&nbsp;
                        <p><strong>agadir</strong></p>
                    </div><br>
                    <div class="destination">
                        <img src="images/location-svgrepo-com.svg" alt="">&nbsp;&nbsp;
                        <p><strong>casablancacasa</strong></p>
                    </div><br>
                    <div class="passaget">
                        <img src="images/person-team-svgrepo-com.svg" alt="">&nbsp;&nbsp;
                        <p><strong>2</strong></p>
                    </div><br>
                </div>
                <div class="prix">
                    <p><strong>200DH</strong></p>
                </div>
            </div>

        </section>
        <section id="preferences">
          <form action="{{ route('profile.preferences') }}" method="POST">
              @csrf
              <div class="music-box">
                <h3><i class="fas fa-music fa-lg" style="color: green;"></i> Musique</h3>
                <div class="option">
                    <div class="music">
                        <input type="radio" id="check-music" name="music" value="1" onclick="updateRadioStyle('music')" {{ $preferences && $preferences->music ? 'checked' : '' }} />
                        <label for="check-music">Oui</label>
                    </div>
                    <div class="option1">
                        <input type="radio" id="check-music1" name="music" value="0" onclick="updateRadioStyle('music')" {{ $preferences && !$preferences->music ? 'checked' : '' }} />
                        <label for="check-music1">Non</label>
                    </div>
                </div>
            </div>
              <div class="animaux-box">
                  <h3><i class="fas fa-paw fa-lg" style="color: green;"></i> Animal</h3>
                  <div class="option">
                      <div class="animal">
                          <input type="radio" id="check-animal" name="animal" value="1" onclick="updateRadioStyle('animal')" {{ $preferences && $preferences->animal ? 'checked' : '' }} />
                          <label for="check-animal">Oui</label>
                      </div>
                      <div class="option1">
                          <input type="radio" id="check-animal1" name="animal" value="0" onclick="updateRadioStyle('animal')" {{ $preferences && !$preferences->animal ? 'checked' : '' }} />
                          <label for="check-animal1">Non</label>
                      </div>
                  </div>
              </div>
              <div class="fumeur-box">
                  <h3><i class="fas fa-smoking fa-lg" style="color: green;"></i> Fumeur</h3>
                  <div class="option">
                      <div class="fumeur">
                          <input type="radio" id="check-fumeur" name="fumeur" value="1" onclick="updateRadioStyle('fumeur')" {{ $preferences && $preferences->fumeur ? 'checked' : '' }} />
                          <label for="check-fumeur">Oui</label>
                      </div>
                      <div class="option1">
                          <input type="radio" id="check-fumeur1" name="fumeur" value="0" onclick="updateRadioStyle('fumeur')" {{ $preferences && !$preferences->fumeur ? 'checked' : '' }} />
                          <label for="check-fumeur1">Non</label>
                      </div>
                  </div>
              </div>
              <div class="discussion-box">
                  <h3><i class="fas fa-comment fa-lg" style="color: green;"></i> Discussion</h3>
                  <div class="option">
                      <div class="discussion">
                          <input type="radio" id="check-discussion" name="discussion" value="1" onclick="updateRadioStyle('discussion')" {{ $preferences && $preferences->discussion ? 'checked' : '' }} />
                          <label for="check-discussion">Oui</label>
                      </div>
                      <div class="option1">
                          <input type="radio" id="check-discussion1" name="discussion" value="0" onclick="updateRadioStyle('discussion')" {{ $preferences && !$preferences->discussion ? 'checked' : '' }} />
                          <label for="check-discussion1">Non</label>
                      </div>
                  </div>
              </div>
              <button id="pressedbtn" type="submit">Enregistrer les modifications</button>
          </form>
      </section>
      
      
      
          
          
        <section id="voiture">
            <header>Ma véhicule</header>
            <form action="#" class="form">
                <div class="input-box">
                    <label>Marque</label>
                    <input type="text" placeholder="Ex:Renault" />
                </div>
                <div class="input-box">
                    <label>Modèle</label>
                    <input type="text" placeholder="Ex:clio" />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Confort</label>
                        <select>
                            <option value="" selected>Choisissez</option>
                            <option value="">Basique</option>
                            <option value="">Normal</option>
                            <option value="">Confortable</option>
                            <option value="">Luxe</option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Nombre de place</label>
                        <select>
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                        </select>
                    </div>
                </div>


                <button>Enregistrer les modifications</button>
            </form>
        </section>
    </div>
</body>
<script>
   // Sélectionne les boutons
const btnSection1 = document.getElementById('btnprofile');
const btnSection2 = document.getElementById('btntrajets');
const btnSection3 = document.getElementById('btnpreferences');
const btnSection4 = document.getElementById('btnvoiture');

// Sélectionne les sections correspondantes
const section1 = document.getElementById('profile');
const section2 = document.getElementById('trajets');
const section3 = document.getElementById('preferences');
const section4 = document.getElementById('voiture');

// Fonctions pour afficher/cacher les sections
function afficherSection1() {
  section1.style.display = 'block';
  section2.style.display = 'none';
  section3.style.display = 'none';
  section4.style.display = 'none';
  btnSection1.classList.add('active');
  btnSection2.classList.remove('active');
  btnSection3.classList.remove('active');
  btnSection4.classList.remove('active');
}

function afficherSection2() {
  section1.style.display = 'none';
  section2.style.display = 'flex';
  section3.style.display = 'none';
  section4.style.display = 'none';
  btnSection1.classList.remove('active');
  btnSection2.classList.add('active');
  btnSection3.classList.remove('active');
  btnSection4.classList.remove('active');
}

function afficherSection3() {
  section1.style.display = 'none';
  section2.style.display = 'none';
  section3.style.display = 'block';
  section4.style.display = 'none';
  btnSection1.classList.remove('active');
  btnSection2.classList.remove('active');
  btnSection3.classList.add('active');
  btnSection4.classList.remove('active');
}

function afficherSection4() {
  section1.style.display = 'none';
  section2.style.display = 'none';
  section3.style.display = 'none';
  section4.style.display = 'block';
  btnSection1.classList.remove('active');
  btnSection2.classList.remove('active');
  btnSection3.classList.remove('active');
  btnSection4.classList.add('active');
}

// Affiche la section Profile par défaut
afficherSection1();

// Associe les fonctions aux événements de clic sur les boutons
btnSection1.addEventListener('click', afficherSection1);
btnSection2.addEventListener('click', afficherSection2);
btnSection3.addEventListener('click', afficherSection3);
btnSection4.addEventListener('click', afficherSection4);
function updateRadioStyle(groupName) {
    var radios = document.getElementsByName(groupName);
    radios.forEach(function(radio) {
      var label = radio.nextElementSibling;
      if (radio.checked) {
        label.classList.add("selected");
      } else {
        label.classList.remove("selected");
      }
    });
  }
  

</script>

</html>
