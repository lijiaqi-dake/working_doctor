<?php

namespace App\Transformers;

use App\Models\relation_admins_classes;
use League\Fractal\TransformerAbstract;

class Admins_classesTransformer extends TransformerAbstract
{
    public function transform(relation_admins_classes $admins_classes)
    {
    	return [
            'id' => $admins_classes->id,
            'grade' => $admins_classes->grade,
            'class' => $admins_classes->class,
    	];
    }	
}