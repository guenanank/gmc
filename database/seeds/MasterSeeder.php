<?php

use Illuminate\Database\Seeder;
use App\Master;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        Master::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"masterName":"Activities","masterUseAPI":"0","masterFormat":null,"masterRawQuery":null},{"masterName":"Education","masterUseAPI":"0","masterFormat":"[{\"name\":\"education\",\"useApi\":{\"key\":null,\"target\":null},\"form\":{\"isMultiple\":false,\"index\":\"educationId\",\"value\":[\"educationName\"]}}]","masterRawQuery":null},{"masterName":"Expenses","masterUseAPI":"0","masterFormat":"[{\"name\":\"expenses\",\"useApi\":{\"key\":null,\"target\":null},\"form\":{\"isMultiple\":false,\"index\":\"expenseId\",\"value\":[\"expenseMin\",\"expenseMax\"]}}]","masterRawQuery":null},{"masterName":"Hobbies","masterUseAPI":"0","masterFormat":"[{\"name\":\"hobbies\",\"useApi\":{\"key\":null,\"target\":null},\"form\":{\"isMultiple\":true,\"index\":\"hobbyId\",\"value\":[\"hobbyParent\",\"hobbyName\"]}}]","masterRawQuery":null},{"masterName":"Interests","masterUseAPI":"0","masterFormat":"[{\"name\":\"interests\",\"useApi\":{\"key\":null,\"target\":null},\"form\":{\"isMultiple\":true,\"index\":\"interestId\",\"value\":[\"interestParent\",\"interestName\"]}}]","masterRawQuery":null},{"masterName":"Media","masterUseAPI":"0","masterFormat":null,"masterRawQuery":null},{"masterName":"Media Groups","masterUseAPI":"0","masterFormat":null,"masterRawQuery":null},{"masterName":"Professions","masterUseAPI":"0","masterFormat":"[{\"name\":\"professions\",\"useApi\":{\"key\":null,\"target\":null},\"form\":{\"isMultiple\":false,\"index\":\"professionId\",\"value\":[\"professionParent\",\"professionName\"]}}]","masterRawQuery":null},{"masterName":"Residence","masterUseAPI":"1","masterFormat":"[{\"name\":\"districts\",\"useApi\":{\"key\":\"Vl0EyRZ\",\"target\":\"http:\\\/\\\/\"},\"form\":{\"isMultiple\":false,\"index\":\"districtId\",\"value\":[\"districtName\"]}},{\"name\":\"cities\",\"useApi\":{\"key\":\"gsCy2Iz\",\"target\":\"http:\\\/\\\/\"},\"form\":{\"isMultiple\":false,\"index\":\"cityId\",\"value\":[\"cityName\"]}},{\"name\":\"provinces\",\"useApi\":{\"key\":\"0XfAKHh\",\"target\":\"http:\\\/\\\/\"},\"form\":{\"isMultiple\":false,\"index\":\"provinceId\",\"value\":[\"provinceName\"]}},{\"name\":\"postCodes\",\"useApi\":{\"key\":\"EZBenCW\",\"target\":\"http:\\\/\\\/\"},\"form\":{\"isMultiple\":false,\"index\":\"postCode\",\"value\":[\"postCode\"]}},{\"name\":\"dwellings\",\"useApi\":{\"key\":\"VEpuaMb\",\"target\":\"http:\\\/\\\/\"},\"form\":{\"isMultiple\":false,\"index\":\"dwellingId\",\"value\":[\"dwellingName\"]}}]","masterRawQuery":null},{"masterName":"Sources","masterUseAPI":"0","masterFormat":"[{\"name\":\"sources\",\"useApi\":{\"key\":\"\",\"target\":\"\"},\"form\":{\"type\":\"default\",\"isMultiple\":false,\"index\":\"sourceId\",\"value\":\"sourceName\"}}]","masterRawQuery":null},{"masterName":"Vehicles","masterUseAPI":"1","masterFormat":null,"masterRawQuery":null}]';
        foreach(json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            Master::create($seed);
        endforeach;
    }
}
