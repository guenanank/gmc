<?php

use Illuminate\Database\Seeder;
use GMC\Models\Master;

class MasterSeeder extends Seeder {

    public function run() {
        DB::statement("SET foreign_key_checks=0");
        Master::truncate();
        DB::statement("SET foreign_key_checks=1");
        $seeds = '[{"masterName":"Activities","masterUseAPI":"0","masterFormat":"[{\"name\":\"activity\",\"index\":\"activtyId\",\"value\":[\"actvityName\"],\"form\":false,\"multiple\":false,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Education","masterUseAPI":"0","masterFormat":"[{\"name\":\"education\",\"index\":\"educationId\",\"value\":[\"educationName\"],\"form\":true,\"multiple\":false,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Expenses","masterUseAPI":"0","masterFormat":"[{\"name\":\"expense\",\"index\":\"expenseId\",\"value\":[\"expenseMin\",\"expenseMax\"],\"form\":true,\"multiple\":false,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Hobbies","masterUseAPI":"0","masterFormat":"[{\"name\":\"hobby\",\"index\":\"hobbyId\",\"value\":[\"hobbyName\"],\"form\":true,\"multiple\":true,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Interests","masterUseAPI":"0","masterFormat":"[{\"name\":\"interest\",\"index\":\"interestId\",\"value\":[\"interestName\"],\"form\":true,\"multiple\":true,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Media","masterUseAPI":"1","masterFormat":"[{\"name\":\"mediaGroup\",\"index\":\"mediaGoupId\",\"value\":[\"mediaGroupName\"],\"form\":false,\"multiple\":false,\"nested\":false},{\"name\":\"media\",\"index\":\"mediaId\",\"value\":[\"mediaName\"],\"form\":true,\"multiple\":true,\"nested\":false},{\"name\":\"mediaHowToGet\",\"index\":\"mediaHowToGetId\",\"value\":[\"mediaHowToGetName\"],\"form\":true,\"multiple\":true,\"nested\":false}]","masterNamespaces":"gateway","masterRawQuery":null},{"masterName":"Professions","masterUseAPI":"0","masterFormat":"[{\"name\":\"profession\",\"index\":\"professionId\",\"value\":[\"professionName\"],\"form\":true,\"multiple\":false,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Region","masterUseAPI":"1","masterFormat":"[{\"name\":\"province\",\"index\":\"provinceId\",\"value\":[\"provinceName\"],\"form\":true,\"multiple\":false,\"nested\":false},{\"name\":\"regency\",\"index\":\"regencyId\",\"value\":[\"regencyName\"],\"form\":true,\"multiple\":false,\"nested\":true},{\"name\":\"district\",\"index\":\"districtId\",\"value\":[\"districtName\"],\"form\":true,\"multiple\":false,\"nested\":true},{\"name\":\"village\",\"index\":\"villageId\",\"value\":[\"villageName\"],\"form\":true,\"multiple\":false,\"nested\":true},{\"name\":\"greaterArea\",\"index\":\"greaterAreaId\",\"value\":[\"greaterAreaName\"],\"form\":false,\"multiple\":false,\"nested\":false}]","masterNamespaces":"region","masterRawQuery":null},{"masterName":"Sources","masterUseAPI":"0","masterFormat":"[{\"name\":\"source\",\"index\":\"sourceId\",\"value\":[\"sourceName\"],\"form\":false,\"multiple\":false,\"nested\":false}]","masterNamespaces":null,"masterRawQuery":null},{"masterName":"Vehicles","masterUseAPI":"1","masterFormat":"[{\"name\":\"type\",\"index\":\"typeId\",\"value\":[\"typeName\"],\"form\":true,\"multiple\":true,\"nested\":false}]","masterNamespaces":"vehicle","masterRawQuery":null}]';
        foreach (json_decode($seeds) as $row) :
            $seed = collect($row)->toArray();
            Master::create($seed);
        endforeach;
    }

}
