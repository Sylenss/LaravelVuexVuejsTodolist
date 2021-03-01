<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Tasks */
class TasksResource extends JsonResource
{
    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
//       Structure your data before its passed to an endpoint
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'description' => $this->description,
            'completed'   => $this->completed,
            'created_at'  => $this->created_at,

            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
