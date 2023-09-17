<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\StoreHouse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class OrderStoreHousesDetail extends Component
{
    use AuthorizesRequests;

    public Order $order;
    public StoreHouse $storeHouse;
    public $storeHousesForSelect = [];
    public $store_house_id = null;

    public $showingModal = false;
    public $modalTitle = 'New StoreHouse';

    protected $rules = [
        'store_house_id' => ['required', 'exists:store_houses,id'],
    ];

    public function mount(Order $order): void
    {
        $this->order = $order;
        $this->storeHousesForSelect = StoreHouse::pluck('name', 'id');
        $this->resetStoreHouseData();
    }

    public function resetStoreHouseData(): void
    {
        $this->storeHouse = new StoreHouse();

        $this->store_house_id = null;

        $this->dispatchBrowserEvent('refresh');
    }

    public function newStoreHouse(): void
    {
        $this->modalTitle = trans('crud.order_store_houses.new_title');
        $this->resetStoreHouseData();

        $this->showModal();
    }

    public function showModal(): void
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal(): void
    {
        $this->showingModal = false;
    }

    public function save(): void
    {
        $this->validate();

        $this->authorize('create', StoreHouse::class);

        $this->order->storeHouses()->attach($this->storeHouse_id, []);

        $this->hideModal();
    }

    public function detach($storeHouse): void
    {
        $this->authorize('delete-any', StoreHouse::class);

        $this->order->storeHouses()->detach($storeHouse);

        $this->resetStoreHouseData();
    }

    public function render(): View
    {
        return view('livewire.order-store-houses-detail', [
            'orderStoreHouses' => $this->order
                ->storeHouses()
                ->withPivot([])
                ->paginate(20),
        ]);
    }
}
