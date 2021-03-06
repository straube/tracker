@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="mb-4">
            <button class="btn btn-primary" data-toggle="modal" data-target="#create-activity">{{ __('New activity') }}</button>
        </div>

        <h2 class="pt-4 mb-4">{{ __('Activities') }}</h2>

        @if (count($activities) === 0)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ __('No activity types created yet') }}</h5>
                    <p class="card-text">
                        {!! __('Go ahead and <a :attributes >create the first activity type</a>. Some examples are <strong>Design</strong>, <strong>Programming</strong>, or <strong>Business Development</strong>.', [ 'attributes' => 'href="javascript:return false" data-toggle="modal" data-target="#create-activity"' ]) !!}
                    </p>
                </div>
            </div>
        @else
            <div class="card-columns">
                @foreach ($activities as $activity)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $activity->name }}</h5>
                            <a class="card-link" href="#" @click.prevent="$emit('activity-edit',{{ json_encode($activity->attributesToArray()) }})">
                                {{ __('Edit') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@push('modals')
    <create-activity></create-activity>
    <edit-activity></edit-activity>
@endpush
