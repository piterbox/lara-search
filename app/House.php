<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class House extends Model
{
    /**
     * @var string
     */
    protected $table = 'houses';

    /**
     * @param $query
     * @param string|null $name
     * @return mixed
     */
    public function scopeOfName($query, $name)
    {
        if(is_null($name)) return $query;
        return $query->where('name', 'LIKE', "%$name%");
    }

    /**
     * @param $query
     * @param array|null $price
     * @return mixed
     */
    public function scopeOfPrice($query, $price)
    {
        if(is_null($price) || !is_array($price) ) return $query;
        if(is_null($price['max']) && is_null($price['max'])) return $query;
        if(!is_null($price['max']) && $price['max'] > 0 && !is_null($price['min']) && $price['min'] > 0 && $price['min'] < $price['max'])return $query->whereBetween('price', [$price['min'], $price['max']]);
        if(!is_null($price['min']) && $price['min'] > 0 && is_null($price['max'])) return $query->whereBetween('price', [$price['min'], self::getMaxPrice()]);
        if(!is_null($price['max']) && $price['max'] > 0 && is_null($price['min'])) return $query->whereBetween('price', [0, $price['max']]);
        return $query->whereBetween('price', $price);
    }

    /**
     * @param $query
     * @param integer|null $count
     * @return mixed
     */
    public function scopeOfBedrooms($query, $count)
    {
        if(is_null($count)) return $query;
        return $query->where('bedrooms', $count);
    }

    /**
     * @param $query
     * @param integer|null $count
     * @return mixed
     */
    public function scopeOfBathrooms($query, $count)
    {
        if(is_null($count)) return $query;
        return $query->where('bathrooms', $count);
    }

    /**
     * @param $query
     * @param integer|null $count
     * @return mixed
     */
    public function scopeOfStoreys($query, $count)
    {
        if(is_null($count)) return $query;
        return $query->where('storeys', $count);
    }

    /**
     * @param $query
     * @param integer|null $count
     * @return mixed
     */
    public function scopeOfGarages($query, $count)
    {
        if(is_null($count)) return $query;
        return $query->where('garages', $count);
    }

    public static function getMaxPrice()
    {
        return DB::table('houses')->max('price');
    }
}
