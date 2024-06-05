<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Component;

class Home extends Component
{
    public $show = false;
    public $new_task = "";

    public function addTask()
    {
        $this->validate([
            'new_task' => 'required'
        ]);

        Todo::create([
            'task' => $this->new_task
        ]);

        $this->reset('new_task');
        $this->reset('show');
    }

    public function deleteTask(Todo $todo)
    {
        $todo->delete();
    }

    public function toggleStatus(Todo $todo)
    {
        $new_status = !$todo->is_done;
        $todo->update([
            "is_done" => $new_status
        ]);
    }

    public function render()
    {
        return view('livewire.home', [
            'title' => 'Todolist',
            'todos' => Todo::orderBy('is_done')->get()
        ]);
    }
}