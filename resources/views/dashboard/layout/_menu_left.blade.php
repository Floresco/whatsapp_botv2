<?php

$select_menu = null;
$select_smenu = null;
if (session()->has('menu')) {
    $menu = session()->get('menu');
    $select_menu = $menu['select_menu'];
    $select_smenu = $menu['select_smenu'];
}

$sub_menu = ' active';
$sub_smenu = ' active';

$manage_dashboard = \App\Helpers\Utils::have_access("manage_dashboard");
?>

@if($manage_dashboard != "0_0_0_0" )
    <li class="nav-item">
        <a class="nav-link menu-link <?= $select_menu === 'BOARD' ? $sub_menu : null ?>" href="{{route('dashboard')}}"
           aria-expanded="false">
            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">{{trans('messages.dashboard')}}</span>
        </a>
    </li>
    <!-- end Dashboard Menu -->
@endif


