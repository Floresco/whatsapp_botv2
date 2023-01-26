<?php

namespace App\Helpers;

class CodeStatus
{
    const ETAT_ACTIVE = 1; // les données activées
    const ETAT_INACTIVE = 2; // les données non activées
    const ETAT_DELETE = 3; // les données supprimées

    const USER_PROFIL_SUPER_ADMIN = 'Super Admin';
    const USER_PROFIL_ADMIN = 'Admin';

//
    const USER_VERIFIED = 10;
    const USER_UNVERIFIED = 20;
}
