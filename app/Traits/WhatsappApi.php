<?php

namespace App\Traits;

use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

trait WhatsappApi
{
    public function getWCA(): WhatsAppCloudApi
    {
        return new WhatsAppCloudApi([
            'from_phone_number_id' => '104483782415875',
            'access_token' => 'EAAMfNlK3ZAVkBACwQTbVYCVyp9o9E5THjf2uVTntZA9tmmMQms0aToIzX3aNZAMiTS9Az6uOm1i461DU90uVdYXv8jNUIA4wZAtNzmmLA0kB4ZClQll9BjNTH6u2rcxBaXqYMNNRAxIEWXBgaanbXrOLc1jxeaOWiBKL4DggzNC9LmGKA0xatKbKleyVtqtu9UjIli6ppw0lhWGpz3z0o',
        ]);
    }
}
