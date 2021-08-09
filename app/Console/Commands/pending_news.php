<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class pending_news extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pending:news';

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
        $x = 1;
        while($x < 101){
        $page = $client->request('GET','https://www.youm7.com/Section/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%D8%A9/298/'.$x);
        $i =0;
        while ($i <40){
            $url = $page->filter('.col-xs-12 > div > h3> a')->eq($i)->link()->getUri();
            $hash_url = md5($url);
            $links_hash = DB::table('pending_news')->where('link_hash',$hash_url)->pluck('link_hash');
            if(count($links_hash) == 0 or $hash_url !== $links_hash[0] ){
                DB::insert('insert into pending_news (link, link_hash, scrap_timestamp) values (?, ?, ?)',[$url, $hash_url,Carbon::now()]);                
            }else{
                echo' same  ';
            }
            $i = $i + 1;
        }
        $x = $x +1;
    }
}
}
