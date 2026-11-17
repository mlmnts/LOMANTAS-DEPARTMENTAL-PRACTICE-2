<?php

namespace App\Http\Controllers;

use App\Exports\EquipmentExport;
use App\Models\Equipment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public const TYPES = [
        'available' => 'Available Equipment',
        'unavailable' => 'Unavailable Equipment',
        'by_category' => 'Equipment by Category',
        'price_list' => 'Equipment Price List',
    ];

    private function buildReport(Request $request): array
    {
        $filters = $request->validate([
            'type' => ['nullable', Rule::in(array_keys(self::TYPES))],
            'category' => ['nullable', Rule::in(Equipment::CATEGORIES)],
            'availability_status' => ['nullable', Rule::in(array_keys(Equipment::STATUSES))],
        ]);

        $type = $filters['type'] ?? 'price_list';
        $query = Equipment::with('user');

        if ($type === 'available' || $type === 'unavailable') {
            $query->where('availability_status', $type);
        }

        $query->filter($filters);

        $type === 'by_category'
            ? $query->orderBy('category')->orderBy('equipment_name')
            : $query->orderBy('equipment_name');

        return [
            'items' => $query->get(),
            'title' => self::TYPES[$type],
            'type' => $type,
            'filters' => $filters,
        ];
    }

    public function index(Request $request)
    {
        return view('reports.index', $this->buildReport($request) + ['types' => self::TYPES]);
    }

    public function pdf(Request $request)
    {
        return Pdf::loadView('reports.pdf', $this->buildReport($request))->download('equipment-report.pdf');
    }

    public function excel(Request $request)
    {
        $report = $this->buildReport($request);

        return Excel::download(new EquipmentExport($report['items']), 'equipment-report.xlsx');
    }
}