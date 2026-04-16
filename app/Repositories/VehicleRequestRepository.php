<?php

namespace App\Repositories;

use App\Models\VehicleRequest;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleRequestRepository
{
    public function __construct(protected VehicleRequest $model)
    {
    }

    public function paginated(Request $request): LengthAwarePaginator
    {
        $user = Auth::user();
        $query = $this->model->with('borrower', 'vehicle', 'driver');

        match ($user->role) {
            'admin' => null,
            'manager' => $query->where(function ($q) use ($user) {
                $subordinateIds = $user->subordinates()->pluck('id');
                $q->where('borrower_id', $user->id)
                    ->orWhereIn('borrower_id', $subordinateIds);
            }),
            'driver' => $query->where('driver_id', $user->id),
            default => $query->where('borrower_id', $user->id)->with('vehicle', 'driver'),
        };

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('destination', 'like', '%'.$request->search.'%')
                    ->orWhereHas('borrower', function ($q) use ($request) {
                        $q->where('name', 'like', '%'.$request->search.'%');
                    });
            });
        }

        $query->orderBy('created_at', $request->sort === 'oldest' ? 'asc' : 'desc');

        return $query->paginate(15)->appends($request->query());
    }

    public function findById(int $id, $columns = ['*']): ?VehicleRequest
    {
        return $this->model->find($id, $columns);
    }

    public function create(array $data): VehicleRequest
    {
        return $this->model->create($data);
    }

    public function update(VehicleRequest $request, array $data): VehicleRequest
    {
        $request->update($data);

        return $request->refresh();
    }

    public function delete(VehicleRequest $request): bool
    {
        return $request->delete();
    }

    public function findByStatus(string $status): Collection
    {
        return $this->model->where('status', $status)
            ->with('borrower', 'vehicle', 'driver')
            ->get();
    }

    public function findByBorrower(int $borrowerId): Collection
    {
        return $this->model->where('borrower_id', $borrowerId)
            ->with('vehicle', 'driver')
            ->get();
    }

    public function findByDriver(int $driverId): Collection
    {
        return $this->model->where('driver_id', $driverId)
            ->with('borrower', 'vehicle')
            ->get();
    }

    public function getCompletedTrips(): Collection
    {
        return $this->model->with('borrower', 'vehicle', 'driver', 'usageRecord')
            ->where('status', 'completed')
            ->orderBy('end_datetime', 'desc')
            ->get();
    }

    public function getTodayTrips(): int
    {
        return $this->model->whereDate('start_datetime', now()->toDateString())->count();
    }

    public function getPendingCount(): int
    {
        return $this->model->where('status', 'pending')->count();
    }

    public function getCompletedCount(): int
    {
        return $this->model->where('status', 'completed')->count();
    }

    public function filterByDateRange(?string $startDate = null, ?string $endDate = null, ?int $vehicleId = null): Collection
    {
        $query = $this->model->with('borrower', 'vehicle', 'driver', 'usageRecord')
            ->where('status', 'completed');

        if ($startDate) {
            $query->whereDate('start_datetime', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('end_datetime', '<=', $endDate);
        }

        if ($vehicleId) {
            $query->where('vehicle_id', $vehicleId);
        }

        return $query->orderBy('end_datetime', 'desc')->get();
    }
}
