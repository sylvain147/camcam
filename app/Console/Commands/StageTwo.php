<?php

namespace App\Console\Commands;

use App\Models\SelectedSong;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class StageTwo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stage:two';

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
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();
        $wrong = false;
        $songs = new Collection();
        foreach ($users as $user){
            if($user->songs->count() > 10){
                $wrong = true;
                $this->info('Nous avons un relou : '.$user->name.' a '.$user->songs->count().' chansons');
            }

            if($user->songs->count() < 10){
                $wrong = true;
                $this->info(''.$user->name.' n\'a que '.$user->songs->count().' chansons');

            }
                $songs = $songs->concat($user->songs);
        }
        if($wrong) {
            return ;
        }
        $i = 0;
        foreach ($songs->unique() as $song){
            foreach ($users as $user){
                SelectedSong::create([
                    'user_id'=> $user->id,
                    'song_id'=>$song->id,
                    'place'=>$i
                ]);
            }
            $i ++;

            $song->update(['selected'=>1]);
        }
    }
}
