<?php

namespace App\Helpers;

use App\Models\users\AccessRight;
use App\Models\users\ProfilAccess;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Utils
{
    public static function Rule(string $wording_access_right, $type_operation)
    {
        $user = auth()->user();
        if ($user) {
            $user_profil_id = $user->user_profil_id;
            $user_parent_id = $user->user_parent_id;
            $plus = "";
            $position = 0;
            if ($user_parent_id == 0) {
                $position = 1;
            } else {
                $query = ProfilAccess::query()
                    ->join('access_rights', 'access_rights.id', '=', 'profil_access.access_right_id')
                    ->join('user_profils', 'user_profils.id', '=', 'profil_access.user_profil_id')
                    ->where([
                        ['user_profils.id', '=', $user_profil_id],
                        ['access_rights.wording', '=', $wording_access_right],
                        ['profil_access.etat', '=', CodeStatus::ETAT_ACTIVE]
                    ]);
                if ($type_operation == 'CREATE') {
                    $query->where('profil_access.pcreate', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'UPDATE') {
                    $query->where('profil_access.pupdate', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'DELETE') {
                    $query->where('profil_access.pdelete', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'READ') {
                    $query->where('profil_access.pread', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'ALL') {
                    $query->where([
                        ['profil_access.pcreate', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pupdate', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pdelete', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pread', '=', CodeStatus::ETAT_ACTIVE],
                    ]);
                }
                $profil_access = $query->get()->toArray();
                $position = sizeof($profil_access);
            }
            if ($position != 1) {
                abort(403);
            }
        } else {
            abort(401);
        }
    }

    public static function RuleV2(string $wording_access_right, $type_operation): bool
    {
        $return = false;
        $user = auth()->user();
        if ($user) {
            $user_profil_id = $user->user_profil_id;
            $user_parent_id = $user->user_parent_id;
            if ($user_parent_id == 0) {
                $position = 1;
            } else {
                $query = ProfilAccess::query()
                    ->join('access_rights', 'access_rights.id', '=', 'profil_access.access_right_id')
                    ->join('user_profils', 'user_profils.id', '=', 'profil_access.user_profil_id')
                    ->where([
                        ['user_profils.id', '=', $user_profil_id],
                        ['access_rights.wording', '=', $wording_access_right],
                        ['profil_access.etat', '=', CodeStatus::ETAT_ACTIVE]
                    ]);
                if ($type_operation == 'CREATE') {
                    $query->where('profil_access.pcreate', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'UPDATE') {
                    $query->where('profil_access.pupdate', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'DELETE') {
                    $query->where('profil_access.pdelete', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'READ') {
                    $query->where('profil_access.pread', '=', CodeStatus::ETAT_ACTIVE);
                }
                if ($type_operation == 'ALL') {
                    $query->where([
                        ['profil_access.pcreate', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pupdate', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pdelete', '=', CodeStatus::ETAT_ACTIVE],
                        ['profil_access.pread', '=', CodeStatus::ETAT_ACTIVE],
                    ]);
                }
                $profil_access = $query->get()->toArray();
                $position = sizeof($profil_access);
            }
            if ($position == 1) {
                $return = true;
            }
        }
        return $return;
    }

    public static function have_access(string $wording_access_right): string|RedirectResponse
    {
        try {

            $position = "0_0_0_0";

            $user = \Auth::user();

            if ($user) {

                if ($user->user_parent_id == 0) {
                    $position = "1_1_1_1";
                } else {
                    $profil_access = ProfilAccess::query()
                        ->join('access_rights', 'access_rights.id', '=', 'profil_access.access_right_id')
                        ->where('access_rights.wording', '=', $wording_access_right)
                        ->where('profil_access.user_profil_id', '=', $user->user_profil_id)->get()->all();
                    if (sizeof($profil_access) == 1) {
                        $position = $profil_access[0]['pcreate'] . "_" . $profil_access[0]['pread'] . "_" . $profil_access[0]['pupdate'] . "_" . $profil_access[0]['pdelete'];
                    }
                }
            }

            return $position;
        } catch (\Exception $e) {
            return redirect()->route('login');
        }
    }

    public static function emptyContent(): string
    {
        return '<div class="alert alert-danger alert-dismissible alert-solid alert-label-icon fade show" role="alert">
    <i class="ri-error-warning-line label-icon"></i><strong>' . trans('messages.liste_empty') . '</strong>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }

    public static function required(): string
    {
        return ' <span style="color:red">**</span>';
    }

    public static function reset_btn(): string
    {
        return '<button type="reset" name="Reset" class="btn btn-sm btn-danger bg-gradient-dark float-end" style="margin-left:10px;margin-right:20px">' . trans('messages.resetbutton') . '</button>';
    }

    public static function back_btn(string $url, array $params = []): string
    {
        return '<a href="' . route($url, $params) . '" class="btn btn-sm btn-info bg-gradient-dark float-end" style="margin-left:10px;margin-right:20px">' . trans('messages.back') . '</a>';
    }

    public static function submit_btn(): string
    {
        return '<button type="submit" id="updatebutton" class="btn btn-primary btn-sm float-end mb-0" name="updatebutton">' . trans('messages.submitbutton') . '</button>';
    }
}
