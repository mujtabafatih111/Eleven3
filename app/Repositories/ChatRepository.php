<?php
namespace App\Repositories;

use App\Models\Chat;
use App\Models\Conversation;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ChatRepository
{
    public function chat($data)
    {

        $user = Auth::user();

        // $patient = User::find($user);
        // $doctor = User::find($doctorId);
        $message = '';
        if ($user) {
            $role = $user->roles[0]->name;
            if ($role == 'patient') {
                $patient = User::find($user->id);
                $doctor = User::find($data['receiver_id']);

                $conversation = new Conversation;
                $conversation->patient()->associate($patient);
                $conversation->practitioner()->associate($doctor);
                $conversation->save();

                $message = new Chat;
                $message->conversation()->associate($conversation);
                $message->sender()->associate($patient);
                $message->message = $data['message'];
                $message->save();
            } else if ($role == 'practitioner') {
                $patient = User::find($data['receiver_id']);
                $doctor = User::find($user->id);

                $conversation = new Conversation;
                $conversation->patient()->associate($patient);
                $conversation->practitioner()->associate($doctor);
                $conversation->save();

                $message = new Chat;
                $message->conversation()->associate($conversation);
                $message->sender()->associate($doctor);
                $message->message = $data['message'];
                $message->save();
            }

        }

        return $message;
    }
    public function getMessage($data)
    {

        $user = Auth::user();
        
        if ($user) {
            $role = $user->roles[0]->name;
         
            if ($role == 'patient') {
                $patient = User::find($user->id);
                $doctor = User::find($data['receiver_id']);
                $conversations = Conversation::with(['messages.sender' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }])
                    ->where('patient_id', $patient->id)
                    ->where('practitioner_id', $doctor->id)
                    ->select('id')
                    ->groupBy('id')
                    ->get();

            } else if ($role == 'practitioner') {
                $patient = User::find($data['receiver_id']);
                $doctor = User::find($user->id);
                $conversations = Conversation::with(['messages.sender' => function ($query) {
                    $query->orderBy('created_at', 'desc');
                }])
                    ->where('patient_id', $patient->id)
                    ->where('practitioner_id', $doctor->id)
                    ->select('id')
                    ->get();

            }
        }

        $messages = [];

        foreach ($conversations as $conversation) {
            $conversationMessages = $conversation->messages->map(function ($message) {
                return [
                    'content' => $message->message,
                    'sender_id' => $message->sender->id,
                    'sender_name' => $message->sender->first_name.' '.$message->sender->last_name,
                    'timestamp' => $message->created_at->format('Y-m-d H:i:s')
                ];
            })->reverse();

            $messages[$conversation->id] = $conversationMessages;
        }

        return $messages;
    }

}