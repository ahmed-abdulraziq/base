<?php

use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// الصفحة الرئيسية للوحة التحكم
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push(__('translate.home'), route('dashboard.home'));
});

// إعدادات
Breadcrumbs::for('settings', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.settings'), route('dashboard.settings.index'));
});

Breadcrumbs::for('settings.profile', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(__('translate.profile'), route('dashboard.settings.profile'));
});

Breadcrumbs::for('settings.roles', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(__('translate.roles'), route('dashboard.settings.roles.index'));
});

Breadcrumbs::for('settings.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.roles');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('settings.roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('settings.roles');
    $trail->push(__('translate.edit') . ' - ' . ($role->name ?? $role->id), '#');
});

Breadcrumbs::for('settings.permissions', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(__('translate.permissions'), route('dashboard.settings.permissions.index'));
});

Breadcrumbs::for('settings.permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('settings.permissions');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('settings.permissions.edit', function (BreadcrumbTrail $trail, $permission) {
    $trail->parent('settings.permissions');
    $trail->push(__('translate.edit') . ' - ' . ($permission->name ?? $permission->id), '#');
});

// الأدوار
Breadcrumbs::for('roles', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.roles'), '#');
});

Breadcrumbs::for('roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('roles');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('roles.edit', function (BreadcrumbTrail $trail, $role) {
    $trail->parent('roles');
    $trail->push(__('translate.edit') . ' #' . $role->id, '#');
});

// المستخدمون
Breadcrumbs::for('users', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.users'), route('dashboard.users.index'));
});

Breadcrumbs::for('users.create', function (BreadcrumbTrail $trail) {
    $trail->parent('users');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('users.edit', function (BreadcrumbTrail $trail, $user) {
    $trail->parent('users');
    $trail->push(__('translate.edit') . ' - ' . ($user->name ?? $user->id), '#');
});

// المدراء / Admins
Breadcrumbs::for('admins', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.admins'), route('dashboard.admins.index'));
});

Breadcrumbs::for('admins.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admins');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('admins.edit', function (BreadcrumbTrail $trail, $admin) {
    $trail->parent('admins');
    $trail->push(__('translate.edit') . ' - ' . ($admin->name ?? $admin->id), '#');
});

// المطاعم
Breadcrumbs::for('restaurants', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.restaurants'), '#');
});

Breadcrumbs::for('restaurants.create', function (BreadcrumbTrail $trail) {
    $trail->parent('restaurants');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('restaurants.edit', function (BreadcrumbTrail $trail, $restaurant) {
    $trail->parent('restaurants');
    $trail->push(__('translate.edit') . ' - ' . ($restaurant->name ?? $restaurant->id), '#');
});

// التصنيفات
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.categories'), '#');
});

Breadcrumbs::for('categories.create', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('categories.edit', function (BreadcrumbTrail $trail, $category) {
    $trail->parent('categories');
    $trail->push(__('translate.edit') . ' - ' . ($category->name ?? $category->id), '#');
});

// الوجبات
Breadcrumbs::for('meals', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.meals'), '#');
});

Breadcrumbs::for('meals.create', function (BreadcrumbTrail $trail) {
    $trail->parent('meals');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('meals.edit', function (BreadcrumbTrail $trail, $meal) {
    $trail->parent('meals');
    $trail->push(__('translate.edit') . ' - #' . $meal->id, '#');
});

// الإضافات
Breadcrumbs::for('extras', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.extras'), '#');
});

Breadcrumbs::for('extras.create', function (BreadcrumbTrail $trail) {
    $trail->parent('extras');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('extras.edit', function (BreadcrumbTrail $trail, $extra) {
    $trail->parent('extras');
    $trail->push(__('translate.edit') . ' - #' . $extra->id, '#');
});

// الموظفون
Breadcrumbs::for('staff', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.staff'), '#');
});

Breadcrumbs::for('staff.create', function (BreadcrumbTrail $trail) {
    $trail->parent('staff');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('staff.edit', function (BreadcrumbTrail $trail, $staff) {
    $trail->parent('staff');
    $trail->push(__('translate.edit') . ' - #' . $staff->id, '#');
});

// السلايدر
Breadcrumbs::for('sliders', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.sliders'), '#');
});

Breadcrumbs::for('sliders.create', function (BreadcrumbTrail $trail) {
    $trail->parent('sliders');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('sliders.edit', function (BreadcrumbTrail $trail, $slider) {
    $trail->parent('sliders');
    $trail->push(__('translate.edit') . ' - #' . $slider->id, '#');
});

// الطلبات
Breadcrumbs::for('orders', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.orders'), '#');
});

Breadcrumbs::for('orders.create', function (BreadcrumbTrail $trail) {
    $trail->parent('orders');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('orders.edit', function (BreadcrumbTrail $trail, $order) {
    $trail->parent('orders');
    $trail->push(__('translate.edit') . ' - #' . $order->id, '#');
});

// الطاولات
Breadcrumbs::for('tables', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.tables'), '#');
});

Breadcrumbs::for('tables.create', function (BreadcrumbTrail $trail) {
    $trail->parent('tables');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('tables.edit', function (BreadcrumbTrail $trail, $table) {
    $trail->parent('tables');
    $trail->push(__('translate.edit') . ' - #' . $table->id, '#');
});

// الفروع
Breadcrumbs::for('branches', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.branches'), '#');
});

Breadcrumbs::for('branches.create', function (BreadcrumbTrail $trail) {
    $trail->parent('branches');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('branches.edit', function (BreadcrumbTrail $trail, $branch) {
    $trail->parent('branches');
    $trail->push(__('translate.edit') . ' - #' . $branch->id, '#');
});

// الدول
Breadcrumbs::for('countries', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.countries'), '#');
});

Breadcrumbs::for('countries.create', function (BreadcrumbTrail $trail) {
    $trail->parent('countries');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('countries.edit', function (BreadcrumbTrail $trail, $country) {
    $trail->parent('countries');
    $trail->push(__('translate.edit') . ' - #' . $country->id, '#');
});

// المدن
Breadcrumbs::for('cities', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.cities'), '#');
});

Breadcrumbs::for('cities.create', function (BreadcrumbTrail $trail) {
    $trail->parent('cities');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('cities.edit', function (BreadcrumbTrail $trail, $city) {
    $trail->parent('cities');
    $trail->push(__('translate.edit') . ' - #' . $city->id, '#');
});

// المتغيرات
Breadcrumbs::for('variations', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.variations'), '#');
});

Breadcrumbs::for('variations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('variations');
    $trail->push(__('translate.create'), '#');
});

Breadcrumbs::for('variations.edit', function (BreadcrumbTrail $trail, $variation) {
    $trail->parent('variations');
    $trail->push(__('translate.edit') . ' - #' . $variation->id, '#');
});
