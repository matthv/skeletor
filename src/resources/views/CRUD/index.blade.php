@extends('skeletor::layouts.main')
@section('content')
    @php
        $name = (new \ReflectionClass($model))->getShortName();
    @endphp
    @include('skeletor::partials.top-content')
    <div class="card card-main">
        <div class="card-header">
            <div class="layer"></div>
            <div class="row mt-2">
                <div class="col-auto mr-auto">
                    <h2 class="color-white mb-0">
                        <i class="fas fa-clipboard-list mr-2"></i> Liste
                    </h2>
                </div>
                <div class="col-auto">
                    @if (Route::has($namePrefix . $routeBranch . '.create'))
                        <div class="float-md-right">
                            <a href="{{ route($namePrefix . $routeBranch . '.create') }}" class="btn btn-outline-primary">
                                <i class="fas fa-plus-circle"></i> Ajouter
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('skeletor::CRUD.filters')
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>N°</th>
                        @foreach ($listFields as $field => $value)
                            <th>{{ ucfirst($value) }}</th>
                        @endforeach
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @if (count($entities) > 0)
                    @foreach ($entities as $entity)
                        <tr>
                            <td>{{ $loop->iteration + (($entities->currentPage() - 1) * $entities->perPage()) }}</td>
                            @foreach ($listFields as $field => $value)
                                @if (data_get($entity, $field) === true || data_get($entity, $field) === false)
                                    <td>{!! '<span class="badge badge-' . (data_get($entity, $field) === true ? "success" : "danger") . '" style="min-width:22px;"><i class="fas fa-' . (data_get($entity, $field) === true ? "check" : "times") . '"></i></span>' !!}</td>
                                @else
                                    <td>{!! data_get($entity, $field) !!}</td>
                                @endif
                            @endforeach
                            <td class="actions">
                                @if (Route::has($namePrefix . $routeBranch . '.show'))
                                    <a href="{{ route($namePrefix . $routeBranch . '.show', [strtolower($name) => $entity]) }}" title="voir" class="btn btn-action btn-info mr-2">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                @endif
                                @if (Route::has($namePrefix . $routeBranch . '.edit'))
                                    <a href="{{ route($namePrefix . $routeBranch . '.edit', [strtolower($name) => $entity]) }}" title="modifier" class="btn btn-action btn-warning mr-2">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                @endif
                                @if (Route::has($namePrefix . $routeBranch . '.delete'))
                                    <a href="{{ route($namePrefix . $routeBranch . '.delete', [strtolower($name) => $entity]) }}" title="supprimer" class="btn btn-action btn-danger mr-2">
                                        <i class="fas fa-times"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">
                            <div class="alert alert-info mb-0" role="alert">
                                Pas de résultat
                            </div>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
            <div class="float-right">
                {{ $entities->links() }}
            </div>
        </div>
    </div>
    @include('skeletor::CRUD.form-destroy-object')
@endsection