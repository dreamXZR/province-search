<?php

namespace Dreamxzr\ProvinceSearch\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $table = 'sys_positions';

    public $timestamps = false;

    protected $hidden = [
        'id', 'area_index',
    ];

    public function getChild()
    {
        return $this->hasMany('Xing\ProvinceSearch\Models\Position','area_index','area_code');
    }
}
