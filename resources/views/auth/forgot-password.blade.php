<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleMotOub.css') }}">
</head>

<body onclick="hidMenu()">
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
        
        <div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <h1>Récuperer votre compte</h1>
                <label for="">Veuillez entrer votre adresse e-mail pour récuperer votre mot de passe</label><br>
                <input placeholder=" Votre e-mail  " class="input" type="text" name="email" value="{{ old('email') }}" required>
                <input type="reset" value="Annuler" class="loginBtn">
                <input type="submit" value="Envoyer" class="loginBtn">
            </form>
            
        </div>
    </article>
    <footer>




    </footer>
    <script src="myscripts.js"></script>
</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</html>