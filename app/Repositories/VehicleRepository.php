<?php

namespace App\Repositories;

use App\Models\Vehicle;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class VehicleRepository
{
    public function __construct(protected Vehicle $model)
    {
    }

    public function paginated(Request $request): LengthAwarePaginator
    {
        $query = $this->model->with('driver');

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                    ->orWhere('plate_number', 'like', '%'.$request->search.'%')
                    ->orWhere('type', 'like', '%'.$request->search.'%');
            });
        }

        $query->orderBy('created_at', $request->sort === 'oldest' ? 'asc' : 'desc');

        return $query->paginate(15)->appends($request->query());
    }

    public function allAvailable(): Collection
    {
        return $this->model->where('availability', 'available')
            ->where('condition', 'good')
            ->get();
    }

    public function findByPlateNumber(string $plateNumber, $columns = ['*']): ?Vehicle
    {
        return $this->model->where('plate_number', $plateNumber)->first($columns);
    }

    public function create(array $data): Vehicle
    {
        return $this->model->create($data);
    }

    public function update(Vehicle $vehicle, array $data): Vehicle
    {
        $vehicle->update($data);

        return $vehicle->refresh();
    }

    public function delete(Vehicle $vehicle): bool
    {
        return $vehicle->delete();
    }

    public function findById(int $id, $columns = ['*']): ?Vehicle
    {
        return $this->model->find($id, $columns);
    }

    public function getAvailableVehicles(): Collection
    {
        return $this->model->where('availability', 'available')
            ->where('condition', 'good')
            ->get();
    }

    public function getDrivers(): Collection
    {
        return \App\Models\User::where('role', 'driver')->get();
    }
}
