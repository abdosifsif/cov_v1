<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleLogin.css') }}">
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
            <div class="title">Covoiturage</div>
            @if (session('success'))
                <div class="alert-success">
                    <h4>{{ session('success') }}</h4>
                </div>
            @endif
            @if (session('status'))
                <div class="alert-success">
                    <h4>{{ session('status') }}</h4>
                </div>
            @endif
            @error('email')
                <div class="alert">
                    <h5>{{ $message }}</h4>
                </div>
            @enderror
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="credentials">
                    <div class="username">
                        <span class="glyphicon glyphicon-user"></span>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="Votre email"
                            required autofocus autocomplete="email">

                    </div>
                    <div class="password">
                        <span class="glyphicon glyphicon-lock"></span>
                        <input type="password" name="password" placeholder="Votre mot de passe" required
                            autocomplete="current-password">
                        @error('password')
                            <div class="error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="submit">Connecter</button>

            </form>
            <div class="link">
                <a href="{{ route('password.request') }}">Mot de passe oublier</a><br><a
                    href="{{ route('register') }}">S'inscrire</a>

            </div>

        </div>
    </div>
</body>

</html>
