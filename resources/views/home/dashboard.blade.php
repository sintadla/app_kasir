@extends("layouts.main", ['title' => 'Dashboard'])

@section('content')
    @can('admin')
        @include('home.admin')
    @elsecan('manajer')
        @include('home.manajer')
    @else
        @include('home.kasir')
    @endcan
    {{-- <x-content>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Card title</h5>
                    </div>
                    <div class="card-body">
                        Text Page Content
                    </div>
                </div>
            </div>
        </div>
    </x-content> --}}
@endsection
