<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Models\Organizacoes;
use App\Models\Areas;
use App\Models\Usuarios;
use App\Models\User;
use App\Models\Role_User;
use App\Providers\UtilServiceProviders;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Log;
use DB;
use Auth;
use Gate;
use Response;
class OrganizacoesController extends Controller
{

  // Autenticação obrigatória
  public function __construct()
  {
      $this->middleware('auth');
  }


  public function index()
  {
    /*  if (Gate::denies('admin-post')) //{
      {
          return Redirect::back();
      }*/

      $user_id = Auth::user()->id;
      $organizacoes = DB::table('organizacoes')->get();
      #dd($organizacoes);
      return view('organization.index', compact('organizacoes'));
  }

  public function create()
  {
    /*  if (Gate::denies('admin-post')) //{
      {
          return Redirect::back();
      }*/

      return view('organization.create');
  }


  public function store(Request $request)
    {
        // Criar actividades
        #try {
        #DB::beginTransaction();
        $util = new UtilServiceProviders;
        $Organizacoes = new Organizacoes;
        $Organizacoes->name_org = $request->get("name_org");
        $Organizacoes->nif_org = $request->get("nif_org");
        #dd($Organizacoes->logo_org = $request->get("logo_org"));

        // Validação
        #$request->validate([
        #'logo_org' => 'required|file|mimes:jpg,png,pdf,docx|max:2048', // 2MB máx.
        #]);

        if ($request->hasFile('logo_org')) {
          // Validação
          $request->validate([
          'logo_org' => 'required|file|mimes:jpg,png,pdf,docx|max:2048', // 2MB máx.
          ]);


            // Recupera o arquivo
            $uploadedFile = $request->file('logo_org');

            // Pega o nome original
            $originalName = $uploadedFile->getClientOriginalName();

            // Remover espaços e caracteres especiais
            $fileName = str_replace(' ', '_', $originalName);
            // Salva o arquivo no diretório desejado
            $path = $uploadedFile->storeAs('img/users', $util->RandomString(5).".".$fileName, 'public');

            // Salva o caminho no modelo
            $Organizacoes->logo_org = $path;
        } else {
            // Define um logo padrão se nenhum arquivo for enviado
            $Organizacoes->logo_org = 'logopadrao.png';
        }

        $Organizacoes->telefone_org = $request->get("telefone_org");
        $Organizacoes->email_org = $request->get("email_org");
        $Organizacoes->provincia_org = $request->get("provincia_org");
        $Organizacoes->regime_org = $request->get("regime_org");
        $Organizacoes->descricao_org = $request->get("descricao_org");
        #dd($Organizacoes);
        $Organizacoes->save();

        /*/ Criar área automática
        $Area = new Areas;
        $Area->org_id = $Organizacoes->id;
        $Area->name_area = '$request->get("nome_area")';
        $Area->slogan_area = $request->get("slogan_area");
        $Area->telefone_area = $request->get("telefone_org");
        $Area->email_area = $request->get("email_org");
        $Area->descricao_area = $request->get("descricao_org");
        #dd($Area);
        */
        $Area = DB::table('areas')->first();
        #dd($Area->name_area);
        $usuarios = new User;//
        $usuarios->user_id_area=$Area->id;
        $usuarios->name=$Area->name_area;
        $usuarios->profile_photo_path=$Organizacoes->logo_org;
        $usuarios->email= $Organizacoes->email_org;
        $usuarios->password= bcrypt($Organizacoes->nif_org);
        $usuarios->condicao_user="Activo";

        #dd($usuarios);
        $usuarios->save();

        $role_users = new Role_User;
        $role_users->user_id=$usuarios->id;//("role");
        $role_users->role_id=2;
        //dd($role_users);
        $role_users->save();

        return Redirect::to("organization");
     }

}
