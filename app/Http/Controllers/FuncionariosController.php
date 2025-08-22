<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;//importa a classe request 
use App\Models\Funcionario;//importa o modelo Funcionario

class FuncionariosController extends Controller 
{





    public function index()//lista todos os funcionarios
    {
        $funcionarios = Funcionario::all();//busca todos os funcionarios do banco de dados e atribui a variavel $funcionarios
        return view('funcionarios.index', compact('funcionarios'));//transforma o array $funcionarios em uma variavel que pode ser usada na view index
    }








    public function create()//mostra o formulario de criacao de funcionarios
    {
        return view('funcionarios.create');// retorna na view create
    }

 







    public function store(Request $request)//salva o novo funcionario
    {
        $request->validate([// valida os dados se estão corretos de acordo com as regras definidas
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios',
            'cpf' => 'required|string|size:11|unique:funcionarios',
            'telefone' => 'nullable|string|max:20',
            'nascimento' => 'nullable|date',
            'admissao' => 'nullable|date',
            'cargo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'status' => 'boolean',
            'foto' => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $data = $request->all();//array com os dados do request
        
        // verifica se o checkbox status foi marcado, se sim, define como true, caso contrário false
        $data['status'] = $request->has('status') ? true : false;

        // Upload da foto
        if ($request->hasFile('foto')) {// verifica se a foto foi enviada
            $foto = $request->file('foto');// obtém o arquivo da foto
            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();// cria um nome único para o arquivo
            
            $caminho = public_path('uploads/funcionarios');// define o caminho onde a foto será salva
            if (!file_exists($caminho)) {// verifica se a pasta existe, se não, cria
                mkdir($caminho, 0755, true);
            }
            
            $foto->move($caminho, $nomeArquivo);// move a foto para o caminho definido
            $data['foto'] = $nomeArquivo;// armazena o nome do arquivo no array de dados
        }

        Funcionario::create($data);// cria o novo funcionario no banco de dados na classe Funcionario

        return redirect()->route('funcionarios.index')//redireciona para a lista de funcionarios
        ->with('success', 'Funcionário criado com sucesso!');// mensagem de sucesso
    }

 







    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id, se não encontrar da um erro 404
        return view('funcionarios.show', compact('funcionario')); // mostra os detalhes do funcionario na view show
    }

  






    
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id, se não encontrar da um erro 404
        return view('funcionarios.edit', compact('funcionario'));// mostra o formulario de edicao do funcionario na view edit
    }

 







    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id, se não encontrar da um erro 404

        $request->validate([//caso não passe na validação, retorna para o formulário com os erros pre definidos
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios,email,' . $id,
            'cpf' => 'required|string|size:11|unique:funcionarios,cpf,' . $id,
            'telefone' => 'nullable|string|max:20',
            'nascimento' => 'nullable|date',
            'admissao' => 'nullable|date',
            'cargo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'status' => 'boolean',
            'foto' => 'nullable|image|mimes:png,jpg|max:2048',
        ]);

        $data = $request->all();
        
        $data['status'] = $request->has('status') ? true : false;


        // Upload da nova foto
        if ($request->hasFile('foto')) {
            // Deletar foto antiga se existir
            if ($funcionario->foto) {
                $caminhoAntigo = public_path('uploads/funcionarios/' . $funcionario->foto);
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }

            $foto = $request->file('foto');
            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();
            
            $caminho = public_path('uploads/funcionarios');
            if (!file_exists($caminho)) {
                mkdir($caminho, 0755, true);
            }
            
            $foto->move($caminho, $nomeArquivo);
            $data['foto'] = $nomeArquivo;
        }

        $funcionario->update($data);// atualiza os dados do funcionario, laravel salva no banco de dados

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário atualizado com sucesso!');
    }

   







    public function destroy($id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id
        
        // Deletar foto se existir
        if ($funcionario->foto) {
            $caminhoFoto = public_path('uploads/funcionarios/' . $funcionario->foto);
            if (file_exists($caminhoFoto)) {
                unlink($caminhoFoto);
            }
        }
        
        $funcionario->delete();    // deleta o funcionario do banco de dados

        return redirect()->route('funcionarios.index')
                         ->with('success', 'Funcionário deletado com sucesso!');//mensagem vai para app.blade.php
    }
}
