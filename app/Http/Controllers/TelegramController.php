<?php

namespace App\Http\Controllers;
use Telegram\Bot\Laravel\Facades\Telegram;

use Illuminate\Http\Request;
use App\telmsgs;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
class TelegramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct() {
        $config = [
            // Your driver-specific configuration
            "telegram" => [
                    "token" => "713613045:AAHA_jk2d0qdvZApalWpWmGs47dAhz9Va18"
                ]
        ];
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);
        
        // Unused block of code
        /*$botman = BotManFactory::create($config);

        // give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });
        
        // start listening
        $botman->listen();*/
     }
    public function activity()
    {
        $activity = Telegram::getUpdates();
        return $activity;
    }

    public function check_msg() {
        $activity = $this->activity();
        $activity = $activity[count($activity)-1];
        $chat = $activity->message->from;
        $telmsg = telmsgs::where("msg_id", "=", $activity->message->message_id)->get();
        if(count($telmsg) == 1) {
            if(!$telmsg[0]->replied) {
                $this->send($chat,$telmsg[0]->msg);
                $telmsg[0]->replied = 1;
                $telmsg[0]->save();
                return $telmsg;
            }
        }
        else {
            $telmsg = new telmsgs();
            
            $telmsg->chat_id = $activity->message->chat->id;
            $telmsg->msg_id = $activity->message->message_id;
            $telmsg->msg = $activity->message->text;
            $this->send($chat,$telmsg->msg);
            $telmsg->replied = 1;
            $telmsg->lang = $activity->message->from->language_code;
            $telmsg->save();
        }
        

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function send($chat,$lastMsg)
    {
        try {
        $lastMsg = \strtolower($lastMsg);
        $chat_id = $chat->id;
        $user_first_name = $chat->first_name;
        $msgToSent = "Something went wrong :\\";
        switch($lastMsg) {
            case "/start":
                $msgToSent = "Hi $user_first_name !, Thanks for choosing Teqneia ChatBot, Your Chat ID is : $chat_id , Available commands are:\nhello\nservices\ncall\n123";
                break;
            case "hello":
                $msgToSent = "Hi $user_first_name, Welcome to Teqneia ChatBot";
                break;
            case "services":
                $msgToSent = "1- Web Development\n2- Mobile Applications\n3- Software Testing";
                break;
            case "call":
                $msgToSent = "Please Enter your number: ";
                break;
            case "123":
                $msgToSent = "Ok, Your number is saved in our Database, now you are enjoying our services .. Congrats!";
                break;
            case "bye":
                $msgToSent = "Dear $user_first_name, Thanks for using our services, we hope to see you soon!";
                break;
            }

        Telegram::sendMessage([
            'chat_id' => "$chat_id",
            'parse_mode' => 'HTML',
            'text' =>$msgToSent
        ]);
        return "DONE";
        }
        catch(\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
