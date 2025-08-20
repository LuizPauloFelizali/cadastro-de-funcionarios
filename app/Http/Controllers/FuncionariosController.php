<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Storage;

class FuncionariosController extends Controller 
{





    public function index()//lista todos os funcionarios
    {
        $funcionarios = Funcionario::all();//busca todos os funcionarios do banco de dados e atribui a variavel $funcionarios
        return view('funcionarios.index', compact('funcionarios'));//transforma o array $funcionarios em uma variavel que pode ser usada na view
    }








    public function create()//mostra o formulario de criacao de funcionarios
    {
        return view('funcionarios.create');
    }

 







    public function store(Request $request)//salva o novo funcionario
    {
        $request->validate([// valida os dados se estão corretos de acordo com as regras definidas, como por exemplo, se o email é único, se o cpf tem 11 caracteres, etc.
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios',
            'cpf' => 'required|string|size:11|unique:funcionarios',
            'telefone' => 'nullable|string|max:20',
            'nascimento' => 'nullable|date',
            'admissao' => 'nullable|date',
            'cargo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'status' => 'boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();//array com os dados do request
        
        // trata o checkbox status (necessário para permitir desativar funcionários)
        $data['status'] = $request->has('status') ? true : false;

        // Upload da foto
        if ($request->hasFile('foto')) {// verifica se tem arquivo de foto
            $foto = $request->file('foto');// pega o arquivo de foto
            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();// cria um nome unico para o arquivo
            
      
            $caminho = public_path('uploads/funcionarios');// caminho onde as fotos serão salvas
            if (!file_exists($caminho)) {// verifica se a pasta existe
                mkdir($caminho, 0755, true);// se não existir, cria a pasta
            }
            
            // Mover arquivo para pasta pública
            $foto->move($caminho, $nomeArquivo);// move o arquivo para a pasta criada
            $data['foto'] = $nomeArquivo;// salva o nome do arquivo no array de dados
        }

        Funcionario::create($data);// cria o novo funcionario no banco de dados de acordo com a variavel $data

        return redirect()->route('funcionarios.index')//redireciona para a lista de funcionarios
        ->with('success', 'Funcionário criado com sucesso!');// mensagem de sucesso
    }

 







    public function show($id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id
        return view('funcionarios.show', compact('funcionario')); // mostra os detalhes do funcionario
    }

  






    
    public function edit($id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id
        return view('funcionarios.edit', compact('funcionario'));// mostra o formulario de edicao do funcionario
    }

 







    public function update(Request $request, $id)
    {
        $funcionario = Funcionario::findOrFail($id);// busca o funcionario pelo id

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:funcionarios,email,' . $id,
            'cpf' => 'required|string|size:11|unique:funcionarios,cpf,' . $id,
            'telefone' => 'nullable|string|max:20',
            'nascimento' => 'nullable|date',
            'admissao' => 'nullable|date',
            'cargo' => 'required|string|max:255',
            'departamento' => 'required|string|max:255',
            'status' => 'boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Tratar status como boolean
        $data['status'] = $request->has('status') ? (bool)$request->status : false;

        // Upload da nova foto
        if ($request->hasFile('foto')) {// verifica se tem arquivo de foto novo
            // Deletar foto antiga se existir
            if ($funcionario->foto) {
                $caminhoAntigo = public_path('uploads/funcionarios/' . $funcionario->foto);
                if (file_exists($caminhoAntigo)) {
                    unlink($caminhoAntigo);
                }
            }

            $foto = $request->file('foto');
            $nomeArquivo = time() . '_' . $foto->getClientOriginalName();
            
            // Criar diretório se não existir
            $caminho = public_path('uploads/funcionarios');
            if (!file_exists($caminho)) {
                mkdir($caminho, 0755, true);
            }
            
            // Mover arquivo para pasta pública
            $foto->move($caminho, $nomeArquivo);
            $data['foto'] = $nomeArquivo;
        }

        $funcionario->update($data);

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
                         ->with('success', 'Funcionário deletado com sucesso!');
    }
}
