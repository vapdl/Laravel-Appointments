<?php

namespace App\Http\Controllers\Admin;

use App\Employee;
use Auth;
use App\Appointment;
use App\Http\Controllers\Controller;

class SystemCalendarController extends Controller
{

    public function index()
    {
        // Para buscar el id del médico a partir del email
        $use_emailc = Auth::user()->email;
        $employee_ec = Employee::all();
        $employee_idc = 0;
        foreach ($employee_ec as $email_empc):
            if ($email_empc->email == $use_emailc):
                $employee_idc = $email_empc->id;
                $appointments = Appointment::where('employee_id', $employee_idc)->get();
            endif;
        endforeach;
        if($employee_idc == 0):
            $appointments = Appointment::with(['client', 'employee'])->get();
        endif;
        $events = [];

        $appointments = Appointment::with(['client', 'employee'])->get();

        foreach ($appointments as $appointment) {
            if (!$appointment->start_time) {
                continue;
            }

            $events[] = [
                'title' => $appointment->client->name . ' ('.$appointment->employee->name.')',
                'start' => $appointment->start_time,
                'url'   => route('admin.appointments.edit', $appointment->id),
            ];
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
