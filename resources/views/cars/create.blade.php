@extends('layouts.app') // Assuming you have a layout file

@section('content')
    <div class="container">
        <h1>Register New Car</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('cars.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="plate_number">Plate Number:</label>
                <input type="text" name="plate_number" id="plate_number" class="form-control" required value="{{ old('plate_number') }}">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" name="type" id="type" class="form-control" required value="{{ old('type') }}">
            </div>
            <div class="form-group">
                <label for="transmission">Transmission:</label>
                <input type="text" name="transmission" id="transmission" class="form-control" required value="{{ old('transmission') }}">
            </div>
            <div class="form-group">
                <label for="brand">Brand:</label>
                <input type="text" name="brand" id="brand" class="form-control" required value="{{ old('brand') }}">
            </div>
             <div class="form-group">
                <label for="model">Model:</label>
                <input type="text" name="model" id="model" class="form-control" required value="{{ old('model') }}">
            </div>
            <div class="form-group">
                <label for="branch_id">Branch:</label>
                <select name="branch_id" id="branch_id" class="form-control" required>
                    <option value="">Select Branch</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Car</button>
        </form>
    </div>
@endsection