@extends('layouts.master')
@section('content')
    <div>
        <h1>Liste des formulations</h1>
    </div>

    <div class="container mt-4">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
            <tr>
                <th>Famille</th>
                <th>Nom commercial</th>
                <th>Quantité formuler</th>
                <th>Présentation</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($fiches as $form)
                <tr>
                    <td>{{$form->lib_famille}}</td>
                    <td>{{$form->nom_commercial}}</td>
                    <td>{{$form->qte_formuler}}</td>
                    <td>{{$form->lib_presentation }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>



@endsection
