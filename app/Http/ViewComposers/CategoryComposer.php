<?php
namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;

class CategoryComposer
{

    /**
     * Bind data to the view.
     *
     * @param View $view of view
     *
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', Category::all());
    }
}
