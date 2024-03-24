<?php

declare(strict_types=1);

return [
    'attributes' => [
        'address'                  => '地址',
        'affiliate_url'            => '附屬網址',
        'age'                      => '年齡',
        'amount'                   => '數量',
        'area'                     => '區域',
        'available'                => '可用的',
        'birthday'                 => '生日',
        'body'                     => '身體',
        'city'                     => '城市',
        'content'                  => '內容',
        'country'                  => '國家',
        'created_at'               => '創建於',
        'creator'                  => '創造者',
        'currency'                 => '貨幣',
        'current_password'         => '當前密碼',
        'customer'                 => '顧客',
        'date'                     => '日期',
        'date_of_birth'            => '出生日期',
        'day'                      => '天',
        'deleted_at'               => '刪除於',
        'description'              => '描述',
        'district'                 => '區',
        'duration'                 => '期間',
        'email'                    => 'e-mail',
        'excerpt'                  => '摘要',
        'filter'                   => '篩選',
        'first_name'               => '名',
        'gender'                   => '性別',
        'group'                    => '團體',
        'hour'                     => '時',
        'image'                    => '圖片',
        'is_subscribed'            => '已訂閱',
        'items'                    => '專案',
        'last_name'                => '姓',
        'lesson'                   => '課',
        'line_address_1'           => '行地址 1',
        'line_address_2'           => '行地址 2',
        'message'                  => '信息',
        'middle_name'              => '中間名字',
        'minute'                   => '分',
        'mobile'                   => '手機',
        'month'                    => '月',
        'name'                     => '名稱',
        'national_code'            => '國家代碼',
        'number'                   => '數字',
        'password'                 => '密碼',
        'password_confirmation'    => '確認密碼',
        'phone'                    => '電話',
        'photo'                    => '照片',
        'postal_code'              => '郵政編碼',
        'preview'                  => '預覽',
        'price'                    => '價格',
        'product_id'               => '產品編號',
        'product_uid'              => '產品UID',
        'product_uuid'             => '產品UUID',
        'promo_code'               => '促銷代碼',
        'province'                 => '省',
        'quantity'                 => '數量',
        'recaptcha_response_field' => '重新驗證響應字段',
        'remember'                 => '記住',
        'restored_at'              => '恢復於',
        'result_text_under_image'  => '圖片下方的結果文本',
        'role'                     => '角色',
        'second'                   => '秒',
        'sex'                      => '性別',
        'shipment'                 => '運輸',
        'short_text'               => '短文',
        'size'                     => '大小',
        'state'                    => '狀態',
        'street'                   => '街道',
        'student'                  => '學生',
        'subject'                  => '主題',
        'teacher'                  => '老師',
        'terms'                    => '條款',
        'test_description'         => '測試說明',
        'test_locale'              => '測試語言環境',
        'test_name'                => '測試名稱',
        'text'                     => '文本',
        'time'                     => '時間',
        'title'                    => '標題',
        'updated_at'               => '更新於',
        'user'                     => '使用者',
        'username'                 => '使用者名稱',
        'year'                     => '年',

        'account'                  => '帳號',
        'password_confirm'         => '密碼確認',
    ],
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

    'accepted'             => '必須接受 :attribute',
    'active_url'           => ':attribute 必須是可使用的URL地址',
    'after'                => ':attribute 必須是在 :date 之後的日期',
    'alpha'                => ':attribute 只能包含英文字母',
    'alpha_dash'           => ':attribute 只能包含英文字母，數字和-',
    'alpha_num'            => ':attribute 只能包含英文字母和數字',
    'array'                => ':attribute 必須是陣列',
    'before'               => ':attribute 必須是在 :date. 之前的日期',
    'between'              => [
        'numeric' => ':attribute 必須介於 :min 至 :max 之間',
        'file'    => ':attribute 大小必須介於 :min kb 至 :max kb 之間',
        'string'  => ':attribute 長度必須介於 :min 至 :max 之間',
        'array'   => ':attribute 包含的長度必須介於 :min 至 :max 個之間',
    ],
    'boolean'              => ':attribute 必須是 true 或 false',
    'confirmed'            => ':attribute 必須一致',
    'date'                 => ':attribute 不是有效的日期',
    'date_format'          => ':attribute 必須符合格式 :format',
    'different'            => ':attribute 與 :other 必須不同',
    'digits'               => ':attribute 必須是 :digits 位數',
    'digits_between'       => ':attribute 的位數必須介於 :min 與 :max 之間',
    'distinct'             => ':attribute 已存在',
    'email'                => ':attribute 必須是有效的電子郵件位址',
    'exists'               => ':attribute 須存在',
    'filled'               => ':attribute 為必填',
    'image'                => ':attribute 必須是圖片',
    'in'                   => ':attribute 不是有效值',
    'in_array'             => ':attribute 不存在於 :other',
    'integer'              => ':attribute 必須是整數',
    'ip'                   => ':attribute 必須是有效的 IP 位址',
    'json'                 => ':attribute 必須是有效的 JSON 字串',
    'max'                  => [
        'numeric' => ':attribute 不能大於 :max',
        'file'    => ':attribute 的大小不能超過 :max kb',
        'string'  => ':attribute 不能超過 :max 個字元',
        'array'   => ':attribute 不能包含超過 :max 個',
    ],
    'mimes'                => ':attribute 必須是一個 :values 檔案',
    'min'                  => [
        'numeric' => ':attribute 不能小於 :min',
        'file'    => ':attribute 的大小不能小於 :min kb',
        'string'  => ':attribute 必須至少 :min 個字元',
        'array'   => ':attribute 必須至少有 :min 個',
    ],
    'not_in'               => ':attribute 是無效值',
    'numeric'              => ':attribute 必須是數字',
    'present'              => ':attribute 必須出現',
    'regex'                => ':attribute 格式無效',
    'required'             => ':attribute 為必填',
    'required_if'          => '當 :other 是 :value時，:attribute 為必填',
    'required_unless'      => '除非 :other 在 :values 之中，:attribute 為必填',
    'required_with'        => '當 :values 出現時，:attribute 為必填',
    'required_with_all'    => '當 :values 出現時，:attribute 為必填',
    'required_without'     => '當 :values 沒有出現時，:attribute 為必填',
    'required_without_all' => '當 :values 沒有出現時，:attribute 為必填',
    'same'                 => ':attribute 與 :other 須相符',
    'size'                 => [
        'numeric' => ':attribute 必須是 :size',
        'file'    => ':attribute 必須是 :size kb',
        'string'  => ':attribute 必須有 :size 個字元',
        'array'   => ':attribute 必須包含 :size 個',
    ],
    'string'               => ':attribute 必須是字串',
    'timezone'             => ':attribute 必須是有效的時區',
    'unique'               => ':attribute 已存在',
    'url'                  => ':attribute 必須是有效的url',

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

    // 'attributes' => [],
];
