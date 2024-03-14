<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('customer.index'));
});

// Home > Customer
Breadcrumbs::for('customer', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Customer', route('customer.index'));
});

// Home > Customer > Add-Customer
Breadcrumbs::for('add', function (BreadcrumbTrail $trail) {
    $trail->parent('customer'); 
    $trail->push('Add', route('customer.add'));
});

// Home > Customer > Edit-Customer
Breadcrumbs::for('edit', function (BreadcrumbTrail $trail, $id) {
    $trail->parent('customer');
    $trail->push('Edit', route('customer.edit', $id));
});
