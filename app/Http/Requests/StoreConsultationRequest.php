<?php

namespace App\Http\Requests;

use App\Consultation;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class StoreConsultationRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('consultation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'title'       => [
                'required',
            ],
            //'employee_id'   => [
            //    'required',
            //    'integer',
            //],
            'nday'   => [
                'required',
                'integer',
            ],
            'start'  => [
                'required',
                //'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            //'end' => [
            //    'required',
            //    'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            //],
        ];
    }
}
