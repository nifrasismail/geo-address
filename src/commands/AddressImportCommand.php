<?php
/**
 * Created by PhpStorm.
 * User: nifras
 * Date: 3/20/19
 * Time: 4:22 PM
 */

namespace Nertlab\GeoAddress\commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Nertlab\GeoAddress\models\NertlabAddress;

class AddressImportCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "nertlab:address-import";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Import all addresses";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
//        $country = strtoupper($this->argument('country'));
        $country = $this->choice('Choose a country?', ['LK'], 0);
        if ($this->confirm('Do you want to update the data for '. $country . '? WARNING : Old will be removed !!!')) {
            NertlabAddress::where('country_code',strtoupper($country))->delete();
            $contents = File::get(__DIR__ . '/../data/' . $country . '.txt');
            $lines = explode("\n", $contents);

            $this->output->progressStart(count($lines));

            $handle = fopen(__DIR__ . '/../data/' . $country . '.txt', "r");
            if ($handle) {
                while (($line = fgets($handle)) !== false) {
                    $addressObject = new NertlabAddress();
                    $line = explode("\t", $line);
                    $addressObject->country_code = $line[0];
                    $addressObject->postal_code = $line[1];
                    $addressObject->place_name = $line[2];
                    $addressObject->state_code = $line[3];
                    $addressObject->state_name = $line[4];
                    $addressObject->province_code = $line[5];
                    $addressObject->province_name = $line[6];
                    $addressObject->community_code = $line[7];
                    $addressObject->community_name = $line[8];
                    $addressObject->latitude = $line[9];
                    $addressObject->longitude = $line[10];
                    $addressObject->save();
                    $this->output->progressAdvance();
                }
                fclose($handle);
            } else {
                $this->error("Not able to open data file");
            }

            $this->output->progressFinish();
            $this->info("Data Import Completed");
        }
    }
}
