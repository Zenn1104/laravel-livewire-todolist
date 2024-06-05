<div class="grid place-content-center h-screen gap-4">
    <ul class="menu bg-base-200 w-70 rounded-box">
        @forelse ($todos as $todo)
            <li>
                <div>
                    <div @class(['line-through' => $todo->is_done]) wire:click="toggleStatus({{ $todo->id }})">{{$todo->task}}</div>
                    <button class="badge badge-sm badge-error" wire:click="deleteTask({{ $todo->id }})">DEL</button>
                </div>
            </li>
        @empty
            <li>
                <button>Belum Ada Tak yang dibuat😪</button>
            </li>
        @endforelse
    </ul>

    <!-- Open the modal using ID.showModal() method -->
    <button class="btn" wire:click="$set('show', 1)">Buat Todo List</button>
    <dialog class="modal" {{ $show ? "open" : "" }}>
    <form class="modal-box" wire:submit="addTask" data-theme="light">
        <h3 class="font-bold text-lg">Add New Task</h3>
        <div class="py-4">
            <label class="form-control w-full">
                <div class="label">
                  <span class="label-text">Tuliskan Tugas</span>
                </div>
                <input type="text" placeholder="Type here" @class(['input input-bordered w-full', 'input-error' => $errors->first('new_task')]) wire:model="new_task" />
                @error('new_task')
                    <div class="label">
                        <span class="label-text text-alt text-error">{{ $message }}</span>
                    </div>
                @enderror
              </label>
        </div>
        <div class="modal-action">
            <button type="button" class="btn" wire:click="$set('show', 0)">Close</button>
            <button class="btn btn-primary">Add Task</button>
        </div>
    </form>
    </dialog>
</div>
