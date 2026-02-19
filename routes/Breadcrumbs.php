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

Breadcrumbs::for('settings.prescription_options', function (BreadcrumbTrail $trail) {
    $trail->parent('settings');
    $trail->push(__('translate.prescription_options'), route('dashboard.settings.prescription-options.index'));
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

// العيادة / Clinic
Breadcrumbs::for('clinic.specializations', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.specializations'), route('dashboard.clinic.specializations.index'));
});
Breadcrumbs::for('clinic.specializations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.specializations');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.specializations.edit', function (BreadcrumbTrail $trail, $specialization) {
    $trail->parent('clinic.specializations');
    $trail->push(__('translate.edit') . ' - ' . ($specialization->specialization_name ?? $specialization->id), '#');
});

Breadcrumbs::for('clinic.doctors', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.doctors'), route('dashboard.clinic.doctors.index'));
});
Breadcrumbs::for('clinic.doctors.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.doctors');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.doctors.edit', function (BreadcrumbTrail $trail, $doctor) {
    $trail->parent('clinic.doctors');
    $trail->push(__('translate.edit') . ' - ' . ($doctor->full_name ?? $doctor->id), '#');
});

Breadcrumbs::for('clinic.employees', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.employees'), route('dashboard.clinic.employees.index'));
});
Breadcrumbs::for('clinic.employees.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.employees');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.employees.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('clinic.employees');
    $trail->push(__('translate.edit') . ' - ' . ($employee->full_name ?? $employee->id), '#');
});

Breadcrumbs::for('clinic.patients', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.patients'), route('dashboard.clinic.patients.index'));
});
Breadcrumbs::for('clinic.patients.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.patients');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.patients.edit', function (BreadcrumbTrail $trail, $patient) {
    $trail->parent('clinic.patients');
    $trail->push(__('translate.edit') . ' - ' . ($patient->full_name ?? $patient->id), '#');
});
Breadcrumbs::for('clinic.patients.show', function (BreadcrumbTrail $trail, $patient) {
    $trail->parent('clinic.patients');
    $trail->push($patient->name ?? $patient->id, '#');
});

Breadcrumbs::for('clinic.medications', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.medications'), route('dashboard.clinic.medications.index'));
});
Breadcrumbs::for('clinic.medications.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.medications');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.medications.edit', function (BreadcrumbTrail $trail, $medication) {
    $trail->parent('clinic.medications');
    $trail->push(__('translate.edit') . ' - ' . ($medication->medication_name ?? $medication->id), '#');
});

Breadcrumbs::for('clinic.appointments', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.appointments'), route('dashboard.clinic.appointments.index'));
});
Breadcrumbs::for('clinic.appointments.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.appointments');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.appointments.edit', function (BreadcrumbTrail $trail, $appointment) {
    $trail->parent('clinic.appointments');
    $trail->push(__('translate.edit') . ' - #' . ($appointment->id ?? ''), '#');
});

Breadcrumbs::for('clinic.prescriptions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.prescriptions'), route('dashboard.clinic.prescriptions.index'));
});
Breadcrumbs::for('clinic.prescriptions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.prescriptions');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.prescriptions.edit', function (BreadcrumbTrail $trail, $prescription) {
    $trail->parent('clinic.prescriptions');
    $trail->push(__('translate.edit') . ' - #' . ($prescription->id ?? ''), '#');
});

Breadcrumbs::for('clinic.examinations', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push(__('translate.medical_examinations'), route('dashboard.clinic.examinations.index'));
});
Breadcrumbs::for('clinic.examinations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('clinic.examinations');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('clinic.examinations.edit', function (BreadcrumbTrail $trail, $examination) {
    $trail->parent('clinic.examinations');
    $trail->push(__('translate.edit') . ' - #' . ($examination->id ?? ''), '#');
});

// قسم الطبيب / Doctor Section
Breadcrumbs::for('doctor.home', function (BreadcrumbTrail $trail) {
    $trail->push(__('translate.home'), route('doctor.home'));
});

// المواعيد للطبيب
Breadcrumbs::for('doctor.appointments', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.home');
    $trail->push(__('translate.appointments'), route('doctor.appointments.index'));
});
Breadcrumbs::for('doctor.appointments.create', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.appointments');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('doctor.appointments.edit', function (BreadcrumbTrail $trail, $appointment) {
    $trail->parent('doctor.appointments');
    $trail->push(__('translate.edit') . ' - #' . ($appointment->id ?? ''), '#');
});

// الموظفون للطبيب
Breadcrumbs::for('doctor.employees', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.home');
    $trail->push(__('translate.employees'), route('doctor.employees.index'));
});
Breadcrumbs::for('doctor.employees.create', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.employees');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('doctor.employees.edit', function (BreadcrumbTrail $trail, $employee) {
    $trail->parent('doctor.employees');
    $trail->push(__('translate.edit') . ' - ' . ($employee->full_name ?? $employee->id), '#');
});

// المرضى للطبيب
Breadcrumbs::for('doctor.patients', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.home');
    $trail->push(__('translate.patients'), route('doctor.patients.index'));
});
Breadcrumbs::for('doctor.patients.show', function (BreadcrumbTrail $trail, $patient) {
    $trail->parent('doctor.patients');
    $trail->push($patient->name ?? $patient->id, '#');
});

// الفحوصات للطبيب
Breadcrumbs::for('doctor.examinations', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.home');
    $trail->push(__('translate.medical_examinations'), route('doctor.examinations.index'));
});
Breadcrumbs::for('doctor.examinations.create', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.examinations');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('doctor.examinations.edit', function (BreadcrumbTrail $trail, $examination) {
    $trail->parent('doctor.examinations');
    $trail->push(__('translate.edit') . ' - #' . ($examination->id ?? ''), '#');
});

// الروشتات للطبيب
Breadcrumbs::for('doctor.prescriptions', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.home');
    $trail->push(__('translate.prescriptions'), route('doctor.prescriptions.index'));
});
Breadcrumbs::for('doctor.prescriptions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('doctor.prescriptions');
    $trail->push(__('translate.create'), '#');
});
Breadcrumbs::for('doctor.prescriptions.edit', function (BreadcrumbTrail $trail, $prescription) {
    $trail->parent('doctor.prescriptions');
    $trail->push(__('translate.edit') . ' - #' . ($prescription->id ?? ''), '#');
});
