<?php

namespace App\Listeners;

use App\Notifications\DiscordNotification;
use OwenIt\Auditing\Events\Audited;

class AuditedListener
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
    public function handle(Audited $event): void
    {
        if (! get_setting('feature_use_discord_audit_log', 0)) {
            return;
        }
        $old_values = $event->audit->old_values;
        $new_values = $event->audit->new_values;
        $event_type = $event->audit->event;
        $event_model_array = explode('\\', $event->audit->auditable_type);
        $event_model = $event_model_array[count($event_model_array) - 1];

        switch ($event_type) {
            case 'created':
                $color = 5763719;
                break;

            case 'updated':
                $color = 3447003;
                break;

            case 'deleted':
                $color = 15548997;
                break;

            default:
                $color = 15548997;
                break;
        }
        // dd(strtolower($event_model));
        $notification = (new DiscordNotification)->channel('audit_log_'.strtolower($event_model))->embed(
            $event_model.'s have been '.$event_type,
            auth()->user()->name.' has '.$event_type.' a(n) '.$event_model,
            $color,
            [
                [
                    'name' => 'Old',
                    'value' => json_encode($old_values),
                ],
                [
                    'name' => 'New',
                    'value' => json_encode($new_values),
                ],
                [
                    'name' => 'User ID',
                    'value' => $event->audit->user_id,
                ],
                [
                    'name' => 'Audit Log Entry',
                    'value' => $event->audit->id,
                ],
                [
                    'name' => 'Actioned At',
                    'value' => $event->audit->created_at->format('m/d/y H:i:s'),
                ],
            ]
        )->send();
    }
}
