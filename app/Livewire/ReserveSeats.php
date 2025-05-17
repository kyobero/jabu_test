<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Seat;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ReserveSeats extends Component
{
    use WithPagination;

    public $search = '';
    public $filterUser = '';
    public $filterEvent = '';
    public $seatId, $user_id, $event_id, $seat_map;
    public $isEdit = false;

    protected $rules = [
        'user_id' => 'nullable|exists:users,id',
        'event_id' => 'required|exists:events,id',
        'seat_map' => 'required',
    ];

    public function render()
    {
        $query = Seat::with(['user', 'event']);

        if ($this->search) {
            $query->where('seat_map', 'like', "%$this->search%");
        }

        if ($this->filterUser) {
            $query->where('user_id', $this->filterUser);
        }

        if ($this->filterEvent) {
            $query->where('event_id', $this->filterEvent);
        }

        return view('livewire.reserve-seats', [
            'seats' => $query->paginate(10),
            'users' => User::all(),
            'events' => Event::all(),
        ]);
    }

    public function store()
    {
        $this->validate();

        Seat::create([
            'user_id' => $this->user_id,
            'event_id' => $this->event_id,
            'seat_map' => $this->seat_map,
        ]);

        $this->resetForm();
    }

    public function edit($id)
    {
        $seat = Seat::findOrFail($id);
        $this->seatId = $id;
        $this->user_id = $seat->user_id;
        $this->event_id = $seat->event_id;
        $this->seat_map = $seat->seat_map;
        $this->isEdit = true;
    }

    public function update()
    {
        $this->validate();

        $seat = Seat::findOrFail($this->seatId);
        $seat->update([
            'user_id' => $this->user_id,
            'event_id' => $this->event_id,
            'seat_map' => $this->seat_map,
        ]);

        $this->resetForm();
    }

    public function delete($id)
    {
        Seat::findOrFail($id)->delete();
    }

    public function resetForm()
    {
        $this->reset(['seatId', 'user_id', 'event_id', 'seat_map', 'isEdit']);
    }


}
