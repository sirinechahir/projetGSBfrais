@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des formulations :
            @if($med->id_medicament)
                {{ $med->nom_commercial }}
            @endif</h1>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>Quantité formuler</th>
                <th>Présentation</th>
                <th>Modifier</th>
                <th>Supprimer</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fiches as $form)
                <tr>
                    <td>{{$form->qte_formuler}}</td>
                    <td>{{$form->lib_presentation }}</td>
                    <td><a href="{{url('/editerFormulation/'.$form->id_medicament.'/'.$form->id_presentation)}}">
                    Modifier</a>
                    </td>
                    <td>
                        <a href="{{ route('supprimerFormulation', ['id_medicament' => $form->id_medicament, 'id_presentation' => $form->id_presentation]) }}"
                           class="text-danger"
                           onclick="return confirm('Supprimer cette formulation ?')">
                            <i class="glyphicon glyphicon-trash"></i> Supprimer
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <a href="{{ url('/ajouterFormulation/'.$med->id_medicament) }}" class="btn btn-primary">
                Ajouter
            </a>

            <button class="btn btn-primary"
                    onclick="if (confirm('Annuler la saisie ?')) window.location='{{ url('/listerMedicament') }}';">
                Retour
            </button>
        </div>
    </div>



@endsection
