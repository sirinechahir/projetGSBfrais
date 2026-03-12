@extends('layouts.master')

@section('content')
<form method="POST" action="{{ route('validFraisHF') }}">
    {{csrf_field()}}

    <input type="hidden" name="id" value="{{$fraisHF->id_frais}}">


    <h1>@if($fraisHF->id_fraishorsforfait) Modification @else Ajout @endif Frais Hors Forfait</h1>
    <div class="col-md-12 card card-body bg-light">
        <div class="form-group">
            <label class="col-md-3" for="date">Date  </label>
            <div class="col-md-6">
                <input type="date" name="date" class="form-control" value="{{$fraisHF->datefraishorsforfait}}"  required>
            </div>

        </div>
        <div class="form-group">
            <label class="col-md-3">Libellé</label>
            <div class="col-md-6">
                <input type="text" name="titre" class="form-control" value="{{$fraisHF->lib_fraishorsforfait}}" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3">Montant </label>
            <div class="col-md-6">
                <input type="number" name="montant" class="form-control " min="0" step="1" value="{{$fraisHF->montant_fraishorsforfait}}" >
            </div>
        </div>
       <hr>
        <div class="form-group">
            <div class="col-md-12 col-md-offset3">
                <button type="submit" class="btn btn-primary" >
                    Valider
                </button>
                <button type="button" class="btn btn-secondary" onclick="if (confirm('Annuler la saisie ?'))window.location='{{url('/')}}';">
                    Annuler
                </button>
            </div>
        </div>

    </div>
</form>

@if(isset($erreur))
<div class="alert alert-danger" role="alert">{{ $erreur }}</div>
@endif
@endsection
