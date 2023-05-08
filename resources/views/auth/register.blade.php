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
    <header class="main-head">
        <nav>
            <h2 id="logo">Covoiturage</h2>
            <ul class="hover_cont">
                <li><a href="/login""><strong>Se Connecter</strong></a></li>
                <li><a href="/register"><strong> S'inscrire</strong></a></li>
            </ul>
        </nav>
    </header>


    <div class="frst">
        <section class="container">
            <header>Inscription</header>
            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="form">
                @csrf
              <div class="input-box">
                <label >Nom</label>
                <input type="text" name="nom" placeholder="Votre nom" required />
              </div>
              <div class="input-box">
                <label for="prenom">Prénom</label>
                <input type="text" name="prenom" placeholder="Votre Prenom" required />
              </div>
              <div class="column">
                <div class="input-box">
                  <label for="telephone">Numero de téléphone</label>
                  <input type="number" name="telephone" placeholder="Votre numero de téléphone" required />
                </div>
                <div class="input-box">
                  <label for="date">Date de naissance</label>
                  <input type="date" name="date" placeholder="Enter birth date" required />
                </div>
              </div>
              <div class="gender-box">
                <h3>Sexe</h3>
                <div class="gender-option">
                  <div class="gender">
                    <input type="radio" id="check-male" name="sexe" checked />
                    <label for="check-male">Homme</label>
                  </div>
                  <div class="gender">
                    <input type="radio" id="check-female" name="sexe" />
                    <label for="check-female">Femme</label>
                  </div>
                </div>
              </div>
              <div class="input-box address">
                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Votre email" required />
                <div class="column">
                  <div class="select-box">
                    <select name="ville">
                      <option hidden>Ville</option>
                    </select>
                  </div>
                </div>
                <div class="column">
                  <input type="password" name="password" placeholder="Votre mot de passe" required />
                  <input type="password" name="password_confirmation" placeholder="Confirmer votre mot de passe" required />
                </div>
              </div>
              <button>S'inscrire</button>
            </form>
            <div class="link">
                <a href="log_in.html">T'as déjà un compte ?</a>
            </div>
          </section>
        </div>

</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</html>