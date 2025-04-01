<?php

namespace App\View\Components;

use Illuminate\View\Component;

class WorkoutCategory extends Component
{
    public $category;
    public $workouts;
    public $categoryColor;
    public $isActive;
    public $image;
    /**
     * Create a new component instance.
     *
     * @param string $category
     * @param \Illuminate\Support\Collection $workouts
     * @param string $categoryColor
     * @param bool $isActive
     */
    public function __construct($category, $workouts, $categoryColor, $isActive = false, $image)
    {
        $this->category = $category;
        $this->workouts = $workouts;
        $this->categoryColor = $categoryColor;
        $this->isActive = $isActive;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.workout-category');
    }
}


