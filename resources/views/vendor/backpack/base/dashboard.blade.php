@extends(backpack_view('blank'))
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="h1 text-right mb-4"><i class="fas fa-users"></i></div>
                <div class="text-value">{{ $registeredUsers }}</div>
                <small class="text-uppercase font-weight-bold">Utilisateurs.</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($registeredUsers / 100) * 100 }}%" aria-valuenow="{{ ($registeredUsers / 100) * 100 }}"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted"> {{ 100 - $registeredUsers }} plus jusqu'à la prochaine étape.</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <div class="h1 text-right mb-4"><i class="fas fa-user-plus"></i></div>
                <div class="text-value">{{ $newUserCount }}</div>
                <small class="text-uppercase font-weight-bold">Nouveaux Utilisateurs.</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($newUserCount / 100) * 100 }}%" aria-valuenow="{{ ($newUserCount / 100) * 100 }}"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted"> {{ 100 - $newUserCount }} plus jusqu'à la prochaine étape.</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="h1 text-right mb-4"><i class="fas fa-car"></i></div>
                <div class="text-value">{{ $trajetCount }}</div>
                <small class="text-uppercase font-weight-bold">Trajets.</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: {{ ($trajetCount / 100) * 100 }}%" aria-valuenow="{{ ($trajetCount / 100) * 100 }}"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted"> {{ 100 - $trajetCount }} plus jusqu'à la prochaine étape.</small>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="h1 text-right mb-4"><i class="fas fa-calendar-day"></i></div>
                <div class="text-value">{{ $daysSinceLastTrajet }}  jours </div>
                <small class="text-uppercase font-weight-bold">Depuis le dernier trajet.</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                         aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted"> {{ $daysSinceLastTrajet }} jours depuis le dernier trajet.</small>
            </div>
        </div>
    </div>
    
</div>

@endsection
