<?php

namespace App\Listeners;

use App\Mail\AlertaLoginCorreo;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class EnviarCorreo
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $usuario = $event->user;

        $key = 'login_' . $usuario->id;

        if (Cache::has($key)) {
            return;
        }

        Cache::put($key, true, now()->addMinutes(10));

        Mail::to($usuario->email)->send(new AlertaLoginCorreo($usuario));

    }
}
