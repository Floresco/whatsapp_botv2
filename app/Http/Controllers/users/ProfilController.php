<?php

namespace App\Http\Controllers\users;

use App\Helpers\CodeStatus;
use App\Helpers\Utils;
use App\Http\Controllers\BaseController;
use App\Models\users\AccessRight;
use App\Models\users\ProfilAccess;
use App\Models\users\UserProfil;
use App\Traits\SelectMenu;
use Illuminate\Http\Request;

class ProfilController extends BaseController
{
    use SelectMenu;

    public function __construct()
    {
        $this->setSelectMenu('PROFIL');
    }

    public function index()
    {
        $this->authorize("manage_profil", "READ");
        $this->select_smenu = "READ_PROFIL";
        $this->select_menu();

        $profils = UserProfil::query()
            ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
            ->where('name', '<>', CodeStatus::USER_PROFIL_SUPER_ADMIN)
            ->get()->all();

        $this->setTitle(trans('messages.liste_profil_menu'));

        return view('users.profil.index', ['title' => $this->getTitle(), 'profils' => $profils]);
    }

    public function create()
    {
        $this->authorize("manage_profil", "CREATE");
        $this->select_smenu = "ADD_PROFIL";
        $this->select_menu();

        $user_module = [];
        $model = null;
        $access_rights = AccessRight::query()->where('etat', CodeStatus::ETAT_ACTIVE)->get()->all();

        $this->setTitle(trans('messages.add_profil_menu'));

        return view('users.profil.form', ['title' => $this->getTitle(), 'model' => $model, 'user_module' => $user_module, 'access_rights' => $access_rights]);

    }

    public function store(Request $request)
    {
        $this->authorize("manage_profil", "CREATE");
        $this->select_smenu = "ADD_PROFIL";
        $this->select_menu();

        $post = $request->all();
//        TODO 1. Mettre en place la validation

        $user_module = [];

        $module_ids_recup = $post['all_module'];

        if (trim($post['name'] != '')) {
            $module_ids = explode('_', $module_ids_recup);
            $all_module = '';

            if (sizeof($module_ids) > 0) {
                foreach ($module_ids as $module_id) {
                    $create_info = "0";
                    $delete_info = "0";
                    $read_info = "0";
                    $update_info = "0";

                    if (isset($post[$module_id . '_CREATE'])) {
                        if ($post[$module_id . '_CREATE'] == 1) $create_info = 1;
                    }
                    if (isset($post[$module_id . '_LIST'])) {
                        if ($post[$module_id . '_LIST'] == 1) $read_info = 1;
                    }

                    if (isset($post[$module_id . '_UPDATE'])) {
                        if ($post[$module_id . '_UPDATE'] == 1) $update_info = 1;
                    }

                    if (isset($post[$module_id . '_DELETE'])) {
                        if ($post[$module_id . '_DELETE'] == 1) $delete_info = 1;
                    }

                    $information = $module_id . '_' . $create_info . '_' . $read_info . '_' . $update_info . '_' . $delete_info;


                    if ($information != $module_id . "_0_0_0_0") {
                        if ($all_module == "") {
                            $all_module = $information;
                        } else {
                            $all_module .= ";" . $information;
                        }
                    }
                }

                $test_name = UserProfil::query()
                    ->where('name', $post['name'])
                    ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
                    ->first();

                if ($test_name != null) {
                    $message = trans('messages.profil_exist');
                    $user_module = $this->createProfilAccess([
                        'all_module' => $all_module,
                        'profil_id' => null,
                        'user_id' => auth()->user()->id
                    ]);
                } else {
                    date_default_timezone_set('UTC');

                    $new_profil = new UserProfil();
                    $new_profil->name = $post['name'];
                    $new_profil->description = $post['description'];
                    $new_profil->etat = 1;
                    $new_profil->created_by = auth()->user()->id;
                    $new_profil->created_at = date("Y-m-d H:i:s");

                    if ($new_profil->save()) {
                        $user_module = $this->createProfilAccess([
                            'all_module' => $all_module,
                            'profil_id' => $new_profil->id,
                            'user_id' => auth()->user()->id
                        ], true);
                        return redirect()->route('profil.index')->with('success', trans('messages.profil_succes'));
                    } else {
                        $message = trans('messages.update_error');

                    }
                }
            } else {
                $message = trans('messages.update_error');

            }
        } else {
            $message = trans('messages.profil_empty');
        }
        \Session::flash('error', $message);
        return back()->withInput()->with('user_module', $user_module);
    }


    private function createProfilAccess(array $data, bool $action_save = false)
    {
        $user_module = [];
        $sync_data = [];
        $array_all_module = explode(';', $data['all_module']);
        foreach ($array_all_module as $module) {
            $info_module = explode('_', $module);
            if (sizeof($info_module) == 5) {
                if ($action_save) {
                    $sync_data[$info_module[0]] = [
                        'pcreate' => $info_module[1],
                        'pread' => $info_module[2],
                        'pupdate' => $info_module[3],
                        'pdelete' => $info_module[4],
                        'created_by' => $data['user_id']
                    ];
                } else {
                    $new_access = new ProfilAccess();
                    $new_access->user_profil_id = $data['profil_id'];
                    $new_access->access_right_id = $info_module[0];
                    $new_access->pcreate = $info_module[1];
                    $new_access->pread = $info_module[2];
                    $new_access->pupdate = $info_module[3];
                    $new_access->pdelete = $info_module[4];
                    $new_access->created_by = $data['user_id'];
                    $new_access->etat = 1;
                    $new_access->created_at = date("Y-m-d H:i:s");
                    $user_module[] = $new_access;
                }
            }
        }
        $profil = UserProfil::query()->where('id', $data['profil_id'])->get()->first();
        if ($profil) {
            $profil->access_rights()->sync($sync_data);
        }
        return $user_module;
    }


    public function edit(UserProfil $profil)
    {
        $this->authorize("manage_profil", "UPDATE");
        $this->select_smenu = "READ_PROFIL";
        $this->select_menu();

        $user_module = ProfilAccess::query()
            ->where('user_profil_id', $profil->id)
            ->where('etat', CodeStatus::ETAT_ACTIVE)
            ->get()->all();
        $access_rights = AccessRight::query()
            ->where('etat', CodeStatus::ETAT_ACTIVE)
            ->get()->all();
        $model = $profil;

        $this->setTitle(trans('messages.update_information') . ":" . $profil->name);

        return view('users.profil.form', ['title' => $this->getTitle(), 'model' => $model, 'user_module' => $user_module, 'access_rights' => $access_rights]);
    }

    public function update(UserProfil $profil, Request $request)
    {
        $this->authorize("manage_profil", "UPDATE");
        $this->select_smenu = "READ_PROFIL";
        $this->select_menu();

        $post = $request->all();
//        TODO 1. Mettre en place la validation

        $user_module = [];

        $module_ids_recup = $post['all_module'];

        if (trim($post['name'] != '')) {
            $module_ids = explode('_', $module_ids_recup);
            $all_module = '';

            if (sizeof($module_ids) > 0) {
                foreach ($module_ids as $module_id) {
                    $create_info = "0";
                    $delete_info = "0";
                    $read_info = "0";
                    $update_info = "0";

                    if (isset($post[$module_id . '_CREATE'])) {
                        if ($post[$module_id . '_CREATE'] == 1) $create_info = 1;
                    }
                    if (isset($post[$module_id . '_LIST'])) {
                        if ($post[$module_id . '_LIST'] == 1) $read_info = 1;
                    }

                    if (isset($post[$module_id . '_UPDATE'])) {
                        if ($post[$module_id . '_UPDATE'] == 1) $update_info = 1;
                    }

                    if (isset($post[$module_id . '_DELETE'])) {
                        if ($post[$module_id . '_DELETE'] == 1) $delete_info = 1;
                    }

                    $information = $module_id . '_' . $create_info . '_' . $read_info . '_' . $update_info . '_' . $delete_info;


                    if ($information != $module_id . "_0_0_0_0") {
                        if ($all_module == "") {
                            $all_module = $information;
                        } else {
                            $all_module .= ";" . $information;
                        }
                    }
                }

                $test_name = UserProfil::query()
                    ->where('name', $post['name'])
                    ->where('id', '<>', $post['key'])
                    ->whereIn('etat', [CodeStatus::ETAT_ACTIVE, CodeStatus::ETAT_INACTIVE])
                    ->first();

                if ($test_name != null) {
                    $message = trans('messages.profil_exist');
                    $user_module = $this->createProfilAccess([
                        'all_module' => $all_module,
                        'profil_id' => null,
                        'user_id' => auth()->user()->id
                    ]);
                } else {
                    date_default_timezone_set('UTC');

                    $profil->name = $post['name'];
                    $profil->description = $post['description'];
                    $profil->updated_by = auth()->user()->id;
                    $profil->updated_at = date("Y-m-d H:i:s");

                    if ($profil->save()) {
//                        $profil->access_rights()->sync([]);
                        $this->createProfilAccess([
                            'all_module' => $all_module,
                            'profil_id' => $profil->id,
                            'user_id' => auth()->user()->id
                        ], true);
                        return redirect()->route('profil.index')->with('success', trans('messages.profil_succes'));
                    } else {
                        $message = trans('messages.update_error');

                    }
                }
            } else {
                $message = trans('messages.update_error');

            }
        } else {
            $message = trans('messages.profil_empty');
        }
        \Session::flash('error', $message);
        return back()->withInput()->with('user_module', $user_module);
    }

    public function destroy(UserProfil $profil)
    {

    }

    public function operation(UserProfil $profil, Request $request)
    {
        $this->authorize("manage_profil", "DELETE");

        $post = $request->all();
        $message = trans('messages.update_error');
        switch ($post['operation']) {
            case 1:
                $profil->etat = $post['operation'];
                $message = trans('messages.active_profil_success');
                break;
            case 2:
                $profil->etat = $post['operation'];
                $message = trans('messages.desactive_profil_success');
                break;
            case 3:
                $profil->etat = $post['operation'];
                $message = trans('messages.delete_profil_success');
                $profil->access_rights()->update(['etat' => CodeStatus::ETAT_DELETE]);
                break;
        }
        if ($profil->save()) {
            \Session::flash('success', $message);
            return redirect()->route('profil.index');
        }
        \Session::flash('error', $message);
        return redirect()->back();
    }

}
