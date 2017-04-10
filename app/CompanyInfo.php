<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyInfo extends Model
{
    protected $table = 'companies';

    protected $fillable = [
        'name', 'code', 'url','description',
    ];

}
