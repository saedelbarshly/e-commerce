<?php

use App\Http\Controllers\admin\AdminPanelController;
use App\Http\Controllers\admin\AdminUsersController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\CitiesController;
use App\Http\Controllers\admin\ClientUsersController;
use App\Http\Controllers\admin\CompaniesController;
use App\Http\Controllers\admin\ContactMessagesController;
use App\Http\Controllers\admin\CountriesController;
use App\Http\Controllers\admin\CouponsController;
use App\Http\Controllers\admin\CurrenciesController;
use App\Http\Controllers\admin\FAQsController;
use App\Http\Controllers\admin\GovernoratesController;
use App\Http\Controllers\admin\ItemsController;
use App\Http\Controllers\admin\LengthController;
use App\Http\Controllers\admin\MenusController;
use App\Http\Controllers\admin\OptionsController;
use App\Http\Controllers\admin\OrdersController;
use App\Http\Controllers\admin\PagesController;
use App\Http\Controllers\admin\policesController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\productSpecificationsController;
use App\Http\Controllers\admin\ReviewsController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\SpecificationController;
use App\Http\Controllers\admin\specificationTypesController;
use App\Http\Controllers\admin\SubscribeController;
use App\Http\Controllers\admin\taxRatesController;
use App\Http\Controllers\admin\taxTypesController;
use App\Http\Controllers\admin\WeightController;
use App\Http\Controllers\admin\ShippingLocationsController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => 'AdminPanel', 'middleware' => ['isAdmin', 'auth']], function () {
  Route::get('/', [AdminPanelController::class, 'index'])->name('admin.index');

  Route::get('/read-all-notifications', [AdminPanelController::class, 'readAllNotifications'])->name('admin.notifications.readAll');
  Route::get('/notification/{id}/details', [AdminPanelController::class, 'notificationDetails'])->name('admin.notification.details');

  Route::get('/my-profile', [AdminPanelController::class, 'EditProfile'])->name('admin.myProfile');
  Route::post('/my-profile', [AdminPanelController::class, 'UpdateProfile'])->name('admin.myProfile.update');
  Route::get('/my-password', [AdminPanelController::class, 'EditPassword'])->name('admin.myPassword');
  Route::post('/my-password', [AdminPanelController::class, 'UpdatePassword'])->name('admin.myPassword.update');
  Route::get('/notifications-settings', [AdminPanelController::class, 'EditNotificationsSettings'])->name('admin.notificationsSettings');
  Route::post('/notifications-settings', [AdminPanelController::class, 'UpdateNotificationsSettings'])->name('admin.notificationsSettings.update');

  Route::group(['prefix' => 'admins'], function () {
    Route::get('/', [AdminUsersController::class, 'index'])->name('admin.adminUsers');
    Route::get('/create', [AdminUsersController::class, 'create'])->name('admin.adminUsers.create');
    Route::post('/create', [AdminUsersController::class, 'store'])->name('admin.adminUsers.store');
    Route::get('/{id}/block/{action}', [AdminUsersController::class, 'blockAction'])->name('admin.adminUsers.block');
    Route::get('/{id}/edit', [AdminUsersController::class, 'edit'])->name('admin.adminUsers.edit');
    Route::post('/{id}/edit', [AdminUsersController::class, 'update'])->name('admin.adminUsers.update');
    Route::get('/{id}/delete', [AdminUsersController::class, 'delete'])->name('admin.adminUsers.delete');
  });

  Route::group(['prefix' => 'clients'], function () {
    Route::get('/', [ClientUsersController::class, 'index'])->name('admin.clientUsers');
    Route::get('/create', [ClientUsersController::class, 'create'])->name('admin.clientUsers.create');
    Route::post('/create', [ClientUsersController::class, 'store'])->name('admin.clientUsers.store');
    Route::get('/{id}/edit', [ClientUsersController::class, 'edit'])->name('admin.clientUsers.edit');
    Route::post('/{id}/edit', [ClientUsersController::class, 'update'])->name('admin.clientUsers.update');
    Route::get('/{id}/delete', [ClientUsersController::class, 'delete'])->name('admin.clientUsers.delete');
  });

  Route::group(['prefix' => 'roles'], function () {
    Route::get('/', [RolesController::class, 'index'])->name('admin.roles');
    Route::post('/create', [RolesController::class, 'store'])->name('admin.roles.store');
    Route::post('/{id}/edit', [RolesController::class, 'update'])->name('admin.roles.update');
    Route::get('/{id}/delete', [RolesController::class, 'delete'])->name('admin.roles.delete');
  });

  Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountriesController::class, 'index'])->name('admin.countries');
    Route::post('/create', [CountriesController::class, 'store'])->name('admin.countries.store');
    Route::post('/{id}/edit', [CountriesController::class, 'update'])->name('admin.countries.update');
    Route::get('/{id}/delete', [CountriesController::class, 'delete'])->name('admin.countries.delete');

    Route::group(['prefix' => '{countryId}/governorates'], function () {
      Route::get('/', [GovernoratesController::class, 'index'])->name('admin.governorates');
      Route::post('/create', [GovernoratesController::class, 'store'])->name('admin.governorates.store');
      Route::post('/{governorateId}/edit', [GovernoratesController::class, 'update'])->name('admin.governorates.update');
      Route::get('/{governorateId}/delete', [GovernoratesController::class, 'delete'])->name('admin.governorates.delete');

      Route::group(['prefix' => '{governorateId}/cities'], function () {
        Route::get('/', [CitiesController::class, 'index'])->name('admin.cities');
        Route::post('/create', [CitiesController::class, 'store'])->name('admin.cities.store');
        Route::post('/{cityId}/edit', [CitiesController::class, 'update'])->name('admin.cities.update');
        Route::get('/{cityId}/delete', [CitiesController::class, 'delete'])->name('admin.cities.delete');
      });
    });
  });

  Route::group(['prefix' => 'shippingLocations'], function () {
    Route::get('/', [ShippingLocationsController::class, 'index'])->name('admin.shippingLocations');
    Route::post('/create', [ShippingLocationsController::class, 'store'])->name('shippingLocations.store');
    Route::post('/{location}/edit', [ShippingLocationsController::class, 'update'])->name('shippingLocations.update');
    Route::get('/{location}/delete', [ShippingLocationsController::class, 'delete'])->name('shippingLocations.delete');
    Route::post('/fetch-governorates', [ShippingLocationsController::class, 'governorates']);
    Route::post('/fetch-cities', [ShippingLocationsController::class, 'cities']);
  });

  Route::group(['prefix' => 'currencies'], function () {
    Route::get('/', [CurrenciesController::class, 'index'])->name('admin.currencies');
    Route::post('/create', [CurrenciesController::class, 'store'])->name('admin.currencies.store');
    Route::post('/{id}/edit', [CurrenciesController::class, 'update'])->name('admin.currencies.update');
    Route::get('/{id}/delete', [CurrenciesController::class, 'delete'])->name('admin.currencies.delete');
  });

  Route::group(['prefix' => 'polices'], function () {
    Route::get('/', [policesController::class, 'index'])->name('admin.polices');
    Route::post('/create', [policesController::class, 'store'])->name('admin.polices.store');
    Route::post('/{police}/edit', [policesController::class, 'update'])->name('admin.polices.update');
    Route::get('/{police}/delete', [policesController::class, 'delete'])->name('admin.polices.delete');
  });
  Route::group(['prefix' => 'faqs'], function () {
    Route::get('/', [FAQsController::class, 'index'])->name('admin.faqs');
    Route::post('/create', [FAQsController::class, 'store'])->name('admin.faqs.store');
    Route::post('/{id}/edit', [FAQsController::class, 'update'])->name('admin.faqs.update');
    Route::get('/{id}/delete', [FAQsController::class, 'delete'])->name('admin.faqs.delete');
  });

  Route::group(['prefix' => 'pages'], function () {
    Route::get('/', [PagesController::class, 'index'])->name('admin.pages');
    Route::post('/create', [PagesController::class, 'store'])->name('admin.pages.store');
    Route::post('/{id}/edit', [PagesController::class, 'update'])->name('admin.pages.update');
    Route::get('/{id}/delete', [PagesController::class, 'delete'])->name('admin.pages.delete');
  });
  Route::group(['prefix' => 'blogs'], function () {
    Route::get('/', [BlogController::class, 'index'])->name('admin.blogs');
    Route::post('/create', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::post('/{blog}/edit', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::get('/{blog}/delete', [BlogController::class, 'delete'])->name('admin.blogs.delete');
  });
  Route::group(['prefix' => 'menus'], function () {
    Route::get('/', [MenusController::class, 'index'])->name('admin.menus');
    Route::post('/create', [MenusController::class, 'store'])->name('admin.menus.store');
    Route::post('/{menu}/edit', [MenusController::class, 'update'])->name('admin.menus.update');
    Route::get('/{menu}/delete', [MenusController::class, 'delete'])->name('admin.menus.delete');

    Route::get('/{menu}/items', [ItemsController::class, 'index'])->name('admin.items');
    Route::post('/{menu}/items/create', [ItemsController::class, 'store'])->name('admin.items.store');
    Route::post('/{menu}/{item}/edit', [ItemsController::class, 'update'])->name('admin.items.update');
    Route::get('/{menu}/{item}/delete', [ItemsController::class, 'delete'])->name('admin.items.delete');
  });

  Route::group(['prefix' => 'contact-messages'], function () {
    Route::get('/', [ContactMessagesController::class, 'index'])->name('admin.contactmessages');
    Route::get('/{id}/details', [ContactMessagesController::class, 'details'])->name('admin.contactmessages.details');
    Route::get('/{id}/delete', [ContactMessagesController::class, 'delete'])->name('admin.contactmessages.delete');
  });
  Route::group(['prefix' => 'subscribe'], function () {
    Route::get('/', [SubscribeController::class, 'index'])->name('admin.subscribe');
    Route::get('/{id}/delete', [SubscribeController::class, 'delete'])->name('admin.subscribe.delete');
  });

  Route::group(['prefix' => 'settings'], function () {
    Route::get('/', [SettingsController::class, 'generalSettings'])->name('admin.settings.general');
    Route::post('/', [SettingsController::class, 'updateSettings'])->name('admin.settings.update');
    Route::get('/{key}/deletePhoto', [SettingsController::class, 'deleteSettingPhoto'])->name('admin.settings.deletePhoto');
  });

  Route::group(['prefix' => 'orders'], function () {
    Route::get('/', [OrdersController::class, 'index'])->name('admin.orders');
    Route::get('/{id}/details', [OrdersController::class, 'details'])->name('admin.orders.details');
  });

  //coupons
  Route::group(['prefix' => 'coupons'], function () {
    Route::get('/', [CouponsController::class, 'index'])->name('admin.coupons.index');
    Route::post('/store', [CouponsController::class, 'store'])->name('admin.coupons.store');
    Route::get('/{id}/destroy', [CouponsController::class, 'destroy'])->name('admin.coupons.destroy');
    Route::get('/{id}/report', [CouponsController::class, 'report'])->name('admin.coupons.report');
  });
  //lengths
  Route::group(['prefix' => 'length'], function () {
    Route::get('/', [LengthController::class, 'index'])->name('admin.length');
    Route::post('/create', [LengthController::class, 'store'])->name('admin.length.store');
    Route::post('/{id}/edit', [LengthController::class, 'update'])->name('admin.length.update');
    Route::get('/{id}/delete', [LengthController::class, 'delete'])->name('admin.length.delete');
  });
  //Weight
  Route::group(['prefix' => 'weight'], function () {
    Route::get('/', [WeightController::class, 'index'])->name('admin.weight');
    Route::post('/create', [WeightController::class, 'store'])->name('admin.weight.store');
    Route::post('/{id}/edit', [WeightController::class, 'update'])->name('admin.weight.update');
    Route::get('/{id}/delete', [WeightController::class, 'delete'])->name('admin.weight.delete');
  });
  //Store Front
  //Companies
  Route::group(['prefix' => 'companies'], function () {
    Route::get('/', [CompaniesController::class, 'index'])->name('admin.companies');
    Route::post('/create', [CompaniesController::class, 'store'])->name('admin.companies.store');
    Route::post('/{id}/edit', [CompaniesController::class, 'update'])->name('admin.companies.update');
    Route::get('/{id}/delete', [CompaniesController::class, 'delete'])->name('admin.companies.delete');
  });
  //Categories
  Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories');
    Route::post('/create', [CategoriesController::class, 'store'])->name('admin.categories.store');
    Route::post('/{category}/edit', [CategoriesController::class, 'update'])->name('admin.categories.update');
    Route::get('/{category}/delete', [CategoriesController::class, 'delete'])->name('admin.categories.delete');
  });
  //products
  Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductsController::class, 'index'])->name('admin.products');
    Route::get('/create', [ProductsController::class, 'create'])->name('admin.products.create');
    Route::post('/create', [ProductsController::class, 'store'])->name('admin.products.store');
    Route::get('/getOptionDetails', [ProductsController::class, 'getOptionDetails'])->name('admin.getOptionDetails');
    Route::get('/{product}/edit', [ProductsController::class, 'edit'])->name('admin.products.edit');
    Route::post('/{product}/edit', [ProductsController::class, 'update'])->name('admin.products.update');
    Route::get('/{product}/delete', [ProductsController::class, 'delete'])->name('admin.products.delete');
    Route::get('/{key}/deleteImage', [ProductsController::class, 'deleteImage'])->name('admin.products.deleteImage');
    Route::get('/{key}/Images', [ProductsController::class, 'Images'])->name('admin.products.Images');
  });
  Route::group(['prefix' => 'reviews'], function () {
    Route::get('/', [ReviewsController::class, 'index'])->name('admin.reviews');
    Route::get('/{id}/delete', [ReviewsController::class, 'delete'])->name('admin.reviews.delete');
    Route::get('/{id}/status', [ReviewsController::class, 'status'])->name('admin.reviews.status');
  });
  //product Specifications
  Route::group(['prefix' => 'specifications'], function () {
    Route::get('/', [SpecificationController::class, 'index'])->name('admin.specifications');
    Route::post('/create', [SpecificationController::class, 'store'])->name('admin.specifications.store');
    Route::post('/{specification}/edit', [SpecificationController::class, 'update'])->name('admin.specifications.update');
    Route::get('/{specification}/delete', [SpecificationController::class, 'delete'])->name('admin.specifications.delete');
  });
  //Specification Types
  Route::group(['prefix' => 'specificationTypes'], function () {
    Route::get('/', [specificationTypesController::class, 'index'])->name('admin.specificationTypes');
    Route::post('/create', [specificationTypesController::class, 'store'])->name('admin.specificationTypes.store');
    Route::post('/{type}/edit', [specificationTypesController::class, 'update'])->name('admin.specificationTypes.update');
    Route::get('/{type}/delete', [specificationTypesController::class, 'delete'])->name('admin.specificationTypes.delete');
  });
  //product's Options
  Route::group(['prefix' => 'options'], function () {
    Route::get('/', [OptionsController::class, 'index'])->name('admin.options');
    Route::get('/create', [OptionsController::class, 'create'])->name('admin.options.create');
    Route::post('/create', [OptionsController::class, 'store'])->name('admin.options.store');
    Route::get('/{option}/edit', [OptionsController::class, 'edit'])->name('admin.options.edit');
    Route::post('/{option}/edit', [OptionsController::class, 'update'])->name('admin.options.update');
    Route::get('/{option}/delete', [OptionsController::class, 'delete'])->name('admin.options.delete');
  });

  Route::group(['prefix' => 'taxRate'], function () {
    Route::get('/', [taxRatesController::class, 'index'])->name('admin.taxRates');
    Route::post('/create', [taxRatesController::class, 'store'])->name('admin.taxRates.store');
    Route::post('/{taxRate}/edit', [taxRatesController::class, 'update'])->name('admin.taxRates.update');
    Route::get('/{taxRate}/delete', [taxRatesController::class, 'delete'])->name('admin.taxRates.delete');
  });
  Route::group(['prefix' => 'taxTypes'], function () {
    Route::get('/', [taxTypesController::class, 'index'])->name('admin.taxTypes');
    Route::post('/create', [taxTypesController::class, 'store'])->name('admin.taxTypes.store');
    Route::post('/{taxType}/edit', [taxTypesController::class, 'update'])->name('admin.taxTypes.update');
    Route::get('/{taxType}/delete', [taxTypesController::class, 'delete'])->name('admin.taxTypes.delete');
  });
});
