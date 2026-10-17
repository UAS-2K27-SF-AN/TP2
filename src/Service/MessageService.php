<?php

namespace App\Service;

class MessageService
{
    public function getDailyMessage(): string
    {
        $messages = [
            'Apprends un peu chaque jour.',
            'Symfony on ton ami.',
            'Code propre, esprit clair.',
            'La persévérance paie.',
        ];

        return $messages[array_rand($messages)];
    }
}
