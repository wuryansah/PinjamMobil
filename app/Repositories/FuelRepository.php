<?php

namespace App\Repositories;

use App\Models\FuelRecord;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class FuelRepository
{
    public function __construct(protected FuelRecord $model)
    {
    }

    public function paginated(Request $request): LengthAwarePaginator
    {
        $query = $this->model->with('vehicle', 'attachments');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('location', 'like', '%'.$request->search.'%')
                    ->orWhereHas('vehicle', function ($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->search.'%')
                            ->orWhere('plate_number', 'like', '%'.$request->search.'%');
                    });
            });
        }

        if ($request->vehicle_id) {
            $query->where('vehicle_id', $request->vehicle_id);
        }

        $query->orderBy('refuel_date', $request->sort === 'oldest' ? 'asc' : 'desc');

        return $query->paginate(15)->appends($request->query());
    }

    public function create(array $data): FuelRecord
    {
        return $this->model->create($data);
    }

    public function update(FuelRecord $fuelRecord, array $data): FuelRecord
    {
        $fuelRecord->update($data);

        return $fuelRecord->refresh();
    }

    public function delete(FuelRecord $fuelRecord): bool
    {
        return $fuelRecord->delete();
    }

    public function findById(int $id, $columns = ['*']): ?FuelRecord
    {
        return $this->model->find($id, $columns);
    }

    public function getLastRecordForVehicle(int $vehicleId): ?FuelRecord
    {
        return $this->model->where('vehicle_id', $vehicleId)
            ->orderBy('refuel_date', 'desc')
            ->first();
    }

    public function getTotalFuelAmount(): float
    {
        return $this->model->sum('fuel_amount');
    }

    public function getTotalFuelCost(): float
    {
        return $this->model->sum('fuel_cost');
    }

    public function filterByDateRange(?string $startDate = null, ?string $endDate = null, ?int $vehicleId = null): Collection
    {
        $query = $this->model->with('vehicle', 'attachments');

        if ($startDate) {
            $query->whereDate('refuel_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('refuel_date', '<=', $endDate);
        }

        if ($vehicleId) {
            $query->where('vehicle_id', $vehicleId);
        }

        return $query->orderBy('refuel_date', 'desc')->get();
    }

    public function getAverageFuelConsumption(): float
    {
        $records = $this->model->with('vehicle')->get()
            ->filter(fn ($r) => $r->fuel_consumption !== null);

        if ($records->isEmpty()) {
            return 0;
        }

        return round($records->avg('fuel_consumption'), 2);
    }
}
