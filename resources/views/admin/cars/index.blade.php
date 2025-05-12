@extends('layouts.admin2')

@section('content')
<div class="container">
    <h1>All Cars</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Model</th>
                <th>Year</th>
                <th>Price per day</th>
                <th>Transmission</th>
                <th>Brand</th>
                <th>Plate Number</th>
                <th>Type</th>
                <th>Branch</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    @foreach ($cars as $car)
    <tr>
        <td>{{ $car->model }}</td>
        <td>{{ $car->year }}</td>
        <td>RM {{ number_format($car->price, 2) }}</td>
        <td>{{ ucfirst($car->transmission) }}</td> {{-- Capitalize the first letter --}}
        <td>{{ $car->brand }}</td>
        <td>{{ $car->plate_number }}</td>
        <td>{{ $car->type }}</td>
        <td>{{ $car->branch->name ?? 'N/A' }}</td>
        <td>
            <a href="{{ route('admin.cars.edit', $car->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <form action="{{ route('admin.cars.destroy', $car->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>

    <a href="{{ route('admin.cars.create') }}" class="btn btn-success">Add New Car</a>
</div>
@endsection