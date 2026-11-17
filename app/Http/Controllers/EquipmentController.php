<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EquipmentController extends Controller
{
    // Server-side rules shared by store() and update()
    private function rules(): array
    {
        return [
            'equipment_name' => ['required', 'string', 'max:255'],
            'category' => ['required', Rule::in(Equipment::CATEGORIES)],       // only defined categories
            'unit_price' => ['required', 'numeric', 'min:0'],                   // rejects text and negatives
            'description' => ['required', 'string'],
            'availability_status' => ['required', Rule::in(array_keys(Equipment::STATUSES))],
        ];
    }

    // List all equipment, newest first
    public function index()
    {
        $items = Equipment::with('user')->latest()->paginate(10);
        return view('equipment.index', compact('items'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules());

        // Business logic: user_id is set on the server from the logged-in user, never from the form
        $request->user()->equipment()->create($data);

        return redirect()->route('equipment.index')->with('success', 'Equipment added successfully.');
    }

    public function show(Equipment $equipment)
    {
        return view('equipment.show', compact('equipment'));
    }

    public function edit(Equipment $equipment)
    {
        return view('equipment.edit', compact('equipment'));
    }

    public function update(Request $request, Equipment $equipment)
    {
        $equipment->update($request->validate($this->rules()));

        return redirect()->route('equipment.index')->with('success', 'Equipment updated successfully.');
    }

    public function destroy(Equipment $equipment)
    {
        $equipment->delete();

        return redirect()->route('equipment.index')->with('success', 'Equipment deleted successfully.');
    }
}