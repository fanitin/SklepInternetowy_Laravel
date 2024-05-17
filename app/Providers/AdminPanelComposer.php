<?php
namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminPanelComposer{

 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void{
        $view->with('usersPanelCount', User::all()->count());
        $view->with('user', Auth::user());
    }
}