<?php

namespace HRis\Core\Eloquent;

use HRis\Core\Traits\HasClass;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasClass;
    
    /**
     * The model's attributes.
     *
     * @var array
     */
    protected $attributes = ['class' => self::class];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'parent_id', 'sort_order', 'class', 'name', 'is_completed', 'created_at', 'updated_at', 'deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'statuses';
}
