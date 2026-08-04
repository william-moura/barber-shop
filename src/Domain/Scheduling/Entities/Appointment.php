<?php

namespace Src\Domain\Scheduling\Entities;

use Illuminate\Database\Eloquent\Model;
use Src\Domain\Scheduling\ValueObjects\TimeSlot;

class Appointment extends Model
{
    protected $fillable = [
        'barber_id', 
        'client_id', 
        'service_id', 
        'start_time', 
        'end_time', 
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Named constructor para aplicar regras do DDD ao criar
    public static function createWithSlot(int $barberId, int $clientId, int $serviceId, TimeSlot $slot): self
    {
        return new self([
            'barber_id' => $barberId,
            'client_id' => $clientId,
            'service_id' => $serviceId,
            'start_time' => $slot->startTime,
            'end_time' => $slot->endTime,
            'status' => 'pending'
        ]);
    }
}
