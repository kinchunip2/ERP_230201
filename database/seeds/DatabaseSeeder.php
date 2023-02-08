<?php

use Illuminate\Database\Seeder;
use Modules\Product\Database\Seeders\BrandSeederTableSeeder;
use Modules\Product\Database\Seeders\CategorySeederTableSeeder;
use Modules\Product\Database\Seeders\ModelSeederTableSeeder;
use Modules\Product\Database\Seeders\ProductDatabaseSeeder;
use Modules\Product\Database\Seeders\ProductskuSeeder;
use Modules\Sale\Database\Seeders\ProductHistoryDatabaseSeeder;
use Modules\Product\Database\Seeders\UnitTypeSeederTableSeeder;
use Modules\Product\Database\Seeders\VariantSeederTableSeeder;
use Modules\Inventory\Database\Seeders\ShowroomSeederTableSeeder;
use Modules\Inventory\Database\Seeders\WarehouseSeederTableSeeder;
// use Modules\UserManage\Database\Seeders\DepartmentDatabaseSeeder;
use Modules\Contact\Database\Seeders\ContactSeederTableSeeder;
use Modules\Project\Database\Seeders\FieldTableSeederTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        //Product module seeder
        // $this->call(CategorySeederTableSeeder::class);
        // $this->call(BrandSeederTableSeeder::class);
        // $this->call(ModelSeederTableSeeder::class);
        // $this->call(UnitTypeSeederTableSeeder::class);
        // $this->call(VariantSeederTableSeeder::class);
        // $this->call(ProductDatabaseSeeder::class);


        // // Inventory module seeder
        // $this->call(ShowroomSeederTableSeeder::class);
        // $this->call(WarehouseSeederTableSeeder::class);

        // // Contact module
        // $this->call(ContactSeederTableSeeder::class);
        // $this->call(ProductskuSeeder::class);
        // $this->call(ProductHistoryDatabaseSeeder::class);

        // $this->call(DepartmentDatabaseSeeder::class);
        $this->call(FieldTableSeederTableSeeder::class);
    }
}
