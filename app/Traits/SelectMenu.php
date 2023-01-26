<?php

namespace App\Traits;

trait SelectMenu
{
    public function select_menu(): void
    {
        \Session::flash('menu', [
            'select_menu' => $this->getSelectMenu(),
            'select_smenu' => $this->getSelectSMenu(),
        ]);
    }

}
