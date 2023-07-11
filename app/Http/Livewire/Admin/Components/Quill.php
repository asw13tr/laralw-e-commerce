<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class Quill extends Component{

    const EVENT_VALUE_UPDATED = 'quill_value_updated';

    public string $value = '';
    public string $idName = '';

    public function mount($value=''){
        $this->value = $value;
        $this->idName = 'quill_'.rand(9999,999999);
    } // mount

    public function updatedValue($value){
        $this->emit(self::EVENT_VALUE_UPDATED, $this->value);
    }

    public function render(){
        return view('livewire.admin.components.quill');
    }
}
