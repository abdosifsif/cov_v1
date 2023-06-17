<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleProfile.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        crossorigin="anonymous" />

    <title>Document</title>
</head>

<body>
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
        <section class="pre">
            <div class="navv">
                <ul>
                    <li><a href="#profile" id="btnprofile">Profile</a></li>
                    <li><a href="#mestrajets" id="btntrajets">Mes trajets</a></li>
                    <li><a href="#preference" id="btnpreferences">Mes préferences</a></li>
                    <li><a href="#voiture" id="btnvoiture">Mon véhicule</a></li>
                </ul>
            </div>
        </section>
        <section id="profile">
            <header>Informations personnelles</header>
            <form action="{{ route('profile.update') }}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="input-box">
                    <label for="image-input">Photo de profil</label>
                    <input type="file" name="picture" accept="image/*" hidden id="image-input">
                    <br>
                    <div class="image">
                        <label for="image-input" id="image-label">
                            <div class="profile-image" id="profile-image">
                                <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" alt="" id="preview-image">
                            </div>
                        </label>
                        <span class="error-message"></span>
                    </div>
                </div>
                <div class="input-box">
                    <label>Nom</label>
                    <input type="text" name="nom" placeholder="Votre nom" value="{{ $user->nom }}" />
                    @error('nom')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-box">
                    <label>Prénom</label>
                    <input type="text" name="prenom" placeholder="Votre Prénom" value="{{ $user->prenom }}" />
                    @error('prenom')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Numéro de téléphone</label>
                        <input type="number" name="telephone" placeholder="Votre numéro de téléphone"
                            value="{{ $user->telephone }}" />
                        @error('telephone')
                            <span class="error-message"> {{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-box">
                        <label for="date-input">Date de naissance</label>
                        <input type="date" id="date-input" name="date" placeholder="Date de naissance"
                            value="{{ $user->date }}"
                            max="{{ \Carbon\Carbon::now()->subYears(18)->format('Y-m-d') }}" />
                        @error('date')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="gender-box">
                    <h3>Sexe</h3>
                    <div class="gender-option">
                        <div class="gender">
                            <input type="radio" id="check-male" name="sexe" value="Homme"
                                {{ $user->sexe == 'Homme' ? 'checked' : '' }} />
                            <label for="check-male">Homme</label>
                        </div>
                        <div class="gender">
                            <input type="radio" id="check-female" name="sexe" value="Femme"
                                {{ $user->sexe == 'Femme' ? 'checked' : '' }} />
                            <label for="check-female">Femme</label>
                        </div>
                    </div>
                    @error('sexe')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-box address">
                    <div class="column">
                        <div class="select-box">
                            <select name="ville" id="ville">
                                <option value="" selected disabled hidden>Ville</option>
                                @foreach ($villes as $ville)
                                    <option value="{{ $ville->id }}"
                                        {{ $ville->id == $user->ville ? 'selected' : '' }}>
                                        {{ $ville->ville }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ville')
                                <span class="error-message"> {{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-box address">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Votre adresse" value="{{ $user->email }}" />
                    @error('email')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>
                <div class="input-box address">
                    <label>Mot de passe actuel</label>
                    <input type="password" name="Mot_de_passe_actuel" placeholder="Votre mot de passe actuel" />
                    @error('Mot_de_passe_actuel')
                        <span class="error-message"> {{ $message }}</span>
                    @enderror
                </div>
                <button type="submit">Enregistrer les modifications</button>
            </form>
        </section>



        <section id="trajets" class="table-responsive">
            @if ($trajets->isEmpty())
                <div class="no-trajet">
                    <h4> Aucun trajet n'est publié par cet utilisateur.</h4>
                </div>
            @else
                <h5>Vous devez mettre à jour le nombre de passagers si vous avez accepté un ou plusieurs passagers.</h3>
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Départ</th>
                                <th>Destination</th>
                                <th>Nombre de passagers</th>
                                <th>Prix</th>
                                <th>Disponible</th>
                                <th>{{ $trajets[0]->nbr_passager == 0 ? 'Status' : 'Action' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trajets as $trajet)
                                <tr>
                                    <form action="{{ route('profile.updateTrajet', ['id' => $trajet->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <td>{{ $trajet->departure_date }}</td>
                                        <td>{{ $trajet->Heure }}</td>
                                        <td>{{ $trajet->{"L'adresse_de_Départ"} }}</td>
                                        <td>{{ $trajet->{"L'adresse_de_Destination"} }}</td>
                                        <td id="input-td">
                                            @if ($trajet->nbr_passager == 0)
                                                <input id="input" type="number" name="nbr_passager"
                                                    max="4" value="{{ $trajet->nbr_passager }}" disabled>
                                            @else
                                                <input id="input" type="number" name="nbr_passager"
                                                    max="4" min="0" value="{{ $trajet->nbr_passager }}">
                                            @endif
                                        </td>
                                        <td>{{ $trajet->prix }}</td>
                                        <td>{{ $trajet->disponible }}</td>
                                        <td>
                                            @if ($trajet->nbr_passager == 0)
                                                <p><strong>Archivé</strong></p>
                                            @else
                                                <button id="btn" type="submit">modifier</button>
                                            @endif
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>
            @endif

            </table>
        </section>
        <section id="preferences">
            <form action="{{ route('profile.preferences') }}" method="POST">
                @csrf
                <div class="music-box">
                    <h3><i class="fas fa-music fa-lg" style="color: green;"></i> Musique</h3>
                    <div class="option">
                        <div class="music">
                            <input type="radio" id="check-music" name="music" value="1"
                                onclick="updateRadioStyle('music')"
                                {{ $preferences && $preferences->music ? 'checked' : '' }} />
                            <label for="check-music">Oui</label>
                        </div>
                        <div class="option1">
                            <input type="radio" id="check-music1" name="music" value="0"
                                onclick="updateRadioStyle('music')"
                                {{ $preferences && !$preferences->music ? 'checked' : '' }} />
                            <label for="check-music1">Non</label>
                        </div>
                    </div>
                </div>
                <div class="animaux-box">
                    <h3><i class="fas fa-paw fa-lg" style="color: green;"></i> Animal</h3>
                    <div class="option">
                        <div class="animal">
                            <input type="radio" id="check-animal" name="animal" value="1"
                                onclick="updateRadioStyle('animal')"
                                {{ $preferences && $preferences->animal ? 'checked' : '' }} />
                            <label for="check-animal">Oui</label>
                        </div>
                        <div class="option1">
                            <input type="radio" id="check-animal1" name="animal" value="0"
                                onclick="updateRadioStyle('animal')"
                                {{ $preferences && !$preferences->animal ? 'checked' : '' }} />
                            <label for="check-animal1">Non</label>
                        </div>
                    </div>
                </div>
                <div class="fumeur-box">
                    <h3><i class="fas fa-smoking fa-lg" style="color: green;"></i> Fumeur</h3>
                    <div class="option">
                        <div class="fumeur">
                            <input type="radio" id="check-fumeur" name="fumeur" value="1"
                                onclick="updateRadioStyle('fumeur')"
                                {{ $preferences && $preferences->fumeur ? 'checked' : '' }} />
                            <label for="check-fumeur">Oui</label>
                        </div>
                        <div class="option1">
                            <input type="radio" id="check-fumeur1" name="fumeur" value="0"
                                onclick="updateRadioStyle('fumeur')"
                                {{ $preferences && !$preferences->fumeur ? 'checked' : '' }} />
                            <label for="check-fumeur1">Non</label>
                        </div>
                    </div>
                </div>
                <div class="discussion-box">
                    <h3><i class="fas fa-comment fa-lg" style="color: green;"></i> Discussion</h3>
                    <div class="option">
                        <div class="discussion">
                            <input type="radio" id="check-discussion" name="discussion" value="1"
                                onclick="updateRadioStyle('discussion')"
                                {{ $preferences && $preferences->discussion ? 'checked' : '' }} />
                            <label for="check-discussion">Oui</label>
                        </div>
                        <div class="option1">
                            <input type="radio" id="check-discussion1" name="discussion" value="0"
                                onclick="updateRadioStyle('discussion')"
                                {{ $preferences && !$preferences->discussion ? 'checked' : '' }} />
                            <label for="check-discussion1">Non</label>
                        </div>
                    </div>
                </div>
                <button id="pressedbtn" type="submit">Enregistrer les modifications</button>
            </form>
        </section>




        <section id="voiture">
            <header>Ma voiture</header>
            <form action="{{ route('profile.voiture') }}" method="POST" class="form">
                @csrf
                <div class="input-box">
                    <label>Marque</label>
                    <input type="text" name="marque" placeholder="Ex: Renault"
                        value="{{ optional($user->voiture)->marque }}" />
                </div>
                <div class="input-box">
                    <label>Modèle</label>
                    <input type="text" name="modele" placeholder="Ex: Clio"
                        value="{{ optional($user->voiture)->modele }}" />
                </div>
                <div class="column">
                    <div class="input-box">
                        <label>Confort</label>
                        <select name="confort">
                            <option value="" selected>Choisissez</option>
                            <option value="Basique"
                                {{ optional($user->voiture)->confort === 'Basique' ? 'selected' : '' }}>Basique
                            </option>
                            <option value="Normal"
                                {{ optional($user->voiture)->confort === 'Normal' ? 'selected' : '' }}>Normal</option>
                            <option value="Confortable"
                                {{ optional($user->voiture)->confort === 'Confortable' ? 'selected' : '' }}>Confortable
                            </option>
                            <option value="Luxe"
                                {{ optional($user->voiture)->confort === 'Luxe' ? 'selected' : '' }}>Luxe
                            </option>
                        </select>
                    </div>
                    <div class="input-box">
                        <label>Nombre de places</label>
                        <select name="nombre_de_place">
                            <option value="1"
                                {{ optional($user->voiture)->nombre_de_place === 1 ? 'selected' : '' }}>1</option>
                            <option value="2"
                                {{ optional($user->voiture)->nombre_de_place === 2 ? 'selected' : '' }}>2</option>
                            <option value="3"
                                {{ optional($user->voiture)->nombre_de_place === 3 ? 'selected' : '' }}>3</option>
                            <option value="4"
                                {{ optional($user->voiture)->nombre_de_place === 4 ? 'selected' : '' }}>4</option>
                        </select>
                    </div>
                </div>
                <button type="submit">Enregistrer les modifications</button>
            </form>
        </section>

    </div>
</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('scripts/profileUpdate.js') }}"></script>

</body>

</html>
