<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Lang extends Component
{
    public function render()
    {
        return view('livewire.components.lang');
    }

    public function changeLang($value)
    {

        if (!in_array($value, config('app.locales'))) {
            $this->dispatchBrowserEvent('toast', ['type'=>'error', 'message'=>__('locale not found')]);
            return false;
        }

        $this->dispatchBrowserEvent('toast', ['type'=>'success', 'message'=>__('locale changed successful')]);

        session()->put('locale', $value);
        app()->setLocale($value);

        return redirect(request()->header('Referer'));
    }
}
