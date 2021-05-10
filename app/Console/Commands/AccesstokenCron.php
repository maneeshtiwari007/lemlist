<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\ConfigureCrawler;

class AccesstokenCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'accesstoken:cron';

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
		$getConfig = ConfigureCrawler::get();
		if(!empty($getConfig[0])){
			foreach($getConfig as $config){
				$tokenDate = date('Y-m-d',  $config->created_at_token);
				$expiryTokenDate = date('Y-m-d', strtotime($tokenDate. ' + 55 days'));
				$todayDate = date('Y-m-d');
				if($todayDate == $expiryTokenDate){
						$userName = $config->username;
						$password = $config->password;
						$varUrl = "https://www.cloudcrawler.io/api/v1/oauth/token";
						$command = 'curl -X POST -F grant_type=password -F username='.$userName.' -F password='.$password.' '.$varUrl.'';
						$output = exec($command);
						$jsonData = json_decode($output);
						if(!empty($jsonData)){
						if(!empty($jsonData->access_token)){
								$arrUpdateData = array();
								$updateConfigureCrawler = ConfigureCrawler::find($config->id);
								$updateConfigureCrawler->access_token=$jsonData->access_token;
								$updateConfigureCrawler->expires_in=$jsonData->expires_in;
								$updateConfigureCrawler->token_type=$jsonData->token_type;
								$updateConfigureCrawler->created_at_token=$jsonData->created_at;
								$updateConfigureCrawler->update();
								$this->info('Cron Update has been send successfully');
							}
					 }else{
						 $this->info('Something wents wrong');
					 }
				}
		  }
		}
		
    }
}
