<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Routing\Route;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    //
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    $menuAdminJson = file_get_contents(base_path('resources/menu/menuAdmin.json'));
    $menuGuruJson = file_get_contents(base_path('resources/menu/menuGuru.json'));
    $menuWaliJson = file_get_contents(base_path('resources/menu/menuWali.json'));

    $menuAdminData = json_decode($menuAdminJson, true); // Decode sebagai array
    $menuGuruData = json_decode($menuGuruJson, true);
    $menuWaliData = json_decode($menuWaliJson, true);

    $this->app->make('view')->share('menuData', [
      $menuAdminData,
      $menuGuruData,
      $menuWaliData,
    ]);
  }
}
