<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseCreate extends Component
{
    public $description;
    public $amount;
    public $type;

    protected $rules = [
        'description' => 'required',
        'type' => 'required',
        'amount' => 'required',
    ];

    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        auth()->user()->expenses()->create([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'user_id' => 21,
        ]);

        session()->flash('message','Registro criado com sucesso!');
        $this->amount = $this->description = $this->type = null;
    }
}
