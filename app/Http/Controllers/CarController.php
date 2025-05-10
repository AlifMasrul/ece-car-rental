<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Branch; // Import the Branch model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function adminCreate()
    {
        $branches = Branch::all();
        return view('admin.cars.create', compact('branches'));
    }
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
        $cars = Car::with('branch');
        $branches = Branch::all();

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
            $cars->where('brand', 'like', '%' . $request->brand . '%');
        }

        $cars = $cars->get();

        if (Auth::check() && Auth::user()->is_admin == 1) {
            return view('admin.cars.index', compact('cars', 'branches'));
        }

        return view('cars.index', compact('cars', 'branches'));
    }
    public function adminEdit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    public function adminUpdate(Request $request, Car $car)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'plate_number' => 'required|string|max:255',
            'transmission' => 'required|string|in:automatic,manual',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
        ]);

        $car->year = $request->year;
        $car->price = $request->price;
        $car->model = $request->model;
        $car->plate_number = $request->plate_number;
        $car->transmission = $request->transmission;
        $car->type = $request->type;
        $car->brand = $request->brand;
        $car->save();

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully!');
    }
    public function adminStore(Request $request)
    {
        $request->validate([
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'price' => 'required|numeric|min:0',
            'plate_number' => 'required|string|max:255|unique:cars',
            'transmission' => 'required|string|in:automatic,manual',
            'type' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
        ]);

        Car::create($request->all());

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully!');
    }

    public function adminDestroy(Car $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully!');
    }
}
