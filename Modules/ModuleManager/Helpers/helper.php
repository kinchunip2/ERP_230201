<?php

if (!function_exists('moduleStatusCheck')) {
    function moduleStatusCheck($module): bool
    {

        try {
            $haveModule = \Modules\ModuleManager\Entities\Module::where('name', $module)->first();
            if (empty($haveModule)) {
                return false;
            }
            $moduleStatus = $haveModule->status;

            $is_module_available = 'Modules/' . $module . '/Providers/' . $module . 'ServiceProvider.php';

            if (file_exists($is_module_available)) {

                $moduleCheck = \Nwidart\Modules\Facades\Module::find($module)->isEnabled();
                if (!$moduleCheck) {
                    return false;
                }

                if ($moduleStatus == 1) {
                    $is_verify = \Modules\ModuleManager\Entities\InfixModuleManager::where('name', $module)->first();

                    if (!empty($is_verify->purchase_code)) {
                        return true;
                    }
                }
            }


            return false;
        } catch (\Throwable $th) {

            return false;
        }

    }
}
