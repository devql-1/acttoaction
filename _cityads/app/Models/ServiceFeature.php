<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceFeature extends Model {
    protected $fillable = ['service_id','title','icon','description','status'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
}
