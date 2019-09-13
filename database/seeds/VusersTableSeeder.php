<?php

//use Illuminate\Database\Seeder;
use JeroenZwart\CsvSeeder\CsvSeeder;

class VusersTableSeeder extends CsvSeeder
{

    public function __construct()
    {
        $this->file = '/database/seeds/csvs/vusers.csv';
        $this->tablename = 'vusers';
        $this->header = FALSE;
        $this->mapping = ['name_first', 'name_last'];
        $this->delimiter = "\t";
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::disableQueryLog();
        parent::run();
    }
}
