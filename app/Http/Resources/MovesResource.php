<?php

namespace App\Http\Resources;

use App\Models\Categories;
use App\Models\PostsHeroes;
use Illuminate\Http\Resources\Json\JsonResource;

class MovesResource extends JsonResource
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
            'video'=>get_file($this->video),
            'image'=>get_file($this->image),
            'category'=>new CategoryResource(Categories::find($this->category_id)),
            'price'=>$this->price,
            'details'=>$this->details,
            'heroes'=>HeroesResource::collection(PostsHeroes::where('post_id',$this->id)->latest()->get()),

        ];
    }
}
