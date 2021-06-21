<?php


namespace Metif12\LaravelFarsi\Traits;


trait HasFarsiAttributes
{
    public static function bootHasFarsiAttribute()
    {
        static::saving(function ($model) {
            foreach ($model->getFarsiAttributes() as $attribute => $functions) {
                if (is_string($model->{$attribute}) && !empty($functions)) {

                    if(is_string($functions)) $functions = explode('|', $functions);

                    foreach($functions as $function) 
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
