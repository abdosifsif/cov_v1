<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleRecup.css') }}">
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
        <div class="main">
           <div class="title">Recuperation de mot de passe</div>
           <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
        
            <!-- Password Reset Token and Email -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <input type="hidden" name="email" value="{{ request('email') }}">
        
            <div class="password1">
                <div class="username">
                    <span class="glyphicon glyphicon-user"></span>
                    <input type="password" name="password" placeholder="Nouveau mot de passe" required>
                </div>          
                <div class="password2">
                    <span class="glyphicon glyphicon-lock"></span>
                    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required>
                </div>
            </div>
            <button class="submit" type="submit">Envoyer</button>
        </form>
        </div>
       </div> 
       </body>

</html>