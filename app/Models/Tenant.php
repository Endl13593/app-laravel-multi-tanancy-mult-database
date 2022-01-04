<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string name
 * @property string domain
 * @property string db_database
 * @property string db_hostname
 * @property string db_username
 * @property string db_password
 */
class Tenant extends Model
{
    use HasFactory;
}
