@extends('layouts.master')

@section('content')
    <div class="container">
        <h1> @if($form->id_medicament && $form->id_presentation)
           Modifier @else Ajouter  @endif  une formulation</h1>

        <form method="POST" action="{{ route('validerFormulation') }}">
            @csrf
            <input type="hidden" name="id_medicament" value="{{ $form->id_medicament }}">

            @if($form->id_presentation)
                <input type="hidden" name="id_presentation_old" value="{{ $form->id_presentation }}">
            @endif

            <div class="form-group">
                <label>Quantité</label>
                <input type="text" name="qteformuler" value ="{{ $form->qte_formuler}}" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Présentation :  ID (1 à 14)</label>
                <input type="number" name="presentation" value="{{ $form->id_presentation }}" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Valider</button>

            <button type="button" class="btn btn-primary"
                    onclick="if (confirm('Annuler la saisie ?')) window.location='{{ url('/listerFormulation/'.$form->id_medicament) }}';">
                Retour
            </button>
        </form>
    </div>
@endsection
