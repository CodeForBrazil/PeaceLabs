<?php

namespace app\Models\Access\Permission;

use App\Models\Access\Permission\Traits\Attribute\PermissionGroupAttribute;
use App\Models\Access\Permission\Traits\Relationship\PermissionGroupRelationship;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PermissionGroup.
 */
class PermissionGroup extends Model
{
    use PermissionGroupRelationship, PermissionGroupAttribute;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     *
     */
    public function __construct()
    {
        $this->table = config('access.permission_group_table');
    }
}
