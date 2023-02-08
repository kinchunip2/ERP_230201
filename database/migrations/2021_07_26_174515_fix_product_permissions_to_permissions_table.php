<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixProductPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = [
            ['id'  => 50, 'module_id' => 2, 'parent_id' => 37, 'name' => 'Service', 'route' => 'add_product.service', 'type' => 3 ],
            ['id'  => 117, 'module_id' => 5, 'parent_id' => 66, 'name' => 'Country', 'route' => 'setup.country.index', 'type' => 2 ],
            ['id'  => 118, 'module_id' => 5, 'parent_id' => 117, 'name' => 'Add', 'route' => 'setup.country.store', 'type' => 3 ],
            ['id'  => 119, 'module_id' => 5, 'parent_id' => 117, 'name' => 'Edit', 'route' => 'setup.country.edit', 'type' => 3 ],
            ['id'  => 120, 'module_id' => 5, 'parent_id' => 117, 'name' => 'Delete', 'route' => 'setup.country.destroy', 'type' => 3 ],

            ['id'  => 121, 'module_id' => 5, 'parent_id' => 66, 'name' => 'State', 'route' => 'setup.state.index', 'type' => 2 ],
            ['id'  => 122, 'module_id' => 5, 'parent_id' => 121, 'name' => 'Add', 'route' => 'setup.state.store', 'type' => 3 ],
            ['id'  => 123, 'module_id' => 5, 'parent_id' => 121, 'name' => 'Edit', 'route' => 'setup.state.edit', 'type' => 3 ],
            ['id'  => 124, 'module_id' => 5, 'parent_id' => 121, 'name' => 'Delete', 'route' => 'setup.state.destroy', 'type' => 3 ],

            ['id'  => 125, 'module_id' => 5, 'parent_id' => 66, 'name' => 'City', 'route' => 'setup.city.index', 'type' => 2 ],
            ['id'  => 126, 'module_id' => 5, 'parent_id' => 125, 'name' => 'Add', 'route' => 'setup.city.store', 'type' => 3 ],
            ['id'  => 127, 'module_id' => 5, 'parent_id' => 125, 'name' => 'Edit', 'route' => 'setup.city.edit', 'type' => 3 ],
            ['id'  => 128, 'module_id' => 5, 'parent_id' => 125, 'name' => 'Delete', 'route' => 'setup.city.destroy', 'type' => 3 ],

            ['id'  => 950, 'module_id' => 13, 'parent_id' => 217, 'name' => 'Stock Alert List', 'route' => 'purchase.suggest', 'type' => 2 ],

            ['id'  => 951, 'module_id' => 14, 'parent_id' => 232, 'name' => 'Stock Adjustment', 'route' => 'stock_adjustment.index', 'type' => 2 ],
        ];
        \Illuminate\Support\Facades\DB::table('permissions')->insert($sql);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 2)->update(['route' => 'product']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 37)->update(['route' => 'add_product.store']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'apply_loans.index')->update(['id' => 327]);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 338)->update(['route' => 'location']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 192)->update(['parent_id' => 177]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('permissions', function (Blueprint $table) {
            //
        });
    }
}
