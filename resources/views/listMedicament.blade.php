@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des Médicaments</h1>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>Famille</th>
                <th>Dépot légal</th>
                <th>Nom commercial</th>
                <th>Effets</th>
                <th>Contre indication</th>
                <th>Prix échantillon</th>
                <th>Formulation</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fiches as $med)
                <tr>
                    <td>{{$med->lib_famille}}</td>
                    <td>{{ $med->depot_legal }}</td>
                    <td>{{$med->nom_commercial}}</td>
                    <td>{{$med->effets}}</td>
                    <td>{{ $med->contre_indication }}</td>
                    <td>{{ $med->prix_echantillon }} €</td>
                    <td><a href="{{url('/listerFormulation/'.$med->id_medicament)}}">Voir plus</a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection
