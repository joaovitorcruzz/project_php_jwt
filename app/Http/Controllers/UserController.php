<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Amnésia na hora de desenvolver, esquecimento dos commits granulares, vou comentando inicio e fim
    /**
     * Retorna os dados do usuário autenticado.
     * Acessível por: user e admin.
     */
    // Inicio da busca do profile
    public function profile()
    {
        $user = Auth::user();
        return response()->json($user);
    }
    // Final da busca do profile

    /**
     * Atualiza os dados do próprio usuário autenticado.
     * Acessível por: user e admin.
     */
    // Inicio do update do profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->fill($request->only(['name', 'email']));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Perfil atualizado com sucesso!',
            'user' => $user
        ]);
    }
    // Final do update do profile

    /**
     * Lista todos os usuários.
     * Acessível por: admin.
     */
    // Inicio do get do admin
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }
    // Final do get do admin

    /**
     * Atualiza os dados de um usuário específico.
     * Acessível por: admin.
     * Usamos o Route-Model Binding (User $user) para injetar o usuário automaticamente.
     */
    // Incio do update do admin
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|string|max:255',
            'email' => ['sometimes', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'sometimes|string|min:6',
            'role' => 'sometimes|string|in:admin,user',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user->fill($request->only(['name', 'email', 'role']));

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json([
            'message' => 'Usuário atualizado com sucesso!',
            'user' => $user
        ]);
    }
    // Final do update do admin

    /**
     * Deleta um usuário específico.
     * Acessível por: admin.
     */
    //Inicio do delete do admin
    public function destroy(User $user)
    {
        if (Auth::id() === $user->id) {
            return response()->json(['error' => 'Você não pode deletar seu próprio usuário.'], 403);
        }

        $user->delete();

        return response()->json(['message' => 'Usuário deletado com sucesso!'], 200);
    }
    // Final do delete do admin
}
