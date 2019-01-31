@extends('skeletor::layouts.main')
@section('content')
    @include('skeletor::partials.top-content')
    @php
        $name = (new \ReflectionClass(get_class($entity)))->getShortName();
    @endphp
    <div class="card card-main">
        <div class="card-header">
            <div class="layer"></div>
            <div class="row mt-2">
                <div class="col-auto mr-auto">
                    <h2 class="color-white mb-0">
                        <i class="fas fa-eye mr-2"></i> Voir
                    </h2>
                </div>
                <div class="col-auto">
                    @if (Route::has($namePrefix . $routeBranch . '.edit'))
                        <div class="float-md-right">
                            <a href="{{ route($namePrefix . $routeBranch . '.edit', [strtolower($name) => $entity]) }}" title="modifier" class="btn btn-outline-primary">
                                <i class="fas fa-pencil-alt"></i> Modifier
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-bordered table-light">
                @if (count($showFields) > 0)
                    @foreach ($showFields as $field => $label)
                        <tr>
                            <td><strong>{{ $label }}</strong></td>
                            @if (data_get($entity, $field) === true || data_get($entity, $field) === false)
                                <td>{!! '<span class="badge badge-' . (data_get($entity, $field) === true ? "success" : "danger") . '" style="min-width:22px;"><i class="fas fa-' . (data_get($entity, $field) === true ? "check" : "times") . '"></i></span>' !!}</td>
                            @else
                                <td>{!! data_get($entity, $field) !!}</td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    @foreach($entity->getAttributes() as $key => $value)
                        <tr>
                            <th>{{ (__('validation.attributes.' . preg_replace('`(.*)_id$`i', '$1', $key))) }}</th>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
    </div>
@endsection