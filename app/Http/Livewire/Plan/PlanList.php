<?php

namespace App\Http\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class PlanList extends Component
{
    public function render()
    {
        $plans = Plan::all(['id', 'name', 'price', 'created_at']);

        return view('livewire.plan.plan-list', compact('plans'));
    }
}
