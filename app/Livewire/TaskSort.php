<?php

namespace App\Livewire;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class TaskSort extends Component
{

    public ?string $model = null;  // Property to store the model name
    public $data = [];  // Will hold the data fetched from the model
    public ?string $flag = null;  // Property to store the flag value
    public function setModel()
    {
        $modelName = request()->query('flag');
        // Map the model name to its fully qualified class name
        $modelNamespace = "App\\Models\\" . $modelName;

        // Check if the model class exists
        if (class_exists($modelNamespace)) {
            $this->model = $modelNamespace;
        }
        return $this;
    }


    public function loadData()
    {
        if (!count($this->data) && $this->model && class_exists($this->model)) {
            $modelInstance = new $this->model();

            // Check if the model has an 'order' column and order by it
            if (Schema::hasColumn($modelInstance->getTable(), 'order')) {
                $this->data = $modelInstance::orderBy('order', 'desc')->get();
            }
        }
    }

    public function render()
    {
        $this->setModel()->loadData();
        $this->flag = request()->query('flag');
        return view('components.taskSort');
    }

     public function updateOrder($orders)
     {
         $this->flag = request()->query('flag');
         $this->setOrder($orders);
         return;
         if (class_exists($this->model)) {
             foreach ($orders as $task) {
                 $this->model::find($task['id'])->update(['order' => $task['order']]);
             }
         }
     }

     private function setOrder($orders)
     {
         $ids = array_column($orders, 'id');
         $caseStatement = 'CASE id';

         foreach ($orders as $task) {
             $caseStatement .= " WHEN {$task['id']} THEN {$task['order']}";
         }

         $caseStatement .= ' END';

         if($this->model::whereIn('id', $ids)->update(['order' => DB::raw($caseStatement)])){
             $this->data = [];
         }
     }

//     private function setOrder($orders)
//     {
//         $ids = array_column($orders, 'id');
//         $caseStatement = 'CASE id';
//
//         foreach ($orders as $task) {
//             $caseStatement .= " WHEN {$task['id']} THEN {$task['order']}";
//         }
//
//         $caseStatement .= ' END';
//
//         $this->model::whereIn('id', $ids)->update(['order' => DB::raw($caseStatement)]);
//
//     }
}
