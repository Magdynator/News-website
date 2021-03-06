<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Goutte\Client;
use Illuminate\Support\Facades\DB;
use App\Models\News;
use \Illuminate\Support\Str;


class newsScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:news';

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
        $page = $client->request('GET', 'https://www.youm7.com/Section/%D8%A3%D8%AE%D8%A8%D8%A7%D8%B1-%D8%A7%D9%84%D8%B1%D9%8A%D8%A7%D8%B6%D8%A9/298/1');
        $i = 0;
        while ($i <3){
            $title = $page->filter('.col-xs-12 > div > h3> a')->eq($i)->text();
            $url = $page->filter('.col-xs-12 > div > h3> a')->eq($i)->link()->getUri();
            $news = $client->request('GET', $url);
            $body = $news->filter('.articleCont > #articleBody')->text();
            $date = $news->filter('.articleHeader > .newsStoryDate')->text();
            $links = DB::table('news')->pluck('link');
            foreach ($links as $link) {
                if(crypt($link, $url)){
                    break;
                }else{
                DB::insert('insert into news (title, body, date, link) values (?, ?, ?, ?)',[$title, $body, $date, $url]);
                }
            }
             
            
            $i = $i +1;
            
        }

       
    }
}
