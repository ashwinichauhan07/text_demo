<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class option extends Model
{

public function options(){
    $id = 1; // Replace 1 with the actual ID of the Practisemcq instance you want to retrieve

    $practisemcq = Practisemcq::find($id);
    
    if ($practisemcq) {
        $options = $practisemcq->ans;
    
        foreach ($options as $option) {
            // Access option properties
            $option->id;
            $option->ans;
            // ...
        }
    } else {
        // Handle the case when the Practisemcq record is not found
        // Display an error message or redirect the user
        // ...
    }
    return $this->hasMany(Option::class);
}
}