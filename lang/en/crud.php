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

    'customers' => [
        'name' => 'Customers',
        'index_title' => 'Customers List',
        'new_title' => 'New Customer',
        'create_title' => 'Create Customer',
        'edit_title' => 'Edit Customer',
        'show_title' => 'Show Customer',
        'inputs' => [
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'fax' => 'Fax',
            'address' => 'Address',
            'billing_address' => 'Billing Address',
            'postal_code' => 'Postal Code',
            'website' => 'Website',
            'city' => 'City',
            'customer_status_id' => 'Customer Status',
            'country_id' => 'Country',
            'region_id' => 'Region',
            'customer_rating_id' => 'Customer Rating',
            'industry_id' => 'Industry',
        ],
    ],

    'productlines' => [
        'name' => 'Productlines',
        'index_title' => 'Productlines List',
        'new_title' => 'New Productline',
        'create_title' => 'Create Productline',
        'edit_title' => 'Edit Productline',
        'show_title' => 'Show Productline',
        'inputs' => [
            'name' => 'Name',
            'pricebook_id' => 'Pricebook',
            'customer_id' => 'Customer',
        ],
    ],

    'pricebooks' => [
        'name' => 'Pricebooks',
        'index_title' => 'Pricebooks List',
        'new_title' => 'New Pricebook',
        'create_title' => 'Create Pricebook',
        'edit_title' => 'Edit Pricebook',
        'show_title' => 'Show Pricebook',
        'inputs' => [
            'name' => 'Name',
            'currency_id' => 'Currency',
        ],
    ],

    'projects' => [
        'name' => 'Projects',
        'index_title' => 'Projects List',
        'new_title' => 'New Project',
        'create_title' => 'Create Project',
        'edit_title' => 'Edit Project',
        'show_title' => 'Show Project',
        'inputs' => [
            'name' => 'Name',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'productline_id' => 'Productline',
            'po_number' => 'Po Number',
        ],
    ],

    'jobs' => [
        'name' => 'Jobs',
        'index_title' => 'Jobs List',
        'new_title' => 'New Job',
        'create_title' => 'Create Job',
        'edit_title' => 'Edit Job',
        'show_title' => 'Show Job',
        'inputs' => [
            'name' => 'Name',
            'project_id' => 'Project',
            'source_language_id' => 'Source Language',
            'target_language_id' => 'Target Language',
            'job_type_id' => 'Job Type',
            'job_unit_id' => 'Job Unit',
            'amount' => 'Amount',
            'is_free_job' => 'Is Free Job',
            'is_minimum_charge_used' => 'Is Minimum Charge Used',
        ],
    ],

    'tasks' => [
        'name' => 'Tasks',
        'index_title' => 'Tasks List',
        'new_title' => 'New Task',
        'create_title' => 'Create Task',
        'edit_title' => 'Edit Task',
        'show_title' => 'Show Task',
        'inputs' => [
            'name' => 'Name',
            'job_id' => 'Job',
            'start_date' => 'Start Date',
            'delivery_date' => 'Delivery Date',
            'task_type_id' => 'Task Type',
            'task_unit_id' => 'Task Unit',
            'subject_matter_id' => 'Subject Matter',
            'translator_id' => 'Translator',
            'amount' => 'Amount',
            'is_paid' => 'Is Paid',
            'status' => 'Status',
            'notes' => 'Notes',
        ],
    ],

    'portals' => [
        'name' => 'Portals',
        'index_title' => 'Portals List',
        'new_title' => 'New Portal',
        'create_title' => 'Create Portal',
        'edit_title' => 'Edit Portal',
        'show_title' => 'Show Portal',
        'inputs' => [
            'name' => 'Name',
            'url' => 'Url',
            'username' => 'Username',
            'password' => 'Password',
        ],
    ],

    'opportunities' => [
        'name' => 'Opportunities',
        'index_title' => 'Opportunities List',
        'new_title' => 'New Opportunity',
        'create_title' => 'Create Opportunity',
        'edit_title' => 'Edit Opportunity',
        'show_title' => 'Show Opportunity',
        'inputs' => [
            'name' => 'Name',
            'date' => 'Date',
            'description' => 'Description',
            'amount' => 'Amount',
            'price' => 'Price',
            'probability_to_win' => 'Probability To Win',
            'status' => 'Status',
            'source_language_id' => 'Source Language',
            'target_language_id' => 'Target Language',
            'productline_id' => 'Productline',
            'opportunity_type_id' => 'Opportunity Type',
            'opportunity_unit_id' => 'Opportunity Unit',
        ],
    ],

    'resources' => [
        'name' => 'Resources',
        'index_title' => 'Resources List',
        'new_title' => 'New Resource',
        'create_title' => 'Create Resource',
        'edit_title' => 'Edit Resource',
        'show_title' => 'Show Resource',
        'inputs' => [
            'name' => 'Name',
            'degree' => 'Degree',
            'gender' => 'Gender',
            'date_of_birth' => 'Date Of Birth',
            'nationality' => 'Nationality',
            'experience' => 'Experience',
            'id_number' => 'Id Number',
            'vat_number' => 'Vat Number',
            'id_other' => 'Id Other',
            'timezone' => 'Timezone',
            'website' => 'Website',
            'skype' => 'Skype',
            'address' => 'Address',
            'city' => 'City',
            'postal_code' => 'Postal Code',
            'payment_after' => 'Payment After',
            'nda' => 'Nda',
            'cv' => 'Cv',
            'native_language' => 'Native Language',
            'second_language' => 'Second Language',
            'translator_type_id' => 'Translator Type',
            'country_id' => 'Country',
            'currency_id' => 'Currency',
        ],
    ],

    'resource_contacts' => [
        'name' => 'Resource Contacts',
        'index_title' => 'Contacts List',
        'new_title' => 'New Contact',
        'create_title' => 'Create Contact',
        'edit_title' => 'Edit Contact',
        'show_title' => 'Show Contact',
        'inputs' => [
            'name' => 'Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'position' => 'Position',
        ],
    ],

    'resources_pricelists' => [
        'name' => 'Resources Pricelists',
        'index_title' => 'Resource Pricelists',
        'new_title' => 'New Resource Pricelist',
        'create_title' => 'Create Resource Pricelist',
        'edit_title' => 'Edit Resource Pricelist',
        'show_title' => 'Show Resource Pricelist',
        'inputs' => [
            'task_type_id' => 'Task Type',
            'source_language_id' => 'Source Language',
            'target_language_id' => 'Target Language',
            'subject_matter_id' => 'Subject Matter',
            'currency_id' => 'Currency',
            'task_unit_id' => 'Task Unit',
            'unit_price' => 'Unit Price',
            'minimum_charge' => 'Minimum Charge',
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
