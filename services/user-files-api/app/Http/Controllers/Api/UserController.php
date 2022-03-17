<?php
declare(strict_types=1);
namespace App\Http\Controllers\Api;

use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends ApiController
{
    function list(Request $request){
        return $this->dispatchApiRequest($request, function(){
            $users = User::withOrderedFiles()->get();
            return $this->successResponse(UserResource::collection($users));
        });
    }

    function show(Request $request, User $user){
        return $this->dispatchApiRequest($request, function() use($user){
            return $this->successResponse(
                new UserResource(
                    $user->load([
                        'files' => fn($query) => $query->orderBy('created_at', 'asc')->orderBy('file_name', 'asc')
                    ])
                )
            );
        });
    }

    function addFile(FileUploadRequest $request, User $user){
        return $this->dispatchApiRequest($request, function() use($user, $request){
            $user->load([
                'files' => fn($query) => $query->orderBy('created_at', 'asc')->orderBy('file_name', 'asc')
            ]);
            $file = FileUploadService::upload($request->file('file'));
            $newFileUploaded = $user->files()->create([
                'file_name' => $file['name'], 
                'url' => $file['url']
            ]);
            return $this->successResponse((new UserResource($user))->withNewFileUploaded($newFileUploaded), Response::HTTP_CREATED);
        });
    }
}
