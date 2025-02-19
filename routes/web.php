<?php

use App\Models\Product\Category;
use App\Models\Product\Product;
use App\Models\Product\ProductStockLog;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get('/home', function () {
    return "home";
});

Route::group(['prefix' => '', 'namespace' => "Livewire"], function () {
    Route::get('/', "Frontend\Home");
    Route::get('category/{category}/{name}', "Frontend\CategoryProduct")->name('category_product');
    Route::get('product/{product}/{name}', "Frontend\ProductDetails")->name('product_details');
    Route::get('cart', "Frontend\Cart")->name('cart');
    Route::get('checkout', "Frontend\Checkout")->name('checkout');
    Route::get('invoice/{invoice}', "Frontend\Invoice")->name('invoice');
    Route::get('/profile', "Frontend\CustomerProfile");

    Route::get('/login', "Login")->name('login');
    Route::get('/register', "Register")->name('register');

    // Route::get('pos', "Frontend\Pos")->name('pos');
    Route::get('contact', "Frontend\Contact")->name('contact');
    Route::get('/frequently-asked-questions', "Frontend\Faq");
    Route::get('/how-to-buy', "Frontend\Howtobuy");
    Route::get('/terms', "Frontend\Terms");
    Route::get('/refund-policy', "Frontend\RefundPolicy");
    Route::get('/privacy-policy', "Frontend\PrivacyPolicy");

    Route::get('/about-us', "Frontend\About");
});

Route::group(['prefix' => '', 'namespace' => "Controllers"], function () {
    Route::post('/checkout', 'CheckoutController@checkout');
    Route::post('/checkout/pay-due', 'CheckoutController@pay_due');
    Route::post('/apply-coupon', 'CheckoutController@apply_coupon');
    Route::get('/pos', 'WebsiteController@pos');

    Route::group(['prefix' => 'json'], function () {
        Route::get('/products', 'Json\ProductJsonController@products');
    });

    Route::post('/profile/address-update', 'Common\AddressController@update_from_frontend');
    Route::post('/profile/update', 'Auth\ApiLoginController@update_profile');
    Route::post('/profile/update-profile-pic', 'Auth\ApiLoginController@update_profile_pic');

    Route::post('/profile/update-profile-pic', 'Auth\ApiLoginController@update_profile_pic');
    Route::post('/contact-submit', 'WebsiteController@contact_submit');

    Route::get('/invoice-printout/{order}', 'Admin\Order\OrderPrintoutController@sales_invoice');

    Route::post('/register', 'WebsiteController@website_register');

    Route::get('/old-categories', 'OldDataImportController@old_categories');
    Route::get('/old-products', 'OldDataImportController@old_products');

    Route::get('/payment/{invoice}', 'Payment\BkashController@payment')->name('payment');
    Route::get('/payment/{invoice}/status', 'Payment\BkashController@status')->name('payment_status');
    Route::get('/payment/{invoice}/success', 'Payment\BkashController@success')->name('payment_success');
    Route::get('/payment/{invoice}/failed', 'Payment\BkashController@failed')->name('payment_failed');

    // Route::get('/json-to-db', function () {
    //     $file = file_get_contents(public_path('jsons/products.json'));
    //     $data = collect(json_decode($file));
    //     $file2 = file_get_contents(public_path('jsons/products_with_name.json'));
    //     $data2 = json_decode($file2);
    //     return view('product_upload.json_to_db', compact('data', 'data2'));
    // });

    // Route::get('/customer-json-to-db', 'OldDataImportController@users');

    Route::get('/reset', "WebsiteController@reset");
});

Route::get('/dashboard', function () {
    return view('backend.dashboard');
})->name('dashboard');

Route::get('/old-users', function () {
    $conn = new mysqli("localhost", "root", "", "alzmariz_prokasona");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM products WHERE `add_to_front` = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            try {
                // dd($row);
                $product = Product::where('product_name',$row->product_title)->first();
                if($product){
                    $product->is_top_product = 1;
                    $product->save();
                }
            } catch (\Throwable $th) {
                //throw $th;
                dump($row);
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();
});

// Route::get('/data-reload', function () {
//     \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--seed' => true]);
//     \Illuminate\Support\Facades\Artisan::call('migrate', ['--path' => 'vendor/laravel/passport/database/migrations', '--force' => true]);
//     \Illuminate\Support\Facades\Artisan::call('passport:install');
//     return redirect()->back();
// });
