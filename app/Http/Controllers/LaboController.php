<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\AccessRight;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class LaboController extends BaseController
{

    public function index()
    {
        $this->setTitle('Hehehe');

        return view('labo_index', ['title' => $this->getTitle()]);
    }

    private function test_gate(User $user, string $type)
    {

        $user = auth()->user();
        if ($user->user_parent_id == 0) {
            $access_rights = AccessRight::query()->select(['wording'])->get()->toArray();
        } else {
            $access_rights = AccessRight::query()
                ->join('profil_access', 'access_rights.id', '=', 'profil_access.access_right_id')
                ->select(['wording'])->where([
                    ['profil_access.user_profil_id', '=', $user->user_profil_id]
                ])->get()->toArray();
        }

        foreach ($access_rights as $key => $access_right) {
            var_dump($access_right['wording']);
        }

        return Utils::RuleV2('manage_dashboard', $type);
    }
}
