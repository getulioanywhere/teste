@extends('velho.layouts.app')

@section('content')
    
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0 text-dark">Página - consentimento</h1>
                
                <div class="d-flex justify-content-end align-items-center flex-wrap gap-1">
                    @include('velho.components.links.list')
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid pb-3">
            {{-- @include('flash::message') --}}

            <div class="card">
                <form data-ajax action="{{ route($wildcard . '.update', $model->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card-body px-2 py-0">
                        @include("$module::$wildcard.form")
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success offset-md-3">Salvar</button>
                        <a data-ajax href="{{ route($wildcard . '.index') }}" class="btn btn-link">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
