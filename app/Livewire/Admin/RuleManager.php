<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Rule;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]

class RuleManager extends Component
{
    public $name, $point, $level, $ruleId;
    public $isEdit = false;
    public $showForm = false;
    public $search = '';

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'point' => 'required|integer',
            'level' => 'required'
        ]);

       

        Rule::updateOrCreate(
            ['id' => $this->ruleId],
            [
                'name' => $this->name,
                'point' => $this->point,
                'level' => $this->level
            ]
        );

         session()->flash('message', 'Data berhasil disimpan');

        $this->resetForm();
    }
    public function edit($id)
    {
        $rule = Rule::find($id);

        $this->ruleId = $rule->id;
        $this->name = $rule->name;
        $this->point = $rule->point;
        $this->level = $rule->level;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        Rule::find($id)?->delete();

        session()->flash('message', 'Data berhasil dihapus');
    }

    public function resetForm()
    {
        $this->reset(['name', 'point', 'level', 'ruleId']);
        $this->isEdit = false;
        $this->showForm = false;
    }

    use WithPagination;

    public function render()
    {
         $rules = Rule::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate(10);
        
        return view('livewire.admin.rule-manager', compact('rules'));
    }

}
