<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(UpdateProfileRequest $request){
        $user = $request->user();

        $user->update($request->validated());

        return response()->json([
            'message' => 'Perfil atualizado com sucesso.',
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    public function delete(DeleteProfileRequest $request){
        $user = $request->user();

        if(!Hash::check($request->password, $user->password)){
            return response()->json([
                'message' => 'Senha incorreta. A conta não foi deletada.'
            ], 403);
        }

        $user->tokens()->delete();
        $user->delete();
        
        return response()->json([
            'message' => 'Conta deletada com sucesso.'
        ], 400);
}
}