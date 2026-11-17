<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { color: #0d6efd; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px; text-align: left; }
        th { background: #e7f1ff; }
    </style>
</head>
<body>
    <h2>{{ $title }}</h2>
    <p>
        Category: {{ $filters['category'] ?? 'All' }} |
        Availability: {{ isset($filters['availability_status']) ? ucfirst($filters['availability_status']) : 'All' }}<br>
        Generated: {{ now()->format('M d, Y h:i A') }} | Records: {{ $items->count() }}
    </p>
    <table>
        <thead><tr><th>Name</th><th>Category</th><th>Price</th><th>Availability</th></tr></thead>
        <tbody>
        @forelse ($items as $item)
            <tr>
                <td>{{ $item->equipment_name }}</td>
                <td>{{ $item->category }}</td>
                <td>₱{{ number_format($item->unit_price, 2) }}</td>
                <td>{{ ucfirst($item->availability_status) }}</td>
            </tr>
        @empty
            <tr><td colspan="4">No equipment records match the selected filters.</td></tr>
        @endforelse
        </tbody>
    </table>
</body>
</html>