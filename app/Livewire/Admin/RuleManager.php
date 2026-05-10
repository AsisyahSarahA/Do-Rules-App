<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Rule;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use Livewire\Attributes\On;

#[Layout('layouts.app')]

class RuleManager extends Component
{
    use WithPagination;

    public $name;
    public $description;
    public $point;
    public $level;
    public $ruleId;

    public $isEdit = false;
    public $showForm = false;
    public $search = '';

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'description' => 'required',
            'point' => 'required|integer',
            'level' => 'required'
        ]);

        Rule::updateOrCreate(
            ['id' => $this->ruleId],
            [
                'name' => $this->name,
                'description' => $this->description,
                'point' => $this->point,
                'level' => $this->level
            ]
        );

        $this->dispatch('success', message: 'Data tata tertib berhasil disimpan!');

        $this->resetForm();
    }

    public function edit($id)
    {
        $rule = Rule::findOrFail($id);

        $this->ruleId = $rule->id;
        $this->name = $rule->name;
        $this->description = $rule->description;
        $this->point = $rule->point;
        $this->level = $rule->level;

        $this->isEdit = true;
        $this->showForm = true;
    }

    public function delete($id)
    {
        $this->dispatch('confirmDelete', id: $id);
    }

    #[On('deleteConfirmed')]
    public function deleteConfirmed($id)
    {
        Rule::find($id)?->delete();
        $this->dispatch('success', message: 'Data tata tertib berhasil dihapus!');
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'description',
            'point',
            'level',
            'ruleId'
        ]);

        $this->isEdit = false;
        $this->showForm = false;
    }

    public function render()
    {
        $rules = Rule::when($this->search, function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
              ->orWhere('description', 'like', '%' . $this->search . '%');
        })
        ->latest()
        ->paginate(10);

        return view('livewire.admin.rule-manager', compact('rules'));
    }
}