<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Message;
use App\Models\mainModel;
use Pusher\Pusher;

class Chat_Controller extends Controller
{
    //
    public function Chat_UI()
    {
        $chatmodel = new mainModel();
        $USERID = session()->get('userid');
        $data['USER_ID'] = $USERID;
        $getallDeatils = $chatmodel->get_chat_users($data);
        // print_r($getallDeatils);
        return view('User.Chat_UI', compact('getallDeatils'));
    }

    public function getMessage($user_id)
    {
        $my_id = session()->get('userid');

        // Get all message from selected user
        // DB::enableQuerylog();
        $messages = DB::table('mst_tbl_messages')
            ->where('from_id', '=', $user_id)->where('to_id', '=', $my_id)
            ->orWhere(function ($query) use ($user_id, $my_id) {
                $query->where('from_id', '=', $my_id)
                    ->where('to_id', '=', $user_id);
            })
            ->get();

        $user_header = DB::table('mst_user_tbl')
            ->where('userId', '=', $user_id)
            ->get();

        return view('User.message_sceen', ['messages' => $messages, 'user_header' => $user_header]);
    }

    public function getreciepent_message($user_id)
    {
        $my_id = session()->get('userid');
        $aaryofDetails = [];
        $getallDetailscount = DB::table('mst_tbl_messages')
            ->where('from_id', '=', $user_id)->where('to_id', '=', $my_id)->where('seen', '=', 0)
            ->count();
        if ($getallDetailscount != 0) {
            $getallDetails = DB::table('mst_tbl_messages')
                ->where('from_id', '=', $user_id)->where('to_id', '=', $my_id)->where('seen', '=', 0)
                ->get();
            $k = 0;
            $getId = [];
            foreach ($getallDetails as $key => $value) {
                $aaryofDetails[$key] = $value;
                $aaru[] = $aaryofDetails[$k]->id;
                $getId['id'] = $aaru;
                $k++;
            }
            $seen['seen'] = 1;
            $updated = DB::table('mst_tbl_messages')->where(['from_id' => $user_id, 'to_id' => $my_id])->update($seen);
            $text_messages = DB::table('mst_tbl_messages')->whereIn('id', $getId['id'])->get();
        } else {
            $text_messages = DB::table('mst_tbl_messages')
                ->where('from_id', '=', $user_id)->where('to_id', '=', $my_id)->where('seen', '=', 0)->get();
        }
        return view('User.getreciepent_message', ['messages' => $text_messages]);
    }

    public function seenmsg($receiver_id)
    {
        $my_id = session()->get('userid');
        $update_to_seen = new mainModel();
        $data['from_id'] = $my_id;
        $data['to_id'] = $receiver_id;
        $responsemessg = $update_to_seen->updateseenmsg($data);
        // print_r($responsemessg);
        return $responsemessg;
    }

    public function sendMessage(Request $request)
    {
        $from = session()->get('userid');
        $to = $request->receiver_id;
        $message = $request->message;
        $type = $request->type;

        $insert_sendmsg = new mainModel();
        $data['type'] = $type;
        $data['from'] = $from;
        $data['to'] = $to;
        $data['message'] = $message;
        $responsemessg = $insert_sendmsg->savemessage($data);

        // $options = array(
        //     'cluster' => 'ap2',
        //     // 'useTLS' => true
        // );

        // $pusher = new Pusher(
        //     env('PUSHER_APP_KEY'),
        //     env('PUSHER_APP_SECRET'),
        //     env('PUSHER_APP_ID'),
        //     $options
        // );

        // $data = ['from_id' => $from, 'to_id' => $to]; // sending from and to user id when pressed enter
        // $pusher->trigger('my-channel', 'my-event', $data);
        return  $responsemessg;
    }
}
