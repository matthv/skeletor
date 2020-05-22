@extends('skeletor::layouts.main')
@section('content')
    <div class="card card-main">
        <div class="card-header">
            <div class="layer"></div>
            <div class="row mt-2">
                <div class="col-auto mr-auto">
                    <h2 class="color-white mb-0">
                        <i class="fas fa-user mr-2"></i> {{ __('skeletor::skeletor.profil') }}
                    </h2>
                </div>
                <div class="col-auto">
                    <div class="float-md-right">
                        <a href="{{ route('skeletor.admin.dashboard') }}" class="btn btn-outline-primary">
                            <i class="fas fa-desktop"></i> {{ __('skeletor::skeletor.dashboard') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('skeletor::CRUD.form')
@endsection