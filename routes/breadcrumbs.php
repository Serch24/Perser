<?php

// routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.

use App\Models\Products;
use Diglactic\Breadcrumbs\Breadcrumbs;
// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Home > user
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('User', route('profile'));
});

// Home > User > edit
Breadcrumbs::for('edit-user', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('Edit', route('edit-profile'));
});

// --------------------------------------------------------------------------------------------- //

// Home > Product
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Product');
});

// Home > Product > create
Breadcrumbs::for('product-create', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('create', route('create-product'));
});

// Home > Product > { prduct }
Breadcrumbs::for('product-show', function (BreadcrumbTrail $trail, Products $product) {
    $trail->parent('products');
    $trail->push($product->name, route('show-product', $product));
});

// Home > Product > { prduct }
Breadcrumbs::for('buy-product', function (BreadcrumbTrail $trail, Products $product) {
    $trail->parent('products');
    $trail->push($product->name, route('buy', $product));
});

// Home > profile > purched
Breadcrumbs::for('purched-product', function (BreadcrumbTrail $trail, Products $product) {
    $trail->parent('user');
    $trail->push('purched', route('buy', $product));
});
