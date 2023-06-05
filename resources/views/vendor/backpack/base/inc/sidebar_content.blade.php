<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('user') }}"><i class="fas fa-users"></i> Utilisateurs</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('trajet') }}"><i class="fas fa-car"></i> Trajets</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('ville') }}"><i class="fas fa-city"></i> Villes</a></li>