@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">SurfNet koppeling</div>
                <div class="card-body">
                    @if ($linked)
                        Surfnet successvol gekoppeld. Je word naar de accountpagina gestuurd.
                    @else
                        Koppeling mislukt. Je word naar de accountpagina gestuurd.
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
