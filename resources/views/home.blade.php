@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Je bent ingelogd.

                    <a href="/account">Ga naar de mijn account pagina.</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
