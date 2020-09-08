<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Category;
class CategoryTreeFront extends Component
{

    public $categories;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($categories)
    {
        //
        $this->categories = $this->getCategoryTree();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.category-tree-front');
    }
    
    public function getCategoryTree() {
        return Category::with('childrenRecursive')->whereNull('parent_id')->get();
    }
}
