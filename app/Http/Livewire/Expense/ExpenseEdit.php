<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;

class ExpenseEdit extends Component
{
    public Expense $expense;
    public $description;
    public $amount;
    public $type;

    protected $rules = [
        'description' => 'required',
        'type' => 'required',
        'amount' => 'required',
    ];

    public function mount()
    {
        $this->description = $this->expense->description;
        $this->amount = $this->expense->amount;
        $this->type = $this->expense->type;
    }

    public function render()
    {
        return view('livewire.expense.expense-edit');
    }

    public function updateExpense()
    {
        $this->validate();

        $this->expense->update([
            'description' => $this->description,
            'type' => $this->type,
            'amount' => $this->amount,
            'user_id' => 21,
        ]);

        session()->flash('message','Registro atualizado com sucesso!');
    }
}
