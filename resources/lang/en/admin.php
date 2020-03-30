<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'camp' => [
        'title' => 'Camps',

        'actions' => [
            'index' => 'Camps',
            'create' => 'New Camp',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'location' => 'Location',
            'entries' => 'Entries',
            'cost' => 'Cost',
            'date' => 'Date',
            
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'email_verified_at' => 'Email verified at',
            'password' => 'Password',
            'is_blocked' => 'Is blocked',
            
        ],
    ],

    'payment-method' => [
        'title' => 'Payment Methods',

        'actions' => [
            'index' => 'Payment Methods',
            'create' => 'New Payment Method',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'bank' => [
        'title' => 'Banks',

        'actions' => [
            'index' => 'Banks',
            'create' => 'New Bank',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'payment-method' => [
        'title' => 'Payment-Methods',

        'actions' => [
            'index' => 'Payment-Methods',
            'create' => 'New Payment-Method',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'method' => [
        'title' => 'Methods',

        'actions' => [
            'index' => 'Methods',
            'create' => 'New Method',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'camps-payment' => [
        'title' => 'Camps Payments',

        'actions' => [
            'index' => 'Camps Payments',
            'create' => 'New Camps Payment',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'reference' => 'Reference',
            'photo' => 'Photo',
            'date' => 'Date',
            'validated' => 'Validated',
            'method_id' => 'Method',
            'camp_id' => 'Camp',
            'user_id' => 'User',
            'bank_id' => 'Bank',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];