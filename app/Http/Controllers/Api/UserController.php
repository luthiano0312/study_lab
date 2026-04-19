<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DeleteProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function update(UpdateProfileRequest $request)
    {
        $user = $request->user();
        $data = $request->validated();

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            if ($user->avatar && !str_starts_with($user->avatar, '/')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $path;
        }

        if ($request->has('avatar_url')) {
            if ($user->avatar && !str_starts_with($user->avatar, '/')) {
                Storage::disk('public')->delete($user->avatar);
            }
            $data['avatar'] = $request->input('avatar_url');
        }

        $user->update($data);
        $user->refresh();

        return response()->json([
            'message' => 'Perfil atualizado com sucesso.',
            'user'    => $this->userResource($user),
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate(['photo' => 'required|image|max:2048']);

        $user = $request->user();
        $path = $request->file('photo')->store('avatars', 'public');

        if ($user->avatar && !str_starts_with($user->avatar, '/')) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->update(['avatar' => $path]);
        $user->refresh();

        return response()->json([
            'message' => 'Foto atualizada.',
            'user'    => $this->userResource($user),
        ]);
    }

    public function delete(DeleteProfileRequest $request)
    {
        $user = $request->user();

        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Senha incorreta.'], 403);
        }

        if ($user->avatar && !str_starts_with($user->avatar, '/')) {
            Storage::disk('public')->delete($user->avatar);
        }

        $user->tokens()->delete();
        $user->delete();

        return response()->json(['message' => 'Conta deletada com sucesso.']);
    }

    private function userResource($user): array
    {
        return [
            'id'         => $user->id,
            'name'       => $user->name,
            'email'      => $user->email,
            'created_at' => $user->created_at,
            'avatar'     => $user->avatar
                ? (str_starts_with($user->avatar, '/') || str_starts_with($user->avatar, 'http') ? $user->avatar : Storage::disk('public')->url($user->avatar))
                : null,
        ];
    }
}