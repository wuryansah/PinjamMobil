<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Vehicle Usage Report</title>
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
        .status { padding: 2px 6px; border-radius: 4px; font-size: 10px; }
        .status-completed { background: #d4edda; color: #155724; }
        .footer { margin-top: 20px; text-align: center; font-size: 10px; color: #666; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚗 PinjamMobil</h1>
        <p>Vehicle Usage Report</p>
        <p>Period: {{ $request->start_date ?? 'All' }} to {{ $request->end_date ?? 'All' }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="label">Total Trips</div>
            <div class="value">{{ $requests->count() }}</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Mileage</div>
            <div class="value">{{ number_format($totalMileage, 2) }} km</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Fuel</div>
            <div class="value">{{ number_format($totalFuel, 2) }} L</div>
        </div>
        <div class="summary-item">
            <div class="label">Total Cost</div>
            <div class="value">Rp {{ number_format($totalCost, 0, ',', '.') }}</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>Employee</th>
                <th>Department</th>
                <th>Vehicle</th>
                <th>Destination</th>
                <th>Start KM</th>
                <th>End KM</th>
                <th>Distance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->id }}</td>
                <td>{{ $req->start_datetime->format('d/m/Y') }}</td>
                <td>{{ $req->usageRecord && $req->usageRecord->start_time ? \Carbon\Carbon::parse($req->usageRecord->start_time)->format('H:i') : '-' }}</td>
                <td>{{ $req->usageRecord && $req->usageRecord->end_time ? \Carbon\Carbon::parse($req->usageRecord->end_time)->format('H:i') : '-' }}</td>
                <td>{{ $req->borrower->name ?? '-' }}</td>
                <td>{{ $req->borrower->department ?: '-' }}</td>
                <td>{{ $req->vehicle->name ?? '-' }}</td>
                <td>{{ $req->destination }}</td>
                <td>{{ $req->usageRecord ? number_format($req->usageRecord->start_km, 2) : '-' }}</td>
                <td>{{ $req->usageRecord ? number_format($req->usageRecord->end_km, 2) : '-' }}</td>
                <td>{{ $req->usageRecord ? number_format($req->usageRecord->end_km - $req->usageRecord->start_km, 2) : '-' }} km</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Generated on {{ now()->format('Y-m-d H:i:s') }} - PinjamMobil Vehicle Management System
    </div>
</body>
</html>