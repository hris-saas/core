<?php

namespace HRis\Core\Eloquent;

use HRis\Core\Traits\HasClass;
use HRis\Core\Traits\HasSortOrder;
use HRis\Core\Traits\HasMovingForward;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasClass, HasMovingForward, HasSortOrder, HasTranslations, SoftDeletes;

    public $translatable = ['name'];

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
