<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class BannerAdvertisement extends Model
{
    use HasFactory, SoftDeletes;
    use HasUuids;

      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $guarded    = [];
    protected $primaryKey = 'id';

           // membuat isi slug dari name
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug']  = Str::slug($value);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
