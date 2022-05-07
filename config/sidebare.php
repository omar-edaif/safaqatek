<?php
// [
//     'name_en' => '',
//     'name_ar' => '',
//     'icon' => '',
//     'children' => [
//         [
//             'route' => '/',
//             'name_en' => '',
//             'name_ar' => '   ',
//         ]
//     ],
//     'is_namespace' => false,

// ],

return [
    [
        'name_en' => "menu",
        'name_ar' => 'قائمة',
        'is_namespace' => true,

    ],
    [
        'name_en' => "home",
        'name_ar' => "الرئيسية",
        'icon' => 'bx bx-home-circle',
        'route' => 'dashbord.users.index',
        'is_namespace' => false,
    ],
    [
        'name_en' => "users",
        'name_ar' => 'المستخدمون',
        'is_namespace' => true,

    ],
    [
        'name_en' => "users",
        'name_ar' => "المستخدمين",
        'icon' => 'bx bx-user',
        'route' => 'dashbord.users.index',
        'is_namespace' => false,
    ],
    [
        'name_en' => "Ecommerce",
        'name_ar' => 'التجارة',
        'is_namespace' => true,

    ],
    [
        'name_en' => "products",
        'name_ar' => "المنتوجات",
        'icon' => 'bx bx-store',
        'route' => 'dashbord.products.index',
        'is_namespace' => false,
    ],
    [
        'name_en' => "orders",
        'name_ar' => "الطلبات",
        'icon' => 'bx bx-receipt ',
        'route' => 'dashbord.products.orders',
        'is_namespace' => false,
    ],
    [
        'name_en' => "winners",
        'name_ar' => "الفائزون",
        'icon' => 'bx bx-trophy ',
        'route' => 'dashbord.users.index',
        'is_namespace' => false,
    ],
    [
        'name_en' => "settings",
        'name_ar' => 'الإعدادات',
        'is_namespace' => true,

    ],
    [
        'name_en' => "payment",
        'name_ar' => "الدفع",
        'icon' => 'bx bx-money',
        'route' => 'dashbord.users.index',
        'is_namespace' => false,
    ],
    // [
    //     'name_en' => "orders",
    //     'name_ar' => "الطلبات",
    //     'icon' => 'bx bx-receipt ',
    //     'route' => 'qs',
    //     'is_namespace' => false,
    // ],


];
