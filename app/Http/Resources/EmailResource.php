<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'email_address' => $request->emailAddress,
            'message' => $request->message,
            'file_name' => $request->file_name,
            'file' => $request->file,
            'sent' => $request->sent
        ];
    }
}
