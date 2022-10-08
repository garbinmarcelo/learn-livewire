<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseCreate extends Component
{
    use WithFileUploads;

    public $description;
    public $amount;
    public $type;
    public $photo;
    public $expenseDate;

    protected $rules = [
        'description' => 'required',
        'type'        => 'required',
        'amount'      => 'required',
        'photo'       => 'image|nullable',
    ];

    public function render()
    {
        return view('livewire.expense.expense-create');
    }

    public function createExpense()
    {
        $this->validate();

        if($this->photo){
            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        auth()->user()->expenses()->create([
            'description'  => $this->description,
            'type'         => $this->type,
            'amount'       => $this->amount,
            'user_id'      => 21,
            'photo'        => $this->photo,
            'expense_date' => $this->expenseDate,
        ]);

        session()->flash('message', 'Registro criado com sucesso!');
        $this->amount = $this->description = $this->type = NULL;
    }
}
