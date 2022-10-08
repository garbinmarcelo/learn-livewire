<?php

namespace App\Http\Livewire\Expense;

use App\Models\Expense;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ExpenseEdit extends Component
{
    use WithFileUploads;

    public Expense $expense;
    public         $description;
    public         $amount;
    public         $type;
    public         $photo;

    protected $rules = [
        'description' => 'required',
        'type'        => 'required',
        'amount'      => 'required',
        'photo'       => 'image|nullable',
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

        if($this->photo){
            if(!is_null($this->expense->photo) && Storage::disk('public')->exists($this->expense->photo))
                Storage::disk('public')->delete($this->expense->photo);

            $this->photo = $this->photo->store('expenses-photos', 'public');
        }

        $this->expense->update([
            'description' => $this->description,
            'type'        => $this->type,
            'amount'      => $this->amount,
            'user_id'     => 21,
            'photo'       => $this->photo ?? $this->expense->photo,
        ]);

        session()->flash('message', 'Registro atualizado com sucesso!');
    }
}
