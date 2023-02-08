<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingPermissionsToPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = [
//            Events (done)
            ['id'  => 1001, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Events', 'route' => 'events', 'type' => 2 ],
            ['id'  => 1017, 'module_id' => 11, 'parent_id' => 1001, 'name' => 'List', 'route' => 'events.index', 'type' => 3 ],
            ['id'  => 1002, 'module_id' => 11, 'parent_id' => 1001, 'name' => 'Add', 'route' => 'events.store', 'type' => 3 ],
            ['id'  => 1003, 'module_id' => 11, 'parent_id' => 1001, 'name' => 'Edit', 'route' => 'events.edit', 'type' => 3 ],
            ['id'  => 1004, 'module_id' => 11, 'parent_id' => 1001, 'name' => 'Delete', 'route' => 'events.delete', 'type' => 3 ],

            ['id'  => 1005, 'module_id' => 13, 'parent_id' => 930, 'name' => 'Create', 'route' => 'cnf.store', 'type' => 3 ],
            ['id'  => 1006, 'module_id' => 13, 'parent_id' => 930, 'name' => 'Edit', 'route' => 'cnf.edit', 'type' => 3 ],
            ['id'  => 1007, 'module_id' => 13, 'parent_id' => 930, 'name' => 'Delete', 'route' => 'cnf.delete', 'type' => 3 ],


            ['id'  => 1008, 'module_id' => 14, 'parent_id' => 232, 'name' => 'Product Movement', 'route' => 'product_movement.index', 'type' => 2 ],
            ['id'  => 1009, 'module_id' => 14, 'parent_id' => 232, 'name' => 'Product Info', 'route' => 'stock.product.info', 'type' => 2 ],


            ['id'  => 1010, 'module_id' => 14, 'parent_id' => 232, 'name' => 'Apply Leave', 'route' => 'apply_leave.store', 'type' => 3 ],

//Splice Activity log
            ['id'  => 1011, 'module_id' => 14, 'parent_id' => 61, 'name' => 'Activity Logs', 'route' => 'activity_log', 'type' => 2 ],
            ['id'  => 1012, 'module_id' => 14, 'parent_id' => 61, 'name' => 'Login Logout Activity', 'route' => 'activity_log.login', 'type' => 2 ],

//            Apply Leave

            ['id'  => 1013, 'module_id' => 10, 'parent_id' => 325, 'name' => 'Apply new leave', 'route' => 'apply_leave.store', 'type' => 3 ],
            ['id'  => 1014, 'module_id' => 10, 'parent_id' => 325, 'name' => 'View Leave Application', 'route' => 'apply_leave.view', 'type' => 3 ],
            ['id'  => 1015, 'module_id' => 10, 'parent_id' => 325, 'name' => 'Edit Leave Application', 'route' => 'apply_leave.edit', 'type' => 3 ],
            ['id'  => 1016, 'module_id' => 10, 'parent_id' => 325, 'name' => 'Delete Leave Application', 'route' => 'apply_leave.destroy', 'type' => 3 ],

//            Apply Loan

            ['id'  => 1018, 'module_id' => 11, 'parent_id' => 177, 'name' => 'Loan Apply', 'route' => 'apply_loans', 'type' => 2 ],

            ['id'  => 1019, 'module_id' => 11, 'parent_id' => 1018, 'name' => 'Apply new Loan', 'route' => 'apply_loans.store', 'type' => 3 ],
            ['id'  => 1020, 'module_id' => 11, 'parent_id' => 1018, 'name' => 'View Loan Application', 'route' => 'apply_loans.show', 'type' => 3 ],
            ['id'  => 1021, 'module_id' => 11, 'parent_id' => 1018, 'name' => 'Edit Loan Application', 'route' => 'apply_loans.edit', 'type' => 3 ],
            ['id'  => 1022, 'module_id' => 11, 'parent_id' => 1018, 'name' => 'Delete Loan Application', 'route' => 'apply_loans.destroy', 'type' => 3 ],

            ['id'  => 1023, 'module_id' => 11, 'parent_id' => 193, 'name' => 'Applied loans show', 'route' => 'applied_loans.show', 'type' => 3 ],
            ['id'  => 1024, 'module_id' => 11, 'parent_id' => 339, 'name' => 'Show Details', 'route' => 'user.loan.details', 'type' => 3 ],

            ['id'  => 1025, 'module_id' => 18, 'parent_id' => 315, 'name' => 'Transfer List', 'route' => 'transfer_showroom.index', 'type' => 3 ],

            ['id'  => 1026, 'module_id' => 4, 'parent_id' => 62, 'name' => 'Backup Import', 'route' => 'backup.import', 'type' => 2 ],
            ['id'  => 1027, 'module_id' => 4, 'parent_id' => 62, 'name' => 'Backup Download', 'route' => 'backup.download', 'type' => 2 ],


            ['id'  => 1028, 'module_id' => 9, 'parent_id' => 163, 'name' => 'Import Contact', 'route' => 'contact_csv_upload.store', 'type' => 2 ],

            ['id'  => 1029, 'module_id' => 2, 'parent_id' => 37, 'name' => 'Import Product', 'route' => 'add_product.csv_upload.store', 'type' => 3 ],

            ['id'  => 1030, 'module_id' => 2, 'parent_id' => 15, 'name' => 'Import Brand', 'route' => 'brand.csv_upload.store', 'type' => 3 ],
            ['id'  => 1031, 'module_id' => 2, 'parent_id' => 10, 'name' => 'Import Unit Type', 'route' => 'unit_type.csv_upload.store', 'type' => 3 ],
            ['id'  => 1032, 'module_id' => 2, 'parent_id' => 20, 'name' => 'Import Model', 'route' => 'model.csv_upload.store', 'type' => 3 ],

            ['id'  => 1033, 'module_id' => 18, 'parent_id' => 301, 'name' => 'Import Bank Account', 'route' => 'bank_account.csv_upload.store', 'type' => 3 ],
            ['id'  => 1034, 'module_id' => 11, 'parent_id' => 178, 'name' => 'Import Staffs', 'route' => 'staffs.csv_upload.store', 'type' => 3 ],



        ];
        \Illuminate\Support\Facades\DB::table('permissions')->insert($sql);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 930)->update(['parent_id' => 217, 'type' => 2, 'name' => 'C&F']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 63)->update(['route' => 'backup.store']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 200)->update(['route' => 'permission.permissions.store']);


        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'contact.settings')->update(['parent_id' => 163, 'type' => 2, 'id' => 999]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'quotation.show')->update(['id' => 259]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'statement.index')->update(['id' => 998]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'profit.index')->update(['id' => 997]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'account.balance.index')->update(['id' => 996]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'income_by_customer')->update(['id' => 995]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'expense_by_supplier')->update(['id' => 994]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'sale_tax')->update(['id' => 993]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 315)->update(['route' => 'transfer_showroom', 'name' => 'Transfer', 'type' => 1, 'parent_id' => null]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('route', 'language.change')->update(['id' => 992]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 316)->update(['route' => 'transfer_showroom.store', 'name' => 'Make Money Transfer', 'type' => 2]); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 931)->update(['route' => 'holidays.index']); // Contact Settings
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 317)->delete(); // Contact Settings

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 325)->update(['parent_id' => 170, 'type' => 2]); // Apply Loan
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 175)->update(['parent_id' => 170, 'type' => 2, 'name' => 'Approve Leave Request']); // Approve Leave Request
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 324)->update(['parent_id' => 170, 'type' => 2]); // Pending Leave Request
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 176)->update(['parent_id' => 324, 'type' => 3]); // Set Approval move to Pending leave
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 326)->update(['parent_id' => 170, 'type' => 2]); // Move Carry forward to level 2

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 339)->update(['parent_id' => 177, 'type' => 2]); // Loan history move to level 2
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 327)->update(['parent_id' => 1018, 'type' => 3, 'name' => 'Apply Loan Index']); // Apply loan index

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 723)->update(['route' => 'invoice_settings_update']);
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 724)->update(['route' => 'template_update']);

        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 61)->update(['route' => 'useractivitylog']); // Activity log
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 951)->delete(); // Delete extra stock adjustment
        \Illuminate\Support\Facades\DB::table('permissions')->where('id', 38)->update(['route' => 'add_product.index']);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
