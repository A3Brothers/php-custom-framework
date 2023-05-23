<?php

namespace App\Event;

use SplSubject;

class RegisterEvent implements SplSubject 
{
    private $observers = [];

    public function __construct(public $email, public $name, public $subject) 
    {

    }

    public function attach(\SplObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(\SplObserver $observer): void
    {
        $key = array_search($observer, $this->observers);
        if($key) {
            unset($this->observers[$key]);
        }
    }

    public function notify(): void
    {
        foreach($this->observers as $observer) {
            $observer->update($this);
        }
    }
}