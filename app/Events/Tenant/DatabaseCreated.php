<?php

namespace App\Events\Tenant;

use App\Models\Tenant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DatabaseCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    protected Tenant $tenant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
    }

    public function tenant(): Tenant
    {
        return $this->tenant;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
