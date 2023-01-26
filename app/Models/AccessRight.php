<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class AccessRight extends Model
{
    use HasFactory, HasUuids, CreatedUpdatedBy;

    protected $fillable = [
        'wording'
    ];

    public function user_profils(): BelongsToMany
    {
        return $this->belongsToMany(UserProfil::class)
            ->using(ProfilAccess::class)
            ->as('profil_access')
            ->withPivot(['pcreate','pread','pupdate','pdelete','created_by','update_by'])
            ->withTimestamps();
    }
}
