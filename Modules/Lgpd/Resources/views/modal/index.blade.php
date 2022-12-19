@extends('velho.layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h1 class="m-0 text-dark">Modal - consentimentos</h1>
                </div>
                <div class="col d-flex justify-content-end">
                    <a href="{{route("lgpd.index")}}" class="btn btn-secondary">Voltar</a>
                </div>
            </div>
        </div> 
    </div>

    <div class="content">
        <div class="container-fluid pb-3">
            <div class="card">
                <div class="card-body p-0">
                    <table class="datatable table table-hover table-striped table-md">
                        <thead>
                            <tr>
                                <th class="desktop">TITULO</th>
                                <th class="desktop">LOCALE</th>
                                <th class="desktop">ACTIVE</th>
                                <th class="desktop">AÇÕES</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($modals as $record)
                                <tr>
                                    <td>{{ $record->title }}</td>
                                    <td>{{ $record->locale }}</td>
                                    <td>{{ $record->active }}</td>
                                    <td class="actions">
                                        @include('velho.components.links.edit')
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
