<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'categories' => [
        'name' => 'Categories',
        'index_title' => 'Categories List',
        'new_title' => 'New Category',
        'create_title' => 'Create Category',
        'edit_title' => 'Edit Category',
        'show_title' => 'Show Category',
        'inputs' => [
            'donation_id' => 'Donation',
            'item_id' => 'Item',
        ],
    ],

    'donations' => [
        'name' => 'Donations',
        'index_title' => 'Donations List',
        'new_title' => 'New Donation',
        'create_title' => 'Create Donation',
        'edit_title' => 'Edit Donation',
        'show_title' => 'Show Donation',
        'inputs' => [
            'name' => 'Name',
            'status' => 'Status',
            'donation_detales_id' => 'Donation Detales',
            'order_id' => 'Order',
        ],
    ],

    'all_donation_detales' => [
        'name' => 'All Donation Detales',
        'index_title' => 'AllDonationDetales List',
        'new_title' => 'New Donation detales',
        'create_title' => 'Create DonationDetales',
        'edit_title' => 'Edit DonationDetales',
        'show_title' => 'Show DonationDetales',
        'inputs' => [
            'donation_entity_id' => 'Donation Entity',
            'name' => 'Name',
            'person' => 'Person',
            'logo' => 'Logo',
            'number' => 'Number',
        ],
    ],

    'donation_entities' => [
        'name' => 'Donation Entities',
        'index_title' => 'DonationEntities List',
        'new_title' => 'New Donation entity',
        'create_title' => 'Create DonationEntity',
        'edit_title' => 'Edit DonationEntity',
        'show_title' => 'Show DonationEntity',
        'inputs' => [
            'name' => 'Name',
            'status' => 'Status',
        ],
    ],

    'items' => [
        'name' => 'Items',
        'index_title' => 'Items List',
        'new_title' => 'New Item',
        'create_title' => 'Create Item',
        'edit_title' => 'Edit Item',
        'show_title' => 'Show Item',
        'inputs' => [
            'name' => 'Name',
            'store_house_id' => 'Store House',
        ],
    ],

    'all_item_details' => [
        'name' => 'All Item Details',
        'index_title' => 'AllItemDetails List',
        'new_title' => 'New Item details',
        'create_title' => 'Create ItemDetails',
        'edit_title' => 'Edit ItemDetails',
        'show_title' => 'Show ItemDetails',
        'inputs' => [
            'item_id' => 'Item',
            'name' => 'Name',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'orederNumber' => 'Oreder Number',
            'from' => 'From',
            'to' => 'To',
        ],
    ],

    'rolls' => [
        'name' => 'Rolls',
        'index_title' => 'Rolls List',
        'new_title' => 'New Roll',
        'create_title' => 'Create Roll',
        'edit_title' => 'Edit Roll',
        'show_title' => 'Show Roll',
        'inputs' => [
            'name' => 'Name',
            'user_id' => 'User',
        ],
    ],

    'scout_commissions' => [
        'name' => 'Scout Commissions',
        'index_title' => 'ScoutCommissions List',
        'new_title' => 'New Scout commission',
        'create_title' => 'Create ScoutCommission',
        'edit_title' => 'Edit ScoutCommission',
        'show_title' => 'Show ScoutCommission',
        'inputs' => [
            'name' => 'Name',
            'phone' => 'Phone',
            'status' => 'Status',
            'store_house_id' => 'Store House',
            'order_id' => 'Order',
            'user_id' => 'User',
            'scout_regiment_id' => 'Scout Regiment',
        ],
    ],

    'scout_regiments' => [
        'name' => 'Scout Regiments',
        'index_title' => 'ScoutRegiments List',
        'new_title' => 'New Scout regiment',
        'create_title' => 'Create ScoutRegiment',
        'edit_title' => 'Edit ScoutRegiment',
        'show_title' => 'Show ScoutRegiment',
        'inputs' => [
            'name' => 'Name',
            'phone' => 'Phone',
            'status' => 'Status',
            'store_house_id' => 'Store House',
            'order_id' => 'Order',
        ],
    ],

    'store_houses' => [
        'name' => 'Store Houses',
        'index_title' => 'StoreHouses List',
        'new_title' => 'New Store house',
        'create_title' => 'Create StoreHouse',
        'edit_title' => 'Edit StoreHouse',
        'show_title' => 'Show StoreHouse',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'transprters' => [
        'name' => 'Transprters',
        'index_title' => 'Transprters List',
        'new_title' => 'New Transprter',
        'create_title' => 'Create Transprter',
        'edit_title' => 'Edit Transprter',
        'show_title' => 'Show Transprter',
        'inputs' => [
            'name' => 'Name',
            'identity' => 'Identity',
            'photo' => 'Photo',
            'address' => 'Address',
            'order_id' => 'Order',
        ],
    ],

    'transprter_types' => [
        'name' => 'Transprter Types',
        'index_title' => 'TransprterTypes List',
        'new_title' => 'New Transprter type',
        'create_title' => 'Create TransprterType',
        'edit_title' => 'Edit TransprterType',
        'show_title' => 'Show TransprterType',
        'inputs' => [
            'name' => 'Name',
            'status' => 'Status',
            'transprter_id' => 'Transprter',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'phone number' => 'Phone Number',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
