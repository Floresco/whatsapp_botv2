<?php

namespace App\Http\Controllers\whatsapp;

use App\Http\Controllers\BaseController;
use App\Traits\SelectMenu;
use App\Traits\WhatsappApi;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Netflie\WhatsAppCloudApi\Response\ResponseException;
use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

class WhatsappController extends BaseController
{
    use SelectMenu, WhatsappApi;

    public WhatsAppCloudApi $whatsAppCloudApi;

    public function __construct()
    {
        $this->setSelectMenu('WHATSAPP');
        $this->whatsAppCloudApi = $this->getWCA();

    }

    /**
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize("manage_whatsapp", "READ");
        $this->select_smenu = "READ_WHATSAPP";
        $this->select_menu();

        $this->setTitle(trans('messages.liste_discussions'));


        return view('whatsapp.index', ['title' => $this->getTitle()]);
    }

    /**
     * @throws ResponseException
     */
    public function sendMessage(Request $request)
    {
        if ($request->isMethod('POST') && $request->ajax()) {
            return json_encode($this->whatsAppCloudApi->sendTextMessage('22870704170', 'Hey there! I\'m using WhatsApp Cloud API.'));
        }
    }
}
