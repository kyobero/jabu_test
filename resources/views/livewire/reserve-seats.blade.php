<div>
    <div class="mb-4 flex space-x-2">
        <input type="text" wire:model="search" placeholder="Search seat map" class="input">
        <select wire:model="filterUser" class="select">
            <option value="">All Users</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <select wire:model="filterEvent" class="select">
            <option value="">All Events</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
    </div>

    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="space-y-2">
        <select wire:model="user_id" class="select">
            <option value="">Unassigned</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <select wire:model="event_id" class="select">
            <option value="">Select Event</option>
            @foreach ($events as $event)
                <option value="{{ $event->id }}">{{ $event->name }}</option>
            @endforeach
        </select>
        <input type="text" wire:model="seat_map" placeholder="Seat Map" class="input">
        <button type="submit" class="btn">{{ $isEdit ? 'Update' : 'Create' }}</button>
    </form>

    <table class="table-auto w-full mt-4">
        <thead>
        <tr>
            <th>Seat #</th>
            <th>User</th>
            <th>Event</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($seats as $seat)
            <tr>
                <td>{{ $seat->id }}</td>
                <td>{{ $seat->user?->name ?? 'Unassigned' }}</td>
                <td>{{ $seat->event->name }}</td>
                <td>
                    <button wire:click="edit({{ $seat->id }})" class="btn">Edit</button>
                    <button wire:click="delete({{ $seat->id }})" class="btn">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $seats->links() }}

</div>

