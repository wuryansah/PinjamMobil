<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fuel Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { margin: 0; font-size: 24px; }
        .header p { margin: 5px 0; color: #666; }
        .summary { display: flex; justify-content: space-around; margin-bottom: 20px; padding: 10px; background: #f5f5f5; }
        .summary-item { text-align: center; }
        .summary-item .label { font-size: 10px; color: #666; }
        .summary-item .value { font-size: 18px; font-weight: bold; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #f5f5f5; font-weight: bold; font-size: 11px; }
        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚗 PinjamMobil</h1>
        <p>Fuel Report</p>
        <p>Period: {{ $request->start_date ?? 'All' }} to {{ $request->end_date ?? 'All' }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Refuels</div>
            <div class="value">{{ $fuelRecords->count() }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Fuel</div>
            <div class="value">{{ number_format($totalFuelAmount, 2) }} L</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Cost</div>
            <div class="value">Rp {{ number_format($totalFuelCost, 0, ',', '.') }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Avg Consumption</div>
            <div class="value">{{ $avgConsumption ? number_format($avgConsumption, 2) : '-' }} km/L</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Vehicle</th>
                <th>KM</th>
                <th>Fuel Amount</th>
                <th>Cost</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fuelRecords as $record)
            <tr>
                <td>{{ $record->id }}</td>
                <td>{{ $record->refuel_date->format('d/m/Y') }}</td>
                <td>{{ $record->vehicle->name ?? '-' }}</td>
                <td>{{ number_format($record->kilometer, 2) }}</td>
                <td>{{ number_format($record->fuel_amount, 2) }} L</td>
                <td>Rp {{ number_format($record->calculated_fuel_cost ?? $record->fuel_cost, 0, ',', '.') }}</td>
                <td>{{ $record->location ?: '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }} - PinjamMobil Vehicle Management System
    </div>
</body>
</html>