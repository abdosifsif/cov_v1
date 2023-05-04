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
    <article>
        <form class="form" method="POST" action="{{ route('login') }}" >
            @csrf
            <input placeholder="Email address or phone number" class="input" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            <input placeholder="Password" class="input" type="password" name="password" required autocomplete="current-password">
            <button id="loginBtn" type="submit">{{ __('Log in') }}</button>
            <a id="forgotPassword" href="{{ route('password.request') }}">Forgotten password?</a>
            <button class="create" id="createAccountBtn"><a href="{{ route('register') }}">Create new account</a></button>
        </form>
    </article>
</body>
<script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</html>