<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TimeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $edit = $this->has('time');

        return [
            'project_id' => [
                'required',
                'numeric',
                'exists:projects,id',
            ],
            'activity_id' => [
                'required',
                'numeric',
                'exists:activities,id',
            ],
            'description' => [
                'required',
                'string',
                'max:255',
            ],
            'previous' => [
                'nullable',
                'boolean',
            ],
            'date' => [
                $edit ? 'required' : 'required_if:previous,true',
                'string',
                'date_format:Y-m-d',
            ],
            'started' => [
                $edit ? 'required' : 'required_if:previous,true',
                'string',
                'date_format:H:i',
            ],
            'finished' => [
                $edit ? 'required' : 'required_if:previous,true',
                'string',
                'date_format:H:i',
                'after:started',
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $edit = $this->has('time');
        if ($edit) {
            return;
        }

        $validator->after(function ($validator) {
            if (!$this->previous && $this->user()->hasTimerRunning()) {
                $validator->errors()->add('error', 'It seems you already have a timer running.');
            }
        });
    }

    /**
     * Get the validated data from the request.
     *
     * @return array
     */
    public function validated()
    {
        $edit = $this->has('time');
        $data = parent::validated();

        if (!$edit) {
            $data['user_id'] = $this->user()->id;
        }

        // Convert started/finished into date with time
        if (empty($data['started'])) {
            $data['started'] = Carbon::now()->format('Y-m-d H:i');
        } else {
            $data['started'] = $data['date'] . ' ' . $data['started'];
            $data['finished'] = $data['date'] . ' ' . $data['finished'];
        }
        unset($data['date']);

        return $data;
    }
}
