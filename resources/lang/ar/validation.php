<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'يجب قبول :attribute.',
    'active_url'           => ':attribute لا يُمثّل رابطًا صحيحًا.',
    'after'                => 'يجب على :attribute أن يكون تاريخًا لاحقًا للتاريخ اليوم',
    'after_or_equal'       => ':attribute يجب أن يكون تاريخاً لاحقاً أو مطابقاً للتاريخ :date.',
    'alpha'                => 'يجب أن لا يحتوي :attribute سوى على حروف.',
    'alpha_dash'           => 'يجب أن لا يحتوي :attribute سوى على حروف، أرقام ومطّات.',
    'alpha_num'            => 'يجب أن يحتوي :attribute على حروفٍ وأرقامٍ فقط.',
    'array'                => 'يجب أن يكون :attribute ًمصفوفة.',
    'before'               => 'يجب على :attribute أن يكون تاريخًا سابقًا للتاريخ :date.',
    'before_or_equal'      => ':attribute يجب أن يكون تاريخا سابقا أو مطابقا للتاريخ :date.',
    'between'              => [
        'numeric' => 'يجب أن تكون قيمة :attribute بين :min و :max.',
        'file'    => 'يجب أن يكون حجم الملف :attribute بين :min و :max كيلوبايت.',
        'string'  => 'يجب أن يكون عدد حروف النّص :attribute بين :min و :max.',
        'array'   => 'يجب أن يحتوي :attribute على عدد من العناصر بين :min و :max.',
    ],
    'boolean'              => 'يجب أن تكون قيمة :attribute إما true أو false .',
    'confirmed'            => 'حقل التأكيد غير مُطابق للحقل :attribute.',
    'date'                 => ':attribute ليس تاريخًا صحيحًا.',
    'date_equals'          => 'يجب أن يكون :attribute مطابقاً للتاريخ :date.',
    'date_format'          => 'لا يتوافق :attribute مع الشكل :format.',
    'different'            => 'يجب أن يكون الحقلان :attribute و :other مُختلفين.',
    'digits'               => 'يجب أن يحتوي :attribute على :digits رقمًا/أرقام.',
    'digits_between'       => 'يجب أن يحتوي :attribute بين :min و :max رقمًا/أرقام .',
    'dimensions'           => 'الـ :attribute يحتوي على أبعاد صورة غير صالحة.',
    'distinct'             => 'للحقل :attribute قيمة مُكرّرة.',
    'email'                => 'يجب أن يكون :attribute عنوان بريد إلكتروني صحيح البُنية.',
    'exists'               => 'القيمة المحددة :attribute غير موجودة.',
    'file'                 => 'الـ :attribute يجب أن يكون ملفا.',
    'filled'               => ':attribute إجباري.',
    'gt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أكبر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أكثر من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'gte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :value عُنصرًا/عناصر.',
    ],
    'image'                => 'يجب أن يكون :attribute صورةً.',
    'in'                   => ':attribute غير موجود.',
    'in_array'             => ':attribute غير موجود في :other.',
    'integer'              => 'يجب أن يكون :attribute عددًا صحيحًا.',
    'ip'                   => 'يجب أن يكون :attribute عنوان IP صحيحًا.',
    'ipv4'                 => 'يجب أن يكون :attribute عنوان IPv4 صحيحًا.',
    'ipv6'                 => 'يجب أن يكون :attribute عنوان IPv6 صحيحًا.',
    'json'                 => 'يجب أن يكون :attribute نصآ من نوع JSON.',
    'lt'                   => [
        'numeric' => 'يجب أن تكون قيمة :attribute أصغر من :value.',
        'file'    => 'يجب أن يكون حجم الملف :attribute أصغر من :value كيلوبايت.',
        'string'  => 'يجب أن يكون طول النّص :attribute أقل من :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على أقل من :value عناصر/عنصر.',
    ],
    'lte'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :value.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :value كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :value حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :value عناصر/عنصر.',
    ],
    'max'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أصغر من :max.',
        'file'    => 'يجب أن لا يتجاوز حجم الملف :attribute :max كيلوبايت.',
        'string'  => 'يجب أن لا يتجاوز طول النّص :attribute :max حروفٍ/حرفًا.',
        'array'   => 'يجب أن لا يحتوي :attribute على أكثر من :max عناصر/عنصر.',
    ],
    'mimes'                => 'يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes'            => 'يجب أن يكون ملفًا من نوع : :values.',
    'min'                  => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية أو أكبر من :min.',
        'file'    => 'يجب أن يكون حجم الملف :attribute على الأقل :min كيلوبايت.',
        'string'  => 'يجب أن يكون طول النص :attribute على الأقل :min حروفٍ/حرفًا.',
        'array'   => 'يجب أن يحتوي :attribute على الأقل على :min عُنصرًا/عناصر.',
    ],
    'not_in'               => ':attribute موجود.',
    'not_regex'            => 'صيغة :attribute غير صحيحة.',
    'numeric'              => 'يجب على :attribute أن يكون رقمًا.',
    'present'              => 'يجب تقديم :attribute.',
    'regex'                => 'صيغة :attribute .غير صحيحة.',
    'required'             => ':attribute مطلوب.',
    'required_if'          => ':attribute مطلوب في حال ما إذا كان :other يساوي :value.',
    'required_unless'      => ':attribute مطلوب في حال ما لم يكن :other يساوي :values.',
    'required_with'        => ':attribute مطلوب إذا توفّر :values.',
    'required_with_all'    => ':attribute مطلوب إذا توفّر :values.',
    'required_without'     => ':attribute مطلوب إذا لم يتوفّر :values.',
    'required_without_all' => ':attribute مطلوب إذا لم يتوفّر :values.',
    'same'                 => 'يجب أن يتطابق :attribute مع :other.',
    'size'                 => [
        'numeric' => 'يجب أن تكون قيمة :attribute مساوية لـ :size.',
        'file'    => 'يجب أن يكون حجم الملف :attribute :size كيلوبايت.',
        'string'  => 'يجب أن يحتوي النص :attribute على :size حروفٍ/حرفًا بالضبط.',
        'array'   => 'يجب أن يحتوي :attribute على :size عنصرٍ/عناصر بالضبط.',
    ],
    'starts_with'          => 'يجب أن يبدأ :attribute بأحد القيم التالية: :values',
    'string'               => 'يجب أن يكون :attribute نصًا.',
    'timezone'             => 'يجب أن يكون :attribute نطاقًا زمنيًا صحيحًا.',
    'unique'               => 'قيمة :attribute مُستخدمة من قبل.',
    'uploaded'             => 'فشل في تحميل الـ :attribute.',
    'url'                  => 'صيغة الرابط :attribute غير صحيحة.',
    'uuid'                 => ':attribute يجب أن يكون بصيغة UUID سليمة.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
        'name'                  => 'الإسم',
        'email'                 => 'البريد الإلكترونى',
        'password'              => 'كلمة المرور',
        'password_confirmation' => 'تأكيد كلمة المرور',
        'city'                  => 'المدينة',
        'phone'                 => 'الهاتف',
        'mobile'                => 'الجوال',
        'gender'                => 'الجنس',
        'day'                   => 'اليوم',
        'month'                 => 'الشهر',
        'year'                  => 'السنة',
        'hour'                  => 'ساعة',
        'minute'                => 'دقيقة',
        'second'                => 'ثانية',
        'title'                 => 'العنوان',
        'content'               => 'المُحتوى',
        'description'           => 'الوصف',
        'excerpt'               => 'المُلخص',
        'date'                  => 'التاريخ',
        'time'                  => 'الوقت',
        'available'             => 'مُتاح',
        'size'                  => 'الحجم',
        'location'              => 'الموقع',
        'provider_id'           => 'رقم المزود',
        'provider_type'         => 'نوع المزود',
        'profile_pic'           => 'الصورة الشخصية',

        'extra_details'         => 'تفاصيل إضافية',
        'id'         => 'العنصر',
        'type'       => 'النوع',
        'today'      => 'اليوم',
        'city_id'       => 'المدينة',
        'message'       => 'الرسالة',
        'device_id'     => 'معرف الهاتف',
        'fcm_registration' => 'معرف الفاير بيز',
        'os_type'          => 'نوع الجهاز',
        'title_ar'         => 'عنوان التنبيه بالعربية',
        'title_en'         => 'عنوان التنبيه بالإنجليزية',
        'text_ar'         => 'التنبيه بالعربية',
        'text_en'         => 'التنبيه بالإنجليزية',
        'status'         => 'الحالة',
        'lang'           => 'اللغة',
        'no_of_days' => 'عدد الايام',
        'copassword' => 'تأكيد كلمة المرور',
        'number' => 'الرقم',
        'type_ar' => 'النوع بالعربية',
        'type_en' => 'النوع بالانجليزية',
        'photo' => 'الصورة',
        'start_date' => 'تاريخ بداية',
        'end_date' => 'تاريخ نهاية',

        'method_type' => 'النوع الميثود',
        'current_password' => 'كلمة المرور الحالية',
        'file' => 'ملف',
        'reading_type_id' => 'نوع القراءة',
        "image" => 'الصورة',
        'permissions' => 'الصلاحيات',
        "name_en" => 'الإسم بالانجليزى',
        "name_ar" => 'الإسم بالعربي',
        "google_place_id" => 'متجر جوجل',
        "logo" => 'الشعار',
        "category" => 'القسم',
        "local_place_id" => 'المتجر المسجل',
        "product_id" => 'المنتج',
        "car_type_id" => 'نوع السيارة',
        "car_year_id" => 'سنة الصنع',
        "bank_id" => 'البنك',
        "bank_account_number" => 'رقم الحساب',
        "user_image" => 'الصورة الشخصية',
        "national_id_card_image" => 'صورة البطاقة الشخصية',
        "driving_licence_image" => 'صورة رخصة القيادة',
        "car_licence_image" => 'صورة رخصة السيارة',
        "rating" => 'التقيم',
        "review" => 'التقيم المكتوب',
        "code" => 'الكود',
        "notify_token" => 'توكن التنبيهات',
        "place_address" => 'عنوان المتجر',
        "place_name" => 'اسم المتجر',
        "place_logo_link" => 'شعار المتجر',
        "price" => 'السعر',
        "duration_in_days" => 'المدة بالأيام',
        "duration_in_hours" => 'المدةبالساعات',
        "duration_in_minutes" => 'المدة بالدقائق',
        "products" => 'المنتجات',
        "category_id" => 'القسم',
        "sizes" => 'الأحجام',
        "sizes.*.name" => 'اسم الحجم',
        "sizes.*.description" => 'وصف الحجم',
        "sizes.*.price" => 'سعر الحجم',
        "sizes.*.attributes" => 'صفات الحجم',
        "sizes.*.attributes.*.name" => 'اسم صفة الحجم',
        "sizes.*.attributes.*.value" => 'قيمة صفة الحجم',
        "addons" => 'الأضافات',
        "addons.*.name" => 'اسم الأضافة',
        "addons.*.price" => 'سعر الأضافة',
        "classes" => 'الفئات',
        "classes.*.name" => 'اسم الفئة',
        "classes.*.attributes" => 'صفات الفئة',
        "classes.*.attributes.*.name" => 'اسم صفة الفئة',
        "classes.*.attributes.*.price" => 'سعر صفة الفئة',
        "colors" => 'الألوان',
        "lat" => 'خط الطول',
        "lng" => 'دائرة العرض',
        "order_id" => 'الطلب',
        "status" => 'الحالة',
        "code" => 'الكود',
        "delivery_type" => 'نوع التوصيل',
        "nationality_id" => 'الجنسية',
        "national_number" => 'رقم الهوية الوطنية',
        "national_number_image" => 'صورة الهوية الوطنية',
        "driver_license_number" => 'رقم رخصة السواقة',
        "driver_license_image" => 'صورة رخصة السواقة',
        "car_type_id" => 'نوع السيارة',
        "car_license_number" => 'رقم استمارة السيارة',
        "car_license_image" => 'صورة استمارة السيارة',
        "bank_name" => 'اسم البنك',
        "bank_account_name" => 'اسم البنك',
        "bank_account_number" => 'رقم حساب البنك',
        "bank_account_iban" => 'رقم IBAN حساب البنك',
        "full_name" => 'الأسم كامل',
        "store_name" => 'اسم المتجر',
        "city_id" => 'المدينة',
        "area_id" => 'المنطقة',
        "address" => 'العنوان',
        "work_time_from" => 'بداية اوقات العمل',
        "work_time_to" => 'نهاية اوقات العمل',
        "message" => 'الرسالة',



    ],
];
