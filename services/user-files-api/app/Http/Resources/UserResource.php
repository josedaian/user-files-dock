<?php

namespace App\Http\Resources;

use App\Models\UserFile;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    private $newFileUploaded;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'user_id' => $this->id,
            $this->mergeWhen($this->newFileUploaded, function(){
                return ['uploaded_file' => new UserFileResource($this->newFileUploaded)];
            }),
            'files' => UserFileResource::collection($this->whenLoaded('files'))
        ];
    }

    public function withNewFileUploaded(UserFile $newFileUploaded): self{
        $this->newFileUploaded = $newFileUploaded;
        return $this;
    }
}
