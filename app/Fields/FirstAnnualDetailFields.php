<?php


namespace App\Fields;


class FirstAnnualDetailFields
{
    const TABLE_NAME = 'first_annual_details';
    const ID = 'id';
    const INDEX_TABLE_ID = 'index_table_id';

    const FEE_DEPOSIT_STATUS = 'fee_deposit_status';
    const EXAM_FEE_DATE = 'exam_fee_date';
    const AMOUNT = 'amount';
    const ROLL_NO = 'roll_no';
    const READMISSION = 'readmission';
    const SAME_COURSE = 'same_course';
    const CHANGED_COURSE = 'changed_course';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Claims Fields Start

    const CLAIM_DUE_PAGE_15 = 'claim_due_page_15';
    const CLAIM_STATUS_PAGE_15 = 'claim_status_page_15';
    const REASON_PAGE_15 = 'reason_page_15';
    const OUTSTANDING_CFE_FEE_PAGE_15 = 'outstanding_cfe_fee_page_15';
    const RECOVERED_AMOUNT_PAGE_15 = 'recovered_amount_page_15';
    const CLAIM_HEAD_DEFAULT_1_PAGE_15 = 'claim_head_default_1_page_15';
    const CLAIM_HEAD_DEFAULT_2_PAGE_15 = 'claim_head_default_2_page_15';
    const CLAIM_HEAD_DEFAULT_3_PAGE_15 = 'claim_head_default_3_page_15';
    const CLAIM_HEAD_DEFAULT_4_PAGE_15 = 'claim_head_default_4_page_15';
    const CLAIM_HEAD_DEFAULT_5_PAGE_15 = 'claim_head_default_5_page_15';
    const CLAIM_HEAD_DEFAULT_6_PAGE_15 = 'claim_head_default_6_page_15';
    const CLAIM_HEAD_DEFAULT_7_PAGE_15 = 'claim_head_default_7_page_15';
    const CLAIM_HEAD_DEFAULT_8_PAGE_15 = 'claim_head_default_8_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_15 = 'claim_amount_due_default_1_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_15 = 'claim_amount_due_default_2_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_15 = 'claim_amount_due_default_3_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_15 = 'claim_amount_due_default_4_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_15 = 'claim_amount_due_default_5_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_15 = 'claim_amount_due_default_6_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_15 = 'claim_amount_due_default_7_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_15 = 'claim_amount_due_default_8_page_15';
    const CLAIM_AMOUNT_DUE_DEFAULT_PAGE_15 = 'claim_amount_due_default_page_15';
    const TYPE_OF_CLAIM_1_PAGE_15 = 'type_of_claim_1_page_15';
    const TYPE_OF_CLAIM_2_PAGE_15 = 'type_of_claim_2_page_15';
    const TYPE_OF_CLAIM_3_PAGE_15 = 'type_of_claim_3_page_15';
    const TYPE_OF_CLAIM_4_PAGE_15 = 'type_of_claim_4_page_15';
    const TYPE_OF_CLAIM_5_PAGE_15 = 'type_of_claim_5_page_15';
    const TYPE_OF_CLAIM_6_PAGE_15 = 'type_of_claim_6_page_15';
    const TYPE_OF_CLAIM_7_PAGE_15 = 'type_of_claim_7_page_15';
    const TYPE_OF_CLAIM_8_PAGE_15 = 'type_of_claim_8_page_15';
    const AMOUNT_DUE_1_PAGE_15 = 'amount_due_1_page_15';
    const AMOUNT_RECEIVED_1_PAGE_15 = 'amount_received_1_page_15';
    const BALANCE_DUE_1_PAGE_15 = 'balance_due_1_page_15';
    const AMOUNT_DUE_2_PAGE_15 = 'amount_due_2_page_15';
    const AMOUNT_RECEIVED_2_PAGE_15 = 'amount_received_2_page_15';
    const BALANCE_DUE_2_PAGE_15 = 'balance_due_2_page_15';
    const AMOUNT_DUE_3_PAGE_15 = 'amount_due_3_page_15';
    const AMOUNT_RECEIVED_3_PAGE_15 = 'amount_received_3_page_15';
    const BALANCE_DUE_3_PAGE_15 = 'balance_due_3_page_15';
    const AMOUNT_DUE_4_PAGE_15 = 'amount_due_4_page_15';
    const AMOUNT_RECEIVED_4_PAGE_15 = 'amount_received_4_page_15';
    const BALANCE_DUE_4_PAGE_15 = 'balance_due_4_page_15';
    const AMOUNT_DUE_5_PAGE_15 = 'amount_due_5_page_15';
    const AMOUNT_RECEIVED_5_PAGE_15 = 'amount_received_5_page_15';
    const BALANCE_DUE_5_PAGE_15 = 'balance_due_5_page_15';
    const AMOUNT_DUE_6_PAGE_15 = 'amount_due_6_page_15';
    const AMOUNT_RECEIVED_6_PAGE_15 = 'amount_received_6_page_15';
    const BALANCE_DUE_6_PAGE_15 = 'balance_due_6_page_15';
    const AMOUNT_DUE_7_PAGE_15 = 'amount_due_7_page_15';
    const AMOUNT_RECEIVED_7_PAGE_15 = 'amount_received_7_page_15';
    const BALANCE_DUE_7_PAGE_15 = 'balance_due_7_page_15';
    const AMOUNT_DUE_8_PAGE_15 = 'amount_due_8_page_15';
    const AMOUNT_RECEIVED_8_PAGE_15 = 'amount_received_8_page_15';
    const BALANCE_DUE_8_PAGE_15 = 'balance_due_8_page_15';
    const AMOUNT_DUE_PAGE_15 = 'amount_due_page_15';
    const AMOUNT_RECEIVED_PAGE_15 = 'amount_received_page_15';
    const BALANCE_DUE_PAGE_15 = 'balance_due_page_15';
    const AMOUNT_RECEIVED_LAST_PAGE_15 = 'amount_received_last_page_15';
    const TOTAL_AMOUNT_CHEQUE_PAGE_15 = 'total_amount_cheque_page_15';
    const CHEQUE_DATE_PAGE_15 = 'cheque_date_page_15';
    const CHEQUE_NO_PAGE_15 = 'cheque_no_page_15';
    const BANK_NAME_PAGE_15 = 'bank_name_page_15';
    const REASON_REMARKS_PAGE_15 = 'reason_remarks_page_15';

    // Claims Fields End
}