<?php

namespace Onicms\Providers;

use Illuminate\Support\ServiceProvider;
use \Schema;
use Onicms\Models\Admin\MenuAdmin as MenuAdmin;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!Schema::hasTable('users'))
            return true;

        // Aqui configuramos variáveis que irão ser usadas nas views:

        // Configs do site para as views(tanto do site quanto do admin):
        //$this->configuracoes = Configuracoes::find(1);

        view()->composer('layouts.admin', function($view)
        {
            // Obtendo o menu do sistema e jogando para a view do admin:
            $menu_adm = new MenuAdmin;
            $menu_adm = $menu_adm->get_menu();
            $view->with( array(
                'menu_adm'     => $menu_adm,
            ));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
