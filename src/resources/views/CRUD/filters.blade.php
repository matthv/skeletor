@if (count($filters) > 0)
<form method="GET" action="{{ route($namePrefix . $routeBranch . '.index') }}" class="card-filters px-4 py-3">
    <div class="row">
        @foreach($filters as $filter)
            <div class="col-sm-3">
                <label>{{ $filter->options['label'] }}</label>
            @if ($filter->name == 'search')
                <input type="text" name="{{ $filter->name }}" class="form-control" placeholder="{{ $filter->options['placeholder'] }}" value="{{ $filter->value }}">
            @else
                <select name="{{ $filter->name }}" class="form-control">
                    <option value="">Tous</option>
                    @foreach($filter->choices as $key => $value)
                        <option value="{{ $key }}" @if(!is_null($filter->value) && $filter->value == $key) selected @endif>
                            {{ $value }}
                        </option>
                    @endforeach
                </select>
            @endif
            </div>
        @endforeach
        <div class="col-sm-3 d-flex align-items-end">
            <button class="btn btn-primary btn-block">
                <i class="fas fa-filter"></i> Filtrer
            </button>
            @if ($filters->active)
                <a href="{{ route($namePrefix . $routeBranch . '.index') }}" class="btn btn-outline-primary ml-2" title="annuler les filtres">
                    <i class="fas fa-times"></i>
                </a>
            @endif
        </div>
    </div>
</form>
@endif