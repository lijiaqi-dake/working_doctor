<?php

namespace App\Transformers;

use App\Models\Admin;
use League\Fractal\TransformerAbstract;

class AdminTransformer extends TransformerAbstract
{
    public function transform(Admin $admin)
    {
    	return [
            'id' => $admin->id,
            'account' => $admin->account,
            'admin_phone' => $admin->admin_phone,
    	];
    }	
}