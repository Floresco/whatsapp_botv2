<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected string $title = "APP";
    protected string $select_menu = "";
    protected string $select_smenu = "";

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSelectMenu(): string
    {
        return $this->select_menu;
    }

    /**
     * @param string $select_menu
     */
    public function setSelectMenu(string $select_menu): void
    {
        $this->select_menu = $select_menu;
    }

    /**
     * @return string
     */
    public function getSelectSmenu(): string
    {
        return $this->select_smenu;
    }

    /**
     * @param string $select_smenu
     */
    public function setSelectSmenu(string $select_smenu): void
    {
        $this->select_smenu = $select_smenu;
    }



}
