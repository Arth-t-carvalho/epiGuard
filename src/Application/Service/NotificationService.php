<?php
declare(strict_types = 1)
;

namespace App\Application\Service;

use App\Domain\Entity\User;
use App\Domain\Entity\Occurrence;

class NotificationService
{
    // Would inject MailerInterface, SMSInterface etc depending on needs

    public function __construct()
    {
    }

    public function notifyOccurrenceCreation(Occurrence $occurrence, array $usersToNotify): void
    {
    // Example logic:
    // foreach ($usersToNotify as $user) {
    //     $this->mailer->send($user->getEmail(), "New Occurrence Registered", "...");
    // }
    }

    public function notifyOccurrenceResolution(Occurrence $occurrence, array $usersToNotify): void
    {
    // Implementation for resolution notification
    }
}
