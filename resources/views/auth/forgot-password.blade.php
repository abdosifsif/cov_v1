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
            @error('email')
            <div class="error-message"><h4>Nous ne trouvons pas d'utilisateur avec cette adresse e-mail.</h4></div>
        @enderror
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mail">
                <div class="username">
                    <span class="glyphicon glyphicon-user"></span>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Votre email" required>
                </div>
            </div>
            <button class="submit" onclick="goToLogin(event)">Annuler</button>
            <button type="submit" name="submit" class="submit">Envoyer</button>
        </form>
        </div>
    </div>
</body>
<script>
    function goToLogin(event) {
        event.preventDefault();
        if (event.target.name !== 'submit') {
            window.location.href = "{{ url('/login') }}";
        }
    }
</script>
</html>
