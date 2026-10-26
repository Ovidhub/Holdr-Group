<?php

namespace App\Http\Livewire\Admin;

use App\Models\Settings;
use App\Traits\PingServer;
use Livewire\Component;

class SoftwareModule extends Component
{
    use PingServer;

    public function render()
    {
        return view('livewire.admin.software-module');
    }

    public function updateModule($module, $value)
    {
        $settings = Settings::find(1);
        if (!$settings) {
            return redirect()->route('appsettingshow')->with('message', 'Settings not found');
        }

        $defaultModules = [
            'investment' => 'true',
            'cryptoswap' => true,
            'subscription' => false,
            'signal' => false,
            'membership' => false,
        ];
        $options = is_array($settings->modules) ? array_merge($defaultModules, $settings->modules) : $defaultModules;
        $options[$module] = ($value == 'true' || $value === true) ? ($module === 'investment' ? 'true' : true) : ($module === 'investment' ? 'false' : false);
        $settings->modules = $options;
        $settings->save();

        return redirect()->route('appsettingshow')->with('success', 'Action Successful');
    }
}
