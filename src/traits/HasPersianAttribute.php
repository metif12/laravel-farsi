<?php


namespace Metif12\LaravelFarsi\traits;


trait HasPersianAttribute
{
    public static function bootHasFarsiAttribute()
    {
        static::saving(function ($model) {
            foreach ($model->getFarsiAttributes() as $attribute => $function) {
                if (is_string($model->{$attribute})) {
                    $model->{$attribute} = call_user_func($function, $model->{$attribute});
                }
            }
        });
    }

    public function getFarsiAttributes()
    {
        return property_exists($this, 'farsiAttributes') ? $this->farsiAttributes : [];
    }
}
