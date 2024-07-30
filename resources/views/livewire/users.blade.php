<div>
    @include('livewire.create')
    @include('livewire.update')


    <table class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>SL No.</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button type="button" wire:click='edit({{ $user->id }})' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal">Edit</button>
                        <button type="button" wire:click='delete({{ $user->id }})' class="btn btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
