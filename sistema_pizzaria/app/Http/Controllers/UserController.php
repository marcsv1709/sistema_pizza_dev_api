<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        try {
            $user = User::select('id', 'name', 'email')->paginate(2);
            return [
                'status' => 200,
                'menssagem' => 'Usuários encontrados!!',
                'user' => $user
            ];
        } catch (\Exception $e) {
            return [
                'status' => 500,
                'menssagem' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()
            ];
        }
    }


    public function create()
    {

    }


    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

        return [
            'status' => 200,
            'menssagem' => 'Usuário cadastrado com sucesso!!',
            'user' => $user
        ];
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        
    }

    public function update(UserUpdateRequest $request, string $id)
    {
        $data = $request->all();

        $user = User::find($id);

        if(!$user){
            return [
                'status' => 404,
                'mensage' => 'Usuário não encontrado! Que triste!',
                'user' => $user
            ];
        }

        $user->update($data);

        return [
            'status' => 200,
            'mensage' => 'Usuário atualizado com sucesso!!',
            'user' => $user
        ];
    }


    public function destroy(string $id)
    {
        $user = User::find($id);

        if(!$user){
            return [
                'status' => 404,
                'mensage' => 'Usuário não encontrado! Que triste!',
                'user' => $user
            ];
        }

        $user->delete($id);

        return [
            'status' => 200,
            'mensage' => 'Usuário deletado com sucesso!!'
        ];

    }
}
