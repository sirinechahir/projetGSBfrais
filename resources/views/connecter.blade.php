@extends('layouts.master')

@section('content')

    <form method="POST" action="{{url('/connecter')}}">
        {{csrf_field()}}

        <div class="col-md-18 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-6">Utilisateur: </label>
                <div class="col-md-6">
                    <input type="text" name="utilisateur" value="" class="form-control" required>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-6">Mot de passe: </label>
                <div class="col-md-6">
                    <input type="text" name="mdp" value="" class="form-control" required>
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-12 col-md-offset3">
                    <button type="submit" class="btn btn-primary" >Se connecter</button>
                    <button type="button" class="btn btn-secondary" onclick="if (confirm('Annuler la saisie ?'))window.location='{{url('/')}}';">
                        Annuler
                    </button>
                </div>
            </div>
        </div>
        @if (isset($erreur))
            <div class="alert alert-danger" role="alert">{{$erreur}}</div>
        @endif
    </form>
@endsection
