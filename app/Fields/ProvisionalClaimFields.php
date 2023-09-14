<?php


namespace App\Fields;


class ProvisionalClaimFields
{
    const TABLE_NAME = 'provisional_claims';
    const ID = 'id';
    const INDEX_TABLE_ID = 'index_table_id';
    const SERIAL_NO = 'serial_no';
    const CLAIM_DUE = 'claim_due';
    const TYPE_OF_CLAIM = 'type_of_claim';
    const TYPE_OF_CLAIM_OTHER = 'type_of_claim_other';
    const CLAIM_STATUS = 'claim_status';
    const CLAIM_RECEIVED = 'claim_received';
    const CLAIM_DATE = 'claim_date';
    const REASON = 'reason';
    const CFE_FEE = 'cfe_fee';
    const RECOVERY_FROM_STUDENT = 'recovery_from_student';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    // Claims Fields Start

    const CLAIM_DUE_PAGE_14 = 'claim_due_page_14';
    const CLAIM_STATUS_PAGE_14 = 'claim_status_page_14';
    const REASON_PAGE_14 = 'reason_page_14';
    const OUTSTANDING_CFE_FEE_PAGE_14 = 'outstanding_cfe_fee_page_14';
    const RECOVERED_AMOUNT_PAGE_14 = 'recovered_amount_page_14';
    const CLAIM_HEAD_DEFAULT_1_PAGE_14 = 'claim_head_default_1_page_14';
    const CLAIM_HEAD_DEFAULT_2_PAGE_14 = 'claim_head_default_2_page_14';
    const CLAIM_HEAD_DEFAULT_3_PAGE_14 = 'claim_head_default_3_page_14';
    const CLAIM_HEAD_DEFAULT_4_PAGE_14 = 'claim_head_default_4_page_14';
    const CLAIM_HEAD_DEFAULT_5_PAGE_14 = 'claim_head_default_5_page_14';
    const CLAIM_HEAD_DEFAULT_6_PAGE_14 = 'claim_head_default_6_page_14';
    const CLAIM_HEAD_DEFAULT_7_PAGE_14 = 'claim_head_default_7_page_14';
    const CLAIM_HEAD_DEFAULT_8_PAGE_14 = 'claim_head_default_8_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_14 = 'claim_amount_due_default_1_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_14 = 'claim_amount_due_default_2_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_14 = 'claim_amount_due_default_3_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_14 = 'claim_amount_due_default_4_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_14 = 'claim_amount_due_default_5_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_14 = 'claim_amount_due_default_6_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_14 = 'claim_amount_due_default_7_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_14 = 'claim_amount_due_default_8_page_14';
    const CLAIM_AMOUNT_DUE_DEFAULT_PAGE_14 = 'claim_amount_due_default_page_14';
    const TYPE_OF_CLAIM_1_PAGE_14 = 'type_of_claim_1_page_14';
    const TYPE_OF_CLAIM_2_PAGE_14 = 'type_of_claim_2_page_14';
    const TYPE_OF_CLAIM_3_PAGE_14 = 'type_of_claim_3_page_14';
    const TYPE_OF_CLAIM_4_PAGE_14 = 'type_of_claim_4_page_14';
    const TYPE_OF_CLAIM_5_PAGE_14 = 'type_of_claim_5_page_14';
    const TYPE_OF_CLAIM_6_PAGE_14 = 'type_of_claim_6_page_14';
    const TYPE_OF_CLAIM_7_PAGE_14 = 'type_of_claim_7_page_14';
    const TYPE_OF_CLAIM_8_PAGE_14 = 'type_of_claim_8_page_14';
    const AMOUNT_DUE_1_PAGE_14 = 'amount_due_1_page_14';
    const AMOUNT_RECEIVED_1_PAGE_14 = 'amount_received_1_page_14';
    const BALANCE_DUE_1_PAGE_14 = 'balance_due_1_page_14';
    const AMOUNT_DUE_2_PAGE_14 = 'amount_due_2_page_14';
    const AMOUNT_RECEIVED_2_PAGE_14 = 'amount_received_2_page_14';
    const BALANCE_DUE_2_PAGE_14 = 'balance_due_2_page_14';
    const AMOUNT_DUE_3_PAGE_14 = 'amount_due_3_page_14';
    const AMOUNT_RECEIVED_3_PAGE_14 = 'amount_received_3_page_14';
    const BALANCE_DUE_3_PAGE_14 = 'balance_due_3_page_14';
    const AMOUNT_DUE_4_PAGE_14 = 'amount_due_4_page_14';
    const AMOUNT_RECEIVED_4_PAGE_14 = 'amount_received_4_page_14';
    const BALANCE_DUE_4_PAGE_14 = 'balance_due_4_page_14';
    const AMOUNT_DUE_5_PAGE_14 = 'amount_due_5_page_14';
    const AMOUNT_RECEIVED_5_PAGE_14 = 'amount_received_5_page_14';
    const BALANCE_DUE_5_PAGE_14 = 'balance_due_5_page_14';
    const AMOUNT_DUE_6_PAGE_14 = 'amount_due_6_page_14';
    const AMOUNT_RECEIVED_6_PAGE_14 = 'amount_received_6_page_14';
    const BALANCE_DUE_6_PAGE_14 = 'balance_due_6_page_14';
    const AMOUNT_DUE_7_PAGE_14 = 'amount_due_7_page_14';
    const AMOUNT_RECEIVED_7_PAGE_14 = 'amount_received_7_page_14';
    const BALANCE_DUE_7_PAGE_14 = 'balance_due_7_page_14';
    const AMOUNT_DUE_8_PAGE_14 = 'amount_due_8_page_14';
    const AMOUNT_RECEIVED_8_PAGE_14 = 'amount_received_8_page_14';
    const BALANCE_DUE_8_PAGE_14 = 'balance_due_8_page_14';
    const AMOUNT_DUE_PAGE_14 = 'amount_due_page_14';
    const AMOUNT_RECEIVED_PAGE_14 = 'amount_received_page_14';
    const BALANCE_DUE_PAGE_14 = 'balance_due_page_14';
    const AMOUNT_RECEIVED_LAST_PAGE_14 = 'amount_received_last_page_14';
    const TOTAL_AMOUNT_CHEQUE_PAGE_14 = 'total_amount_cheque_page_14';
    const CHEQUE_DATE_PAGE_14 = 'cheque_date_page_14';
    const CHEQUE_NO_PAGE_14 = 'cheque_no_page_14';
    const BANK_NAME_PAGE_14 = 'bank_name_page_14';
    const REASON_REMARKS_PAGE_14 = 'reason_remarks_page_14';

    // Claims Fields End
}