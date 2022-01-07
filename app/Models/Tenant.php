<?php

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property string name
 * @property string uuid
 * @property string domain
 * @property string db_database
 * @property string db_hostname
 * @property string db_username
 * @property string db_password
 */
class Tenant extends Model
{
    use HasFactory, SoftDeletes,UuidTrait;

    protected $fillable = [
        'name',
        'domain',
        'db_database',
        'db_hostname',
        'db_username',
        'db_password'
    ];
}
