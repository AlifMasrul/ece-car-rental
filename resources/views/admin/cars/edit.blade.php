@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Car') }}</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('admin.cars.update', $car->id) }}">
                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                            <label for="model" class="form-label">{{ __('Model') }}</label>
                            <input type="text" class="form-control" id="model" name="model" value="{{ $car->model }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">{{ __('Year') }}</label>
                            <input type="number" class="form-control" id="year" name="year" value="{{ $car->year }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('Price per day') }}</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ $car->price }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="plate_number" class="form-label">{{ __('Plate Number') }}</label>
                            <input type="text" class="form-control" id="plate_number" name="plate_number" value="{{ $car->plate_number }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="transmission" class="form-label">{{ __('Transmission') }}</label>
                            <select class="form-control" id="transmission" name="transmission" required>
                                <option value="automatic" {{ $car->transmission === 'automatic' ? 'selected' : '' }}>Automatic</option>
                                <option value="manual" {{ $car->transmission === 'manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('Type') }}</label>
                            <input type="text" class="form-control" id="type" name="type" value="{{ $car->type }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">{{ __('Brand') }}</label>
                            <input type="text" class="form-control" id="brand" name="brand" value="{{ $car->brand }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Update Car') }}</button>
                        <a href="{{ route('cars.index') }}" class="btn btn-secondary">{{ __('Cancel') }}</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection