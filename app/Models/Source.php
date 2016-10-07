<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Source
 *
 * @property integer $id
 * @property string $name
 * @property integer $type_id
 * @property float $value
 * @property string $comment
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Type $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Budget[] $budgets
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereValue($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereComment($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Source whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Source extends Model {

    protected $fillable = [
        "name", "type_id", "value", "comment"
    ];

    public function setValueAttribute($value) {
        $this->attributes["value"] = str_replace(",", ".", $value);
    }

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function budgets() {
        return $this->hasMany(Budget::class);
    }

}
