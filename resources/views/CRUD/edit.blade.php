@extends('skeletor::layouts.main')
@section('content')
    @include('skeletor::partials.top-content')
    <div class="card card-main">
        <div class="card-header">
            <div class="layer"></div>
            <div class="row mt-2">
                <div class="col-auto mr-auto">
                    <h2 class="color-white mb-0">
                        <i class="fas fa-pencil-alt mr-2"></i> Editer
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
    @include('skeletor::CRUD.form')
@endsection