<?php


namespace App\Fields;


class SecondAnnualPartDetailFields
{
    const TABLE_NAME = 'second_annual_part_details';
    const ID = 'id';
    const INDEX_TABLE_ID = 'index_table_id';
    const RECEIPT_STATUS = 'receipt_status';
    const SECOND_PART_DATE = 'second_part_date';
    const PWWB_STATUS = 'pwwb_status';
    const PWWB_DATE = 'pwwb_date';
    const DIARY_PWWB = 'diary_pwwb';
    const AMOUNT_CLAIM_DUE = 'amount_claim_due';
    const CLAIM_STATUS = 'claim_status';
    const AMOUNT_RECEIVED = 'amount_received';
    const CLAIM_DATE = 'claim_date';
    const EXAM_STATUS = 'exam_status';
    const EXAM_DATE = 'exam_date';
    const EXAM_AMOUNT = 'exam_amount';
    const ROLL_NO = 'roll_no';
    const READMISSIONPARTTWO = 'readmissionparttwo';
    const SAME_COURSE = 'same_course';
    const CHANGED_COURSE = 'changed_course';


    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

        // Claims Fields Start

    const CLAIM_DUE_PAGE_16 = 'claim_due_page_16';
    const CLAIM_STATUS_PAGE_16 = 'claim_status_page_16';
    const REASON_PAGE_16 = 'reason_page_16';
    const OUTSTANDING_CFE_FEE_PAGE_16 = 'outstanding_cfe_fee_page_16';
    const RECOVERED_AMOUNT_PAGE_16 = 'recovered_amount_page_16';
    const CLAIM_HEAD_DEFAULT_1_PAGE_16 = 'claim_head_default_1_page_16';
    const CLAIM_HEAD_DEFAULT_2_PAGE_16 = 'claim_head_default_2_page_16';
    const CLAIM_HEAD_DEFAULT_3_PAGE_16 = 'claim_head_default_3_page_16';
    const CLAIM_HEAD_DEFAULT_4_PAGE_16 = 'claim_head_default_4_page_16';
    const CLAIM_HEAD_DEFAULT_5_PAGE_16 = 'claim_head_default_5_page_16';
    const CLAIM_HEAD_DEFAULT_6_PAGE_16 = 'claim_head_default_6_page_16';
    const CLAIM_HEAD_DEFAULT_7_PAGE_16 = 'claim_head_default_7_page_16';
    const CLAIM_HEAD_DEFAULT_8_PAGE_16 = 'claim_head_default_8_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_16 = 'claim_amount_due_default_1_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_16 = 'claim_amount_due_default_2_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_16 = 'claim_amount_due_default_3_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_16 = 'claim_amount_due_default_4_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_16 = 'claim_amount_due_default_5_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_16 = 'claim_amount_due_default_6_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_16 = 'claim_amount_due_default_7_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_16 = 'claim_amount_due_default_8_page_16';
    const CLAIM_AMOUNT_DUE_DEFAULT_PAGE_16 = 'claim_amount_due_default_page_16';
    const TYPE_OF_CLAIM_1_PAGE_16 = 'type_of_claim_1_page_16';
    const TYPE_OF_CLAIM_2_PAGE_16 = 'type_of_claim_2_page_16';
    const TYPE_OF_CLAIM_3_PAGE_16 = 'type_of_claim_3_page_16';
    const TYPE_OF_CLAIM_4_PAGE_16 = 'type_of_claim_4_page_16';
    const TYPE_OF_CLAIM_5_PAGE_16 = 'type_of_claim_5_page_16';
    const TYPE_OF_CLAIM_6_PAGE_16 = 'type_of_claim_6_page_16';
    const TYPE_OF_CLAIM_7_PAGE_16 = 'type_of_claim_7_page_16';
    const TYPE_OF_CLAIM_8_PAGE_16 = 'type_of_claim_8_page_16';
    const AMOUNT_DUE_1_PAGE_16 = 'amount_due_1_page_16';
    const AMOUNT_RECEIVED_1_PAGE_16 = 'amount_received_1_page_16';
    const BALANCE_DUE_1_PAGE_16 = 'balance_due_1_page_16';
    const AMOUNT_DUE_2_PAGE_16 = 'amount_due_2_page_16';
    const AMOUNT_RECEIVED_2_PAGE_16 = 'amount_received_2_page_16';
    const BALANCE_DUE_2_PAGE_16 = 'balance_due_2_page_16';
    const AMOUNT_DUE_3_PAGE_16 = 'amount_due_3_page_16';
    const AMOUNT_RECEIVED_3_PAGE_16 = 'amount_received_3_page_16';
    const BALANCE_DUE_3_PAGE_16 = 'balance_due_3_page_16';
    const AMOUNT_DUE_4_PAGE_16 = 'amount_due_4_page_16';
    const AMOUNT_RECEIVED_4_PAGE_16 = 'amount_received_4_page_16';
    const BALANCE_DUE_4_PAGE_16 = 'balance_due_4_page_16';
    const AMOUNT_DUE_5_PAGE_16 = 'amount_due_5_page_16';
    const AMOUNT_RECEIVED_5_PAGE_16 = 'amount_received_5_page_16';
    const BALANCE_DUE_5_PAGE_16 = 'balance_due_5_page_16';
    const AMOUNT_DUE_6_PAGE_16 = 'amount_due_6_page_16';
    const AMOUNT_RECEIVED_6_PAGE_16 = 'amount_received_6_page_16';
    const BALANCE_DUE_6_PAGE_16 = 'balance_due_6_page_16';
    const AMOUNT_DUE_7_PAGE_16 = 'amount_due_7_page_16';
    const AMOUNT_RECEIVED_7_PAGE_16 = 'amount_received_7_page_16';
    const BALANCE_DUE_7_PAGE_16 = 'balance_due_7_page_16';
    const AMOUNT_DUE_8_PAGE_16 = 'amount_due_8_page_16';
    const AMOUNT_RECEIVED_8_PAGE_16 = 'amount_received_8_page_16';
    const BALANCE_DUE_8_PAGE_16 = 'balance_due_8_page_16';
    const AMOUNT_DUE_PAGE_16 = 'amount_due_page_16';
    const AMOUNT_RECEIVED_PAGE_16 = 'amount_received_page_16';
    const BALANCE_DUE_PAGE_16 = 'balance_due_page_16';
    const AMOUNT_RECEIVED_LAST_PAGE_16 = 'amount_received_last_page_16';
    const TOTAL_AMOUNT_CHEQUE_PAGE_16 = 'total_amount_cheque_page_16';
    const CHEQUE_DATE_PAGE_16 = 'cheque_date_page_16';
    const CHEQUE_NO_PAGE_16 = 'cheque_no_page_16';
    const BANK_NAME_PAGE_16 = 'bank_name_page_16';
    const REASON_REMARKS_PAGE_16 = 'reason_remarks_page_16';

    // Claims Fields End
}
