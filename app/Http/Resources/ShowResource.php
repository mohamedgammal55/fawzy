<?php

namespace App\Http\Resources;

use App\Models\Categories;
use App\Models\PostsHeroes;
use Illuminate\Http\Resources\Json\JsonResource;

class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'title'=>$this->title,
            'rate'=>$this->rate,
            'image'=>get_file($this->image),
            'price'=>$this->price,
            'details'=>$this->details,
            'count_hours'=>floor($this->minutes / 60).'H '.($this->minutes % 60).'M',
            'heroes'=>HeroesResource::collection(PostsHeroes::where('post_id',$this->id)->latest()->get()),
        ];
    }
}
