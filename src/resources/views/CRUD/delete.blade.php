@extends('skeletor::layouts.main')
@section('content')
    @include('skeletor::partials.top-content')
    @php
        $name = (new \ReflectionClass($model))->getShortName();
    @endphp
    <div class="card card-main">
        <div class="card-header">
            <div class="layer"></div>
            <div class="row mt-2">
                <div class="col-auto mr-auto">
                    <h2 class="color-white mb-0">
                        <i class="fas fa-trash-alt mr-2"></i> Supprimer
                    </h2>
                </div>
                <div class="col-auto">
                    @if (Route::has($namePrefix . $routeBranch . '.index'))
                        <div class="float-md-right">
                            <a href="{{ route($namePrefix . $routeBranch . '.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-clipboard-list"></i> Retour à la liste
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <form method="POST" class="row" action="{{ route($namePrefix . $routeBranch . '.destroy', [strtolower($name) => $entity]) }}">
        @csrf
        @method("DELETE")
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <label>Confirmation de suppression</label>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-danger mr-2">
                            <i class="fas fa-trash-alt"></i> Oui, supprimer
                        </button>
                        @if (Route::has($namePrefix . $routeBranch . '.edit'))
                            <a href="{{ route($namePrefix . $routeBranch . '.edit', [strtolower($name) => $entity]) }}" title="modifier" class="btn btn-warning">
                                <i class="fas fa-pencil-alt"></i> Modifier
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection