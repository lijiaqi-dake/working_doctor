<?php

namespace App\Policies;

use App\Models\Admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    //管理员只能编辑自己的页面
    public function updata(Admin $currentAdmin, Admin $admin)
    {
        return $currentAdmin->id === $admin->id;

    }
}
