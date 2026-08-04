<?php

namespace Src\Domain\Scheduling\Actions;


use Src\Domain\Scheduling\Entities\Appointment;
use Src\Domain\Scheduling\ValueObjects\TimeSlot;
use Src\Domain\Scheduling\Exceptions\SlotAlreadyBookedException;
use Carbon\Carbon;

class CreateAppointmentAction
{
    public function execute(int $barberId, int $clientId, int $serviceId, Carbon $startTime, int $durationMinutes): Appointment
    {
        $endTime = $startTime->copy()->addMinutes($durationMinutes);
        $slot = new TimeSlot($startTime, $endTime);

        // Verifica se o barbeiro já tem agendamento que colida com esse horário
        $hasConflict = Appointment::where('barber_id', $barberId)
            ->where('status', '!=', 'cancelled')
            ->where(function ($query) use ($slot) {
                $query->whereBetween('start_time', [$slot->startTime, $slot->endTime->subSecond()])
                      ->orWhereBetween('end_time', [$slot->startTime->addSecond(), $slot->endTime]);
            })->exists();

        if ($hasConflict) {
            throw new SlotAlreadyBookedException('Este barbeiro já possui um agendamento neste horário.');
        }

        $appointment = Appointment::createWithSlot($barberId, $clientId, $serviceId, $slot);
        $appointment->save();

        // Aqui dispararemos o evento para envio de WhatsApp no futuro
        // event(new AppointmentCreated($appointment));

        return $appointment;
    }
}
