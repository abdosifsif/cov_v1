<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleMotOub.css') }}">
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
            <div class="title">Recuperer votre compte</div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mail">
                    <div class="username">
                        <span class="glyphicon glyphicon-user"></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Votre email"
                            required>
                        @error('email')
                            <div class="error-message">Nous ne trouvons pas d'utilisateur avec cette adresse e-mail.</div>
                        @enderror
                    </div>
                </div>
                <<button class="submit"> <a href="{{ url('/login') }}" class="submit">Annuler</a> </button>
                    <button class="submit">Envoyer</button>
            </form>
        </div>
    </div>
</body>

</html>
