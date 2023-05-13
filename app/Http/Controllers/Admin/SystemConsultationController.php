<?php

namespace App\Http\Controllers\Admin;
use App\Consultation;
use App\Employee;
use App\User;
use App\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConsultationRequest;
use App\Http\Requests\UpdateConsultationRequest;
use Gate, Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemConsultationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Para buscar el id del médico a partir del email
        $use_emailc = Auth::user()->email;
        $employee_ec = Employee::all();
        foreach ($employee_ec as $email_empc):
            if ($email_empc->email == $use_emailc):
                $employee_idc = $email_empc->id;
                $consultations = Consultation::where('employee_id', $employee_idc)->get();
            endif;
        endforeach;
        if(is_null($employee_idc)):
            $employee_idc = 0;
            $consultations = Consultation::with(['consultation_employee'])->get();
        endif;
        $events = [];

        
        

        foreach ($consultations as $consultation) {
            if (!$consultation->start) {
                continue;
            }

            $events[] = [
                'title' => $consultation->title,
                'nday'  => $consultation->nday,
                'employee_id' => $consultation->employee_id,
                'start' => $consultation->start,
                'url'   => route('admin.consultation.edit', $consultation->id),
            ];
        }

        return view('admin.consultation.index', compact('events','employee_idc')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Para buscar el id del médico a partir del email
        $use_emailc = Auth::user()->email;
        $employee_ec = Employee::all();
        foreach ($employee_ec as $email_empc):
            if ($email_empc->email == $use_emailc):
                $employee_idc = $email_empc->id;
            endif;
        endforeach;
        if(is_null($employee_idc)):
            $employee_idc = 0;
        endif;

        return view('admin.consultation.create' , compact('employee_idc'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreConsultationRequest $request)
    {
        // Para buscar el dia de consulta este disponible
        $start_d = Consultation::all();
        
        foreach ($start_d as $start_day):
            if ($start_day->start == $request->input('start') && $request->input('employee_id')<>0):
                $encon = true;
            endif;
        endforeach;
        if($encon):
              return back()->with('message', 'Ya tienes Consulta ese dia.')->with('typealert','danger')->withInput();
        else:
            $request->input('end') == $request->input('start');
            $consultation = Consultation::create($request->all());

            return redirect()->route('admin.consultation.index');
        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        abort_if(Gate::denies('consultation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.consultation.edit', compact('consultation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {

        $consultation->update($request->all());

        return redirect()->route('admin.consultation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
