<?php
namespace App\Providers;

use App\Models\DishCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class WorkerPanelComposer{

 
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void{
        $view->with('categoriesPanelCount', DishCategory::all()->count());
        $view->with('user', Auth::user());
    }
}