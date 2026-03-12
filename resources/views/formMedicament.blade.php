@extends('layouts.master')

@section('content')
    <form method="POST" action="{{ url('/validerMedicament') }}">
        {{csrf_field()}}

        <h1>Liste de médicaments</h1>

        <div class="col-md-12 card card-body bg-light">
            <div class="form-group">
                <label class="col-md-9">Rechercher médicaments</label>
                <div class="col-md-6">
                   <input type="text" name="recherchemedicament" class="form-control" value="{{-- {{$frais->titre}}--}}" required>
                </div>
            </div>

            <div class="form-group">

            <button type="submit" class="btn btn-default btn-primary">
                <span class="glyphicon glyphicon-ok"></span>
                Valider
            </button>

            <button type="button" class="btn btn-default btn-primary"
                    onclick="if (confirm('Annuler la saisie ?'))window.location='{{url('/')}}';">
                <span class="glyphicon glyphicon-remove" ></span> Annuler
            </button>
            </div>



{{--            <div class="form-group">--}}
{{--                <div class="col-md-12 col-md-offset3">--}}
{{--                    <button type="submit" class="btn btn-primary" >--}}
{{--                        Valider--}}
{{--                    </button>--}}
{{--                    <button type="button" class="btn btn-secondary" onclick="if (confirm('Annuler la saisie ?'))window.location='{{url('/')}}';">--}}
{{--                        Annuler--}}
{{--                    </button>--}}
{{--                    @if($frais->id_frais)--}}
{{--                        <a href="{{url('/supprimerFrais/'.$frais->id_frais)}}" id="suppr" class="btn btn-danger"  onclick="return confirm('Supprimer cette fiche de frais ?')" >--}}
{{--                            Supprimer--}}
{{--                        </a>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}

        </div>
    </form>

    @if(isset($erreur))
        <div class="alert alert-danger" role="alert">{{ $erreur }}</div>
    @endif
@endsection
