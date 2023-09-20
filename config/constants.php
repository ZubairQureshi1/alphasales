<?php
return [

    'color_codes'                 => [
        'nth_row' => 'f9f9f9',
    ],

    'system_codes'                => [
        'emp_code'          => "",
        'enquiry_form_code' => "ENQ-",
    ],

    /**
     * @return device inout module statuses
     */
    'device_in_out_models'        => [
        '1' => 'Check In',
        '2' => 'Check Out',
        '3' => 'Break In',
        '4' => 'Break Out',
    ],

    /**
     * @return left index is Machine Numbers & right index is Organization Campus ids
     */
    'campus_machines'             => [
        // form 0 to 5 for ims campus
        '0'  => '3',
        '1'  => '3',
        '2'  => '3',
        '3'  => '3',
        '4'  => '3',
        '5'  => '3',
        // from 6 to 10 for cs campus
        '6'  => '2',
        '7'  => '2',
        '8'  => '2',
        '9'  => '2',
        '10' => '2',
    ],

    'section_statuses'            => [
        '0' => 'Active',
        '1' => 'In-Active',
    ],

    'date_formats'                => [
        'current_active'      => 'l, d-M-Y',
        'default'             => 'ddd mmm dd yyyy HH:MM:ss',
        'shortDate'           => 'm/d/yy',
        'mediumDate'          => 'mmm d, yyyy',
        'longDate'            => 'mmmm d, yyyy',
        'month_year'          => 'mmmm yyyy',
        'fullDate'            => 'dddd, mmmm d, yyyy',
        'shortTime'           => 'h:MM TT',
        'mediumTime'          => 'h:MM:ss TT',
        'longTime'            => 'h:MM:ss TT Z',
        'isoDate'             => 'yyyy-mm-dd',
        'isoTime'             => 'HH:MM:ss',
        'isoDateTime'         => 'yyyy-mm-dd\'T\'HH:MM:sso',
        'isoUtcDateTime'      => 'UTC:yyyy-mm-dd\'T\'HH:MM:ss\'Z\'',
        'expiresHeaderFormat' => 'ddd, dd mmm yyyy HH:MM:ss Z',
    ],

    'enquiry_types'               => [
        'Telephonic'        => 'Telephonic',
        'Physical'          => 'Physical',
        'SM - Lead'         => 'SM - Lead',
        'Cold Lead'         => 'Cold Lead',
        'Inbound Tel. Call'    => 'Inbound Tel. Call',
        'Outbound Tel. Call'   => 'Outbound Tel. Call',
        'Others'   => 'Others',
    ],

    'entry_by'                    => [
        '0' => 'Zeeshan',
    ],

    'enquiry_general_options'     => [
        '0' => 'Yes',
        '1' => 'No',
        '2' => 'Undecided',
    ],

    'attachment_path'             => [
        'file_destination_path'       => 'uploads',
        'emp_qr_destination_path'     => '/uploads/Employees/',
        'student_qr_destination_path' => '/uploads/Students/',
        'allowed_file_types'          => 'jpg,jpeg,bmp,png,pdf',
        'max_file_size'               => 2048,
    ],

    'contact_types'               => [
        '5' => 'Self',
        '0' => 'Father',
        '1' => 'Mother',
        '2' => 'Brother',
        '3' => 'Sister',
        '4' => 'Guardian',
        '6' => 'Other',
    ],

    'address_types'               => [
        '0' => 'Permanent',
        '1' => 'Present',
        '2' => 'Temporary',
    ],
    'address_types'               => [
        '0' => 'Permanent',
        '1' => 'Present',
        '2' => 'Temporary',
    ],
    'states'                      => [
        '0' => "Punjab",
        '1' => "Sindh",
        '2' => "Balochistan",
        '3' => "Khyber-Pakhtunkhwa",
    ],
    'followup_statuses'           => [
        'Follow Up Required' => "Follow Up Required",
        'Dropped' => "Dropped",
        'Sales Matured' => "Sales Matured",
        'Phone Not Picked' => 'Phone Not Picked',
        'Cell Off' => 'Cell Off',
        'Call Disconnected' => 'Call Disconnected',
        'Not in Use/ Invalid No.' => 'Not in Use/ Invalid No.',
        'Wrong No.' => 'Wrong No.',
    ],
    'call_statuses'               => [
        'Answered' => "Answered",
        'Will Call Back' => "Will Call Back",
        'Not Answered' => "Not Answered",
    ],
    'attachment_types'            => [
        '0'  => "EOBI",
        '2'  => "Factory Certificate",
        '3'  => 'Domicile',
        '5'  => 'Child Registration Certificate (B-form)',
        '1'  => "Student CNIC",
        '6'  => 'Father CNIC',
        '7'  => 'Mother CNIC',
        '8'  => 'Brother CNIC',
        '9'  => 'Sister CNIC',
        '10' => 'Guardian CNIC',
        '11' => 'Matric Character Certificate',
        '12' => 'Intermediate Character Certificate',
    ],
    'academic_types'              => [
        '0' => "Matric",
        '1' => "Intermediate",
        '2' => "Graduation",
        '3' => "Other",
    ],
    'discount_statuses'           => [
        '0'  => "Position Holder",
        '1'  => "80% or above",
        '2'  => "70%-79%",
        '3'  => "60%-69%",
        '4'  => "50%-59%",
        '5'  => "6 A s",
        '6'  => "2 A s",
        '7'  => "1 A s",
        '8'  => "Master Completed",
        '9'  => "ACCA Affilate",
        '10' => "Student Domiciled",
        '11' => "Resident Outside Lahore",
        '12' => "Hafiz-Quran",
        '13' => "Orphans",
        '14' => "Kinship",
        '15' => "Disabled Students",
        '16' => "Retired Army",
        '17' => "Govt Official(Below Grade 17)",
        '18' => "Lecturer/Educationist",
        '19' => "PWWB(worker Welfare)",
        '20' => "Other",
        '21' => "Financial Assistance",
        '22' => "Merit-based Scholarship",
        '23' => "OTC Discount",
        '24' => "Dual Degree",
    ],

    'payment_statuses'            => [
        '0' => "Un-Paid",
        '1' => "Paid",
        '2' => "Partially Paid",
    ],

    'voucher_statuses'            => [
        '0' => "Voucher Printed",
    ],

    'week_days'                   => [
        '0' => "Sunday",
        '1' => "Monday",
        '2' => "Tuesday",
        '3' => "Wednesday",
        '4' => "Thursday",
        '5' => "Friday",
        '6' => "Saturday",
    ],

    'time_slot_types'             => [
        '0' => "Shift",
        '1' => "Periodic",
    ],
    'fee_structure_types'         => [
        '0' => "Package",
        '1' => "Installment Generated",
    ],
    'punch_types'                 => [
        '0' => "Check-In",
        '1' => "Check-out",
    ],
    'attendance_types'            => [
        '0' => "student",
        '1' => "employee",
    ],
    'attendance_statuses'         => [
        '0' => "Absent",
        '1' => "Present",
        '2' => "Leave",
        '3' => "Day-Off",
        '4' => "Late",
        '5' => "On-Time",
        '6' => "Early",
    ],
    'genders'                     => [
        'Male'      => "Male",
        'Female'    => "Female",
        'Other'     => "Prefer Not to say",
        // '4' => 'Both',
    ],
    'religions'                   => [
        '0'  => "Islam",
        '1'  => "Christianity",
        '2'  => "Hinduism",
        '3'  => "Buddhism",
        '4'  => "Sikhism",
        '5'  => "Judaism",
        '6'  => "Chinese folk religion",
        '7'  => "Spiritism",
        '8'  => "Agnostic atheism",
        '9'  => "Traditional African religions",
        '10' => "Other",

    ],
    'martial_status'              => [
        '0' => "Single",
        '1' => "Engaged",
        '3' => "Married",
    ],
    'blood_groups'                => [
        '0' => "A+",
        '1' => "O+",
        '2' => "B+",
        '3' => "AB+",
        '4' => "A-",
        '5' => "O-",
        '6' => "B-",
        '7' => "AB-",
    ],
    'admission_types'             => [
        '0' => "Regular",
        '1' => "Private",
        '2' => "PWWB",
        '3' => "Franchise",
    ],
    'academic_statuses'           => [
        '0' => "Passed",
        '1' => "Dropout",
        '2' => "Failed",
    ],
    'shifts'                      => [
        '0' => "Morning",
        '1' => "Evening",
        '2' => 'Weekend',
    ],
    'semesters_years'             => [
        '0' => "1",
        '1' => "2",
        '2' => "3",
        '3' => "4",
        '4' => "5",
        '5' => "6",
        '6' => "7",
        '7' => "8",
        '8' => "9",
        '9' => "10",
    ],
    'file_received_status'        => [
        '0' => 'No',
        '1' => 'Yes',
    ],

    'pwwb_semesters_years'        => [
        '0' => "Semester 1",
        '1' => "Semester 2",
        '2' => "Semester 3",
        '3' => "Semester 4",
        '4' => "Semester 5",
        '5' => "Semester 6",
        '6' => "Semester 7",
        '7' => "Semester 8",
    ],
    'pwwb_annual_years'           => [
        '0' => "Annual Part 1",
        '1' => "Annual Part 2",
    ],
    'affiliations'                => [
        '0' => "GCUF",
        '1' => "PU",
    ],
    'result_statuses'             => [
        '0' => 'Pass',
        '1' => 'Fail',
    ],
    'student_categories'          => [
        '0' => 'PWWB',
        '1' => 'PAID',
        '3' => 'FRANCHISE',
    ],
    'is_transport'                => [
        '0' => 'Yes',
        '1' => 'No',
        '2' => 'Undecided',
    ],
    'is_hostel'                   => [
        '0' => 'Yes',
        '1' => 'No',
    ],
    'system_configrations'        => [
        'subjects_limit' => '6',
    ],
    'drop_statuses'               => [
        '0' => 'Time of Registration',
        '1' => 'Time of Examination',
        '2' => 'Time of Roll-No-Slip',
    ],
    'hourly_rates'                => [
        '0' => [
            'name'            => 'Fresh Lecturer',
            'hour_rate_start' => '700',
            'hour_rate_end'   => '800',
        ],
        '1' => [
            'name'            => 'Senior Lecturer',
            'hour_rate_start' => '1000',
            'hour_rate_end'   => '1200',
        ],
        '2' => [
            'name'            => 'Senior University Faculty Member',
            'hour_rate_start' => '1200',
            'hour_rate_end'   => '1500',
        ],
        '3' => [
            'name'            => 'PhD/Corporate Faculty Members',
            'hour_rate_start' => '1500',
            'hour_rate_end'   => '2500',
        ],
    ],

    'action_to_perform_results'   => [
        '0' => 'Entry',
        '1' => 'Preview',
    ],

    'semester_statuses'           => [
        '0' => 'Freeze',
        '1' => 'Un-Freeze',
    ],
    'transport_routes'            => [
        '0'  => '1 (Kana Via Packages Mall to CFE)',
        '1'  => '2 (Bagrian Via Township, HamdardChowk, PecoRoad to CFE)',
        '2'  => '3 (Labour Colony DHA Via Bagrian, Township, HamdardChowk, PecoRoad to CFE)',
        '3'  => '4 (SundarEstate ViaPindArayan, Bagrian, Township, HamdardChowk, PecoRoad to CFE)',
        '4'  => '5 (Mozang Via FC College, WahdatRoad, Bhaikhywal Mor, Multan Chungi to CFE)',
        '5'  => '6 (Labour Colony Shahdra Via Motorway, Thokar to CFE)',
        '6'  => '7 Laliyan (Route No.4)',
        '7'  => '8 Kamahan + Nishtar (Route No.5,6)',
        '8'  => '9 Kacha Jail Road (Route No.7,8)',
        '9'  => '10 Sundar (Route No.9,10)',
        '10' => '11 Riawind (Route No.11,12)',
        '11' => '12 Bubtian (Route No.13,14)',
        '12' => '13 Miniala (Route No.15)',
        '13' => '14 Railway Station (Route No.16)',
        '14' => '15 Rana Town (Route No.17)',
        '15' => '16 Bhai Phero (Route No.18)',
        '16' => '17 Niazi Ada (Route No.19)',
    ],
    'information_sources'         => [
        'Streamers'  => 'Streamers',
        'Hoarding'  => 'Hoarding',
        'Banners'  => 'Banners',
        'Flyers'  => 'Flyers',
        'News Paper'  => 'News Paper',
        'Tv Ad'  => 'Tv Ad',
        'Cable'  => 'Cable',
        'Friend/ Relative'  => 'Friend/ Relative',
        'WhatsApp'  => 'WhatsApp',
        'SMS' => 'SMS',
        'Facebook' => 'Facebook',
        'Instagram' => 'Instagram',
        'LinkedIn' => 'LinkedIn',
        'Youtube' => 'Youtube',
        'Google Ads' => 'Google Ads',
        'Referred By' => 'Referred By',
        'Other' => 'Other',
    ],
    'previous_degrees'            => [
        '0'  => 'Matric (Science Group)',
        '1'  => 'Matric (Arts Group)',
        '2'  => 'Fsc. Pre Medical',
        '3'  => 'Fsc. Pre Engg',
        '4'  => 'ICS (Phy)',
        '5'  => 'ICS (Stat)',
        '6'  => 'I.Com',
        '7'  => 'F.A',
        '8'  => 'A-Level',
        '9'  => 'O-Level',
        '10' => 'Bachelor',
        '11' => 'Master',
        '12' => 'Other',
    ],
    'follow_up_interested_levels' => [
        '0' => 'A',
        '2' => 'B',
        '4' => 'C',
    ],
    'degree_levels'               => [
        '0' => 'Intermediate',
        '1' => 'Graduation',
        '2' => 'Masters',
        '3' => 'M.Phil',
        '4' => 'PHd',
    ],
    'faculty_types'               => [
        '0' => 'Permanent',
        '1' => 'Visitor',
    ],

    'constant_fines'              => [
        'attendance_fine' => 200,
    ],
    'academic_terms'              => [
        '0' => 'Annual',
        '1' => 'Semester',
    ],
    'followup_types'              => [
        '0' => 'Enquiry Followup',
        '1' => 'Prospect Followup',
    ],
    'social_media_types'          => [
        '0' => 'Facebook',
        '1' => 'Website',
        '2' => 'Youtube',
        '3' => 'Others',
        '4' => 'Google Form',
        '5' => 'Instagram',
    ],

    'work_types'                  => [
        0 => 'Permanent/ Regular',
        1 => 'Through Contractor',
    ],

    'form_bypass'                 => [
        0 => "Mendatory Fields Not Filled",
        1 => "Mendatory Fields Filled",
    ],

    'registration_platforms'      => [
        0 => 'CFE Platform',
        1 => 'Private',
        2 => 'Franchise',
    ],

    'cfe_platforms'               => [
        0 => 'Regular',
        1 => '3rd Party Franchise By CFE',
    ],

    'registration_statuses'       => [
        0 => 'Not Registered',
        1 => 'Registered',
    ],

    'registration_card_received'  => [
        0 => 'No',
        1 => 'Yes',
    ],

    'general_yes_no'              => [
        'yes' => 'Yes',
        'no'  => 'No',
    ],
    'sessions'                    => [
        '2019-2021' => '2019-2021',
        '2021-2023' => '2021-2023',
        '2023-2025' => '2023-2025',
    ],
    'districts'                   => [
        'RahimYarKhan' => 'RahimYarKhan',
        'Lahore'       => 'Lahore',
        'Attock'       => 'Attock',
        'Bahawalpur'   => 'Bahawalpur',
        'Other'        => 'Other',
    ],
    'priority_of_submission'      => [
        'high'   => 'High',
        'medium' => 'Medium',
        'low'    => 'Low',
    ],
    'potential_degree'            => [
        'xxxx'  => 'XXXX',
        'xxxxx' => 'XXXXX',
    ],
    'workers_current_status'      => [
        'active'   => 'Active',
        'disabled' => 'Disabled',
        'died'     => 'Died',
        'retired'  => 'Retired',
        'resigned' => 'Resigned',
        'jobless'  => 'Jobless',
    ],
    'workers_job_nature'          => [
        'permanent' => 'Permanent',
        'contract'  => 'Through Contract',
    ],
    'factory_status'              => [
        'active' => 'Active',
        'closed' => 'Closed',
    ],
    'worker_relationship'         => [
        'self'     => 'Self',
        'father'   => 'Father',
        'mother'   => 'Mother',
        // 'brother' => 'Brother',
        // 'sibling'   => 'Sibling',
        'sister'   => 'Sister',
        'guardian' => 'Guardian',
        'other'    => 'Other',
    ],
    'marital_status'              => [
        'married'   => 'Married',
        'unmarried' => 'Un Married',
    ],
    'educational_wing_cfe'        => [
        'cs'  => 'CS',
        'ims' => 'IMS',
        'af'  => 'AF',
        'vti' => 'VTI',
    ],
    'bise_course_applied_in'      => [
        'pm'        => 'P/M',
        'pe'        => 'P/E',
        'ics'       => 'ICS',
        'icom'      => 'I.Com',
        'fa'        => 'FA',
        'undecided' => 'Undecided',
    ],
    'bise_optional_subject'       => [
        'xxxx' => 'XXXX',
    ],
    'bise_course_enrolled_cfe'    => [
        'bsse'       => 'BSSE',
        'unenrolled' => 'Un Enrolled',
    ],
    'bise_affiliated_body'        => [
        'bise' => 'Bise',
    ],
    'bise_duration_of_course'     => [
        'xxxxx' => 'XXXXX',
    ],
    'shift'                       => [
        'morning' => 'Morning',
        'evening' => 'Evening',
        'weekend' => 'Weekend',
    ],
    'registration_status'         => [
        'registered'    => 'Registered',
        'notRegistered' => 'Not Registered',
    ],
    'ims_course_applied_in_cfe'   => [
        'bsse'      => 'BSSE',
        'undefined' => 'Undefined',
    ],
    'ims_course_enrolled_in_cfe'  => [
        'bsse'      => 'BSSE',
        'undefined' => 'Undefined',
    ],
    'ims_course_registered'       => [
        'bsse'      => 'BSSE',
        'undefined' => 'Undefined',
    ],
    'ims_affiliated_body'         => [
        'xxxxx' => 'XXXXX',
    ],
    'ims_duration_of_course'      => [
        'xxxxx' => 'XXXXX',
    ],
    'semester_category'           => [
        'fall'   => 'Fall',
        'spring' => 'Spring',
    ],
    'af_course_applied_in'        => [
        'ca'        => 'CA',
        'undecided' => 'Undecided',
    ],
    'af_course_enrolled_in'       => [
        'ca'        => 'CA',
        'undecided' => 'Undecided',
    ],
    'af_course_registered_in'     => [
        'ca'            => 'CA',
        'un_registered' => 'Un Registered',
    ],
    'af_affiliated_body'          => [
        'xxxxx' => 'XXXXX',
    ],
    'af_duration_of_course'       => [
        'xxxxx' => 'XXXXX',
    ],
    'vti_diploma_applied_in'      => [
        'dit'       => 'DIT',
        'undecided' => 'Un Decided',
    ],
    'vti_diploma_enrolled_in'     => [
        'dit'         => 'DIT',
        'un_enrolled' => 'Un Enrolled',
    ],
    'vti_diploma_registered_in'   => [
        'dit'           => 'DIT',
        'un_registered' => 'Un Registered',
    ],
    'vti_reason'                  => [
        'lessService' => 'Less Service',
        'result'      => 'Result',
        'supply'      => 'Supply',
        'rpl'         => 'RPL',
        'genuine'     => 'Genuine',
    ],
    'vti_affiliated_body'         => [
        'xxxxx' => 'XXXXX',
    ],
    'vti_duration_of_diploma'     => [
        'xxxxx' => 'XXXXX',
    ],
    'course'                      => [
        'allCourses' => 'All Courses',
    ],
    'affiliated_body'             => [
        'xxxxx' => 'XXXXX',
    ],
    'duration_of_course'          => [
        'xxxxx' => 'XXXXX',
    ],
    'previous_course'             => [
        'xxxxx' => 'XXXXX',
    ],
    'previous_affiliated_body'    => [
        'xxxxx' => 'XXXXX',
    ],
    'previous_duration_of_course' => [
        'xxxxx' => 'XXXXX',
    ],
    'status'                      => [
        'issued'     => 'Issued',
        'not_issued' => 'Not Issued',
    ],
    'claim_status'                => [
        'received'    => 'Received',
        'rejected'    => 'Rejected',
        'notReceived' => 'Not Received',
        'cancelled'   => 'Cancelled',
    ],
    'claim_fee_type'              => [
        'admissionfee'    => 'Admission Fee',
        'tutionfee'       => 'Tution Fee',
        'labfee'          => 'Lab Fee',
        'libraryfee'      => 'Library Fee',
        'transportfee'    => 'Transport Fee',
        'registrationfee' => 'Registration Fee',
        'hostelfee'       => 'Hostel Fee',
        'other'           => 'Other',
    ],
    'transport_yes_no_undecided'  => [
        'yes'       => 'Yes',
        'no'        => 'No',
        'undecided' => 'Undecided',
    ],
    'admission_set_submitted'     => [
        'yes' => 'Yes',
        'no'  => 'No',
    ],
    'file_submitted_to_pwwb'      => [
        'yes' => 'Yes',
        'no'  => 'No',
    ],
    'section_active'              => [
        '1' => 'True',
        '0' => 'False',
    ],
    'facilities'                  => [
        '0' => 'Projector',
        '1' => 'AC',
        '2' => 'Computer',
        '3' => 'Fans',
    ],
    'nature_plot_dropdown' => [
        'Residential' => 'Residential',
        'Commercial' => 'Commercial',
    ],
    'plot_type_dropdown' => [
        'Home' => 'Home',
        'Apartment' => 'Apartment',
        'Farmhouse' => 'Farmhouse',
        'Plots' => 'Plot',
        'Others' => 'Others',
        'Shop' => 'Shop',
        'Offices' => 'Offices',
        'Plots-com' => 'Plot',
        'Others-com' => 'Others',
    ],
    'plot_size_dropdown' => [
        'Kanal(s)'  => 'Kanal(s)',
        'Marla(s)'  => 'Marla(s)',
        'Sq.Ft'     => 'Sq.Ft',
        'Sq.Yards'  => 'Sq.Yards',
    ],
    'attendance_report_types'     => [
        '0' => 'Department Wise',
        '1' => 'User Wise',
    ],
    'wing_type'                   => [
        '1' => 'Group Wise',
        '2' => 'Credit Hours Wise',
    ],

    'return_files' => [
        '0' => 'Active',
        '1' => 'In-Active',
    ],

    'income_range' => [
        'PKR (0 - 100,000)'         => 'PKR (0 - 100,000)',
        'PKR (100,001 - 200,000)'   => 'PKR (100,001 - 200,000)',
        'PKR (200,001 - 300,000)'   => 'PKR (200,001 - 300,000)',
        'PKR (300,000+)'            => 'PKR (300,000+)',
    ],
];
