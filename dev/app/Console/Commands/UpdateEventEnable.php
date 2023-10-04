<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Models\Event;

class UpdateEventEnable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'activation:update-event-enable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $events = Event::where('isEnable', true)->get();
        $currentDate = date('Y-m-d');
        foreach($events as $event){
            if(($event->end <= $currentDate)){
                $event->isEnable = false;
                $event->save();
                
            }
        }
        
       
    }
}
