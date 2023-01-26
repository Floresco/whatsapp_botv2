<?php

namespace App\Providers;

use App\Helpers\Utils;
use App\Models\AccessRight;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {


        $this->registerPolicies();
        try {
            $access_rights = [];


            $access_rights = AccessRight::query()
                ->select(['wording'])
                ->get()->toArray();

            foreach ($access_rights as $access_right) {
                Gate::define($access_right['wording'], function (User $user, string $type) use ($access_right) {
                    return Utils::RuleV2($access_right['wording'], $type);
                });
            }
        } catch (QueryException $e) {
            return false;
        }
    }
}
