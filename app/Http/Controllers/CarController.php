<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Branch; // Import the Branch model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        $branches = Branch::all(); // Fetch branches for the dropdown
        return view('cars.create', compact('branches')); // Pass branches to the view
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'plate_number' => 'required|unique:cars',
            'type' => 'required',
            'transmission' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'branch_id' => 'required|exists:branches,id', // Ensure branch_id exists
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Car::create($request->all());

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    /**
     * Display a listing of the cars.
     */
    public function index(Request $request)
{
    $cars = Car::with('branch'); // Start with all cars and eager load the branch
    $branches = Branch::all(); // Fetch all branches for the dropdown

    // Filtering logic
    if ($request->filled('branch_id')) {
        $cars->where('branch_id', $request->branch_id);
    }

    if ($request->filled('type')) {
        $cars->where('type', $request->type);
    }

    if ($request->filled('transmission')) {
        $cars->where('transmission', $request->transmission);
    }

    if ($request->filled('brand')) {
        $cars->where('brand', 'like', '%' . $request->brand . '%'); // Use 'like' for partial match
    }

    $cars = $cars->get(); // Execute the query

    return view('cars.index', compact('cars', 'branches'));
}
}
