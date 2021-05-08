<?php

namespace App\Http\Controllers;

use App\Mail\EmailTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Email;


class EmailController extends Controller
{
    private $validateArray = [
        'email_address' => 'required|email|max:255',
        'message' => 'required',
        'attachment.file.data' => 'string',
        'attachment_filename' => 'string|max:255'
    ];
    /**
     * @param Request $request
     * @return string
     */
    public function queueEmail(Request $request)
    {
        $validation = Validator::make($request->all(), $this->validateArray);

        if ($validation->fails()) {
            return response()->json([
                'message' => 'Email Failed',
                'data' => $validation->errors()
            ]);
        }
        $email = New Email;
        $email->fill($request->all());

        if ($request->attachment && $request->attachment_filename) {
            $file = $request->attachment['file'];
            $data = base64_decode($file['data']);
            Storage::disk('local')->put($request->attachment_filename, $data);
            $email->attachment =  Storage::path($request->attachment_filename);
        }

        $email->save();

        Mail::later(now()->addMinute(5), new EmailTemplate($email));
        return response()->json([
            'message' => 'Email Queued',
            'data' => $email
            ]);
    }

    public function getAllEmails()
    {
        $emails = Email::all();
        return response()->json([
            'message' => 'Success',
            'data' => $emails,
            'count' => $emails->count()
        ]);

    }

    public function getSentEmails()
    {
        $sentEmails = Email::where('sent','=','1')->get();
        return response()->json([
            'message' => 'Success',
            'data' => $sentEmails,
            'count' => $sentEmails->count()
        ]);
    }
}
