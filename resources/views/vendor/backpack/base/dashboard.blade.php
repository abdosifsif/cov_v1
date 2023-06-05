@extends(backpack_view('blank'))

@section('content')
<div class="row">
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4"><i class="fas fa-users"></i></div>
                <div class="text-value">{{ $registeredUsers }}</div>
                <small class="text-muted text-uppercase font-weight-bold">users</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-success">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4"><i class="fas fa-users"></i></div>
                <div class="text-value">{{ $trajetCount }}</div>
                <small class="text-muted text-uppercase font-weight-bold">nbr trajet</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4"><i class="fas fa-users"></i></div>
                <div class="text-value">{{ $villeCount }}</div>
                <small class="text-muted text-uppercase font-weight-bold">ville nbr</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-md-2" style="flex: 0 0 50%; max-width: 51%;">
        <div class="card text-white bg-dark">
            <div class="card-body">
                <div class="h1 text-muted text-right mb-4"><i class="fas fa-users"></i></div>
                <div class="text-value">{{ $villeCount }}</div>
                <small class="text-muted text-uppercase font-weight-bold">ville nbr</small>
                <div class="progress progress-white progress-xs mt-3">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
