@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Mijn Account</div>
                <div class="card-body">
                    @if ($surfUser == null)
                        <p>Heb je je account nog niet gelinked aan surf?</p>

                        <a href="/surf/login" class="btn btn-primary">Link nu!</a><br>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

        

                    @if ($surfUser != null)
                        <h2>Accountgegevens uit surf: </h2>
                        <div class="surfGegevens">
                            @foreach ($surfUser->attributes as $attr)
                                <p><b>{{$attr->surf_key}}</b></p>
                                <p>{{$attr->surf_value}}</p>
                            @endforeach
                        </div>

                    @endif
       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
