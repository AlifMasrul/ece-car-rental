@extends('layouts.admin2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Car') }}</div>

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

                    <form method="POST" action="{{ route('admin.cars.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="model" class="form-label">{{ __('Model') }}</label>
                            <input type="text" class="form-control" id="model" name="model" required>
                        </div>

                        <div class="mb-3">
                            <label for="year" class="form-label">{{ __('Year') }}</label>
                            <input type="number" class="form-control" id="year" name="year" required>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('Price per day') }}</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                        </div>

                        <div class="mb-3">
                            <label for="plate_number" class="form-label">{{ __('Plate Number') }}</label>
                            <input type="text" class="form-control" id="plate_number" name="plate_number" required>
                        </div>

                        <div class="mb-3">
                            <label for="transmission" class="form-label">{{ __('Transmission') }}</label>
                            <select class="form-control" id="transmission" name="transmission" required>
                                <option value="">{{ __('Select Transmission') }}</option>
                                <option value="automatic">{{ __('Automatic') }}</option>
                                <option value="manual">{{ __('Manual') }}</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">{{ __('Type') }}</label>
                            <input type="text" class="form-control" id="type" name="type" required>
                        </div>

                        <div class="mb-3">
                            <label for="brand" class="form-label">{{ __('Brand') }}</label>
                            <input type="text" class="form-control" id="brand" name="brand" required>
                        </div>

                        <div class="mb-3">
                            <label for="branch_id" class="form-label">{{ __('Branch') }}</label>
                            <select class="form-control" id="branch_id" name="branch_id" required>
                                <option value="">{{ __('Select Branch') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">{{ __('Add Car') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection