@extends('layouts.master')
@section('content')
    <div>
        <h1>Frais Hors Forfait de la fiche :
            @if($frais->id_frais)
                {{ $frais->anneemois }}
            @endif
        </h1>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Libellé</th>
                <th>Montant</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($listeHF as $fraisHF)
                <tr>
                    <td>{{ $fraisHF->date_fraishorsforfait }}</td>
                    <td>{{ $fraisHF->lib_fraishorsforfait }}</td>
                    <td>{{ number_format($fraisHF->montant_fraishorsforfait, 2) }}</td>
                    <td>
                        <a href="{{ url('/editFraisHF/'.$fraisHF->id_fraishorsforfait) }}">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </td>
                    <td>
                        <a href="{{ url('/supprimerFraisHF/'.$fraisHF->id_fraishorsforfait) }}" id="suppr" onclick="return confirm('Supprimer cette fiche de frais ?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach

            <tr>
                <td colspan="2" class="text-end fw-bold">Montant total</td>
                <td class="fw-bold">{{ number_format($totalHF, 2) }}</td>
                <td colspan="2"></td>
            </tr>
            </tbody>
        </table>

        <div class="form-group">
            <div class="col-md-12 col-md-offset3">
                <button type="submit" class="btn btn-info"  >
                    <a href="{{route('addFraisHF', $frais->id_frais)}}">Ajouter</a>
                </button>
                <button type="button" class="btn btn-secondary" onclick="if (confirm('Annuler la saisie ?'))window.location='{{url('/')}}';">
                    Retour
                </button>
            </div>
        </div>


    </div>
@endsection
