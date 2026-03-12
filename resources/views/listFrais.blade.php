@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des fiches de frais</h1>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>Mois</th>
                <th>Titre</th>
                <th>Modification</th>
                <th>Montant saisi</th>
                <th>Nb justificatifs</th>
                <th>Montant validé</th>
                <th>État</th>
                <th>Modifier</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fiches as $frais)
                <tr>
                    <td>{{ $frais->anneemois }}</td>
                    <td>{{$frais->titre}}</td>
                    <td>{{$frais->datemodification}}</td>
                    <td>  </td>
                    <td>{{ $frais->nbjustificatifs }}</td>
                    <td>{{ $frais->montantvalide }} €</td>
                    <td>{{ $frais->id_etat }}</td>
                    <td><a href="{{url('/editerFrais/'.$frais->id_frais)}}">Modifier</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection
