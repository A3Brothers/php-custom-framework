<?php

namespace App\Listener;

use SplObserver;

class RegisterListener implements SplObserver
{
    public function update(\SplSubject $subject): void
    {
        echo "Emailing to: " .$subject->email. " and name: " .$subject->name. " and subject: " .$subject->subject;
    }
}