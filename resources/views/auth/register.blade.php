<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styleRegistre.css') }}">
    <script src='main.js'></script>
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
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
           
            <div class="column">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required><br>

                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required><br>
               
                <label for="password">mot de pass:</label>
                <input type="password" id="password" name="password" required>
                <br>
                {{-- <input type="checkbox" onclick="myFunction()">Show Password<br> --}}
               
                <label for="password">confirmer votre mot de passe:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required><br>
               
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required><br>
            </div>

            <div class="column" id="ss">
                <label for="sexe">Sexe:</label>
                <select id="sexe" name="sexe" required>
                    <option value="homme">---Sexe---</option>
                    <option value="homme">Homme</option>
                    <option value="femme">Femme</option>
                </select><br>

                <label for="telephone">Téléphone:</label>
                <input type="tel" id="telephone" name="telephone" required><br>

                <label for="ville">Ville:</label>
                <input type="text" id="ville" name="ville" required><br>

                <label for="picture">Photo de profil:</label>
                <input type="file" id="picture" name="picture" ><br>
                
                <input type="submit" value="S'inscrire" onclick="return validateForm()">
            </div>
        </form>





    </article>

</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</html>