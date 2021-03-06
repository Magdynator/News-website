<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class news extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:news';

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
        $client = new Client();
        $news = DB::table('pending_news')->where('processed', 0)->pluck('link');
        foreach ($news as $new_news){
            $req = $client->request('GET', $new_news);
            $title = $req->filter('.articleHeader > h1')->text();
            $body = $req->filter('.articleCont > #articleBody')->text();
            $date = $req->filter('.articleHeader > .newsStoryDate')->text();
            $name = $req->filter('.articleCont > .writeBy')->text();
            $img = $req->filter('.img-cont > .img-responsive')->attr('src');
            DB::table('pending_news')
            ->where('link', $new_news)
            ->update(['processed' => 1, 'processed_timestamp' => Carbon::now()]);
            DB::insert('insert into news (title, body, date, name, img) values (?, ?, ?, ?, ?)',[$title, $body, $date, $name, $img]);
           
            
        }

    }
}
