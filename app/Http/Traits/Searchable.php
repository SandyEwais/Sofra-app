<?php
namespace App\Http\Traits;
trait Searchable
{
    public function scopeFilter($query,array $filter){
        $columns = $this->columns;
        if($filter['restaurant_id'] ?? false){
            $query->where('restaurant_id','like','%'.request('restaurant_id').'%');
        }
        if($filter['search'] ?? false){
            $query->where(function($q)use($columns){
                foreach($columns as $column){
                    $q->orWhere($column,'like','%'.request('search').'%');
                }
                
            });
        }
    }
}
