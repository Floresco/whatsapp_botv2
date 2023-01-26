<?php

use App\Helpers\Utils;

$select_menu = null;
$select_smenu = null;
if (session()->has('menu')) {
    $menu = session()->get('menu');
    $select_menu = $menu['select_menu'];
    $select_smenu = $menu['select_smenu'];
}

$sub_menu = ' active';
$sub_smenu = ' active';

$manage_whatsapp = Utils::have_access("manage_whatsapp");
?>

@if($manage_whatsapp != "0_0_0_0" )
    <li class="menu-title"><i class="ri-more-fill"></i> <span
            data-key="t-pages">{{trans('messages.network_manage')}}</span>
    </li>

    @if ($manage_whatsapp != "0_0_0_0")
        @php
            $test = explode('_', $manage_whatsapp)
        @endphp
        <li class="nav-item">
            <a class="nav-link menu-link <?= $select_menu == "WHATSAPP" ? $sub_menu : null ?>" href="#sidebarWhatsapp" data-bs-toggle="collapse" role="button"
               aria-expanded="false" aria-controls="sidebarWhatsapp">
                <i class="ri-whatsapp-line"></i>
                <span data-key="t-whatsapp">
                    {{trans('messages.manage_whatsapp')}}
                </span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarWhatsapp">
                <ul class="nav nav-sm flex-column">
                    @if ($test[0] == 1)
                        <li class="nav-item">
                            <a href="#" class="nav-link <?= $select_smenu == 'ADD_WHATSAPP' ? $sub_smenu : null ?>" data-key="t-add-whatsapp">
                                {{trans('messages.add_whatsapp_menu')}}
                            </a>
                        </li>
                    @endif

                    @if ($test[1] == 1 or $test[2] == 1 or $test[3] == 1)

                        <li class="nav-item">
                            <a href="{{route('whatsapp.index')}}" class="nav-link <?= $select_smenu == 'READ_WHATSAPP' ? $sub_smenu : null ?>">
                                <span data-key="t-list-whatsapp">
                                    {{trans('messages.liste_discussions')}}
                                </span>
                            </a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
        <!-- end whatsapp Menu -->
    @endif
@endif


