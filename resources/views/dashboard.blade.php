
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Covoiturage</title>
    <link rel="stylesheet" href="{{ asset('css/styleHeader.css') }}">
</head>

<body onclick="hidMenu()">
    <header>
        
        <div>
            <nav>
                <a href="/" class="logo"> Covoiturage</a>
                <ul class="principale">
                    <li><a href="#">
                            <div class="link-wrap">
                                <img src="images/search-svgrepo-com (1).svg">
                                <div>
                                    <p> Recherche</p>
                                </div>
                            </div>
                        </a></li>
                    <li><a href="#">
                            <div class="link-wrap">
                                <img src="images/add-circle-svgrepo-com.svg">
                                <div>
                                    <p> Publier un trajet</p>
                                </div>
                            </div>
                        </a></l>
                </ul>
                <img src="{{ app('App\Http\Controllers\UserController')->getUserPic() }}" class="user-pic" onclick="showMenu()">

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                        <a href="/login" class="sub-menu-links">
                            <p>Vos trajet</p>
                            <span>></span>
                        </a>
                        <hr>
                        <a href="Registre" class="sub-menu-links">
                            <p>Messages</p>
                            <span>></span>
                        </a>
                        <hr>
                        <a href="Registre" class="sub-menu-links">
                            <p>Profil</p>
                            <span>></span>
                        </a>
                        <hr>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="#" class="sub-menu-links" onclick="event.preventDefault(); this.closest('form').submit();">
                                <p>Déconnexion</p>
                                <span>></span>
                            </a>
                        </form>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
       
    </header>
    <article>

 
    </article>
    
    <script type="text/javascript" src="{{ URL::asset('scripts/myscripts.js') }}"></script>
</body>

</html>