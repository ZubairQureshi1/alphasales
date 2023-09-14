<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnOrganizationCampusAndWingIdToDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = ['academic_records', 'admissions', 'admission_by_enquiry_forms', 'affiliated_bodies', 'announcements', 'assignments', 'assignment_courses', 'assignment_results', 'assignment_sections', 'assignment_subjects', 'attachments', 'attendances', 'attendance_fines', 'attendance_fine_vouchers', 'attendance_logs', 'audits', 'cities', 'countries', 'date_sheets', 'date_sheet_books', 'date_sheet_courses', 'date_sheet_rooms', 'date_sheet_sections', 'date_sheet_sitting_plans', 'date_sheet_students', 'departments', 'department_users', 'designations', 'employee_attachments', 'employments', 'enquiries', 'enquiry_addresses', 'enquiry_contact_infos', 'enquiry_followups', 'enquiry_workers', 'exam_fines', 'exam_fine_vouchers', 'exam_types', 'fee_fines', 'fee_fine_vouchers', 'fee_packages', 'fee_package_installments', 'fee_vouchers', 'fines', 'head_fines', 'head_fine_students', 'job_titles', 'lecture_attendances', 'model_has_permissions', 'model_has_roles', 'notice_boards', 'password_resets', 'permissions', 'references', 'reference_enquiries', 'roles', 'role_has_permissions', 'rooms', 'sections', 'section_courses', 'section_students', 'semesters', 'shifts', 'shift_dates', 'shift_swaps', 'shift_users', 'shift_working_days', 'students', 'student_academic_histories', 'student_attachments', 'student_books', 'student_installment_plans', 'student_workers', 'system_roll_numbers', 'teacher_subjects', 'time_periods', 'time_period_subject_week_days', 'time_slots', 'users', 'user_designations', 'wings'];

        foreach ($tables as $key => $name) {
            Schema::table($name, function (Blueprint $table) {
                $table->unsignedBigInteger('organization_id')->nullable();
                $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');

                $table->unsignedBigInteger('organization_campus_id')->nullable();
                $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('set null');

                $table->unsignedBigInteger('academic_wing_id')->nullable();
                $table->foreign('academic_wing_id')->references('id')->on('wings')->onDelete('set null');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = ['academic_records', 'admissions', 'admission_by_enquiry_forms', 'affiliated_bodies', 'announcements', 'assignments', 'assignment_courses', 'assignment_results', 'assignment_sections', 'assignment_subjects', 'attachments', 'attendances', 'attendance_fines', 'attendance_fine_vouchers', 'attendance_logs', 'audits', 'cities', 'countries', 'date_sheets', 'date_sheet_books', 'date_sheet_courses', 'date_sheet_rooms', 'date_sheet_sections', 'date_sheet_sitting_plans', 'date_sheet_students', 'departments', 'department_users', 'designations', 'employee_attachments', 'employments', 'enquiries', 'enquiry_addresses', 'enquiry_contact_infos', 'enquiry_followups', 'enquiry_workers', 'exam_fines', 'exam_fine_vouchers', 'exam_types', 'fee_fines', 'fee_fine_vouchers', 'fee_packages', 'fee_package_installments', 'fee_vouchers', 'fines', 'head_fines', 'head_fine_students', 'job_titles', 'lecture_attendances', 'model_has_permissions', 'model_has_roles', 'notice_boards', 'password_resets', 'permissions', 'references', 'reference_enquiries', 'roles', 'role_has_permissions', 'rooms', 'sections', 'section_courses', 'section_students', 'semesters', 'shifts', 'shift_dates', 'shift_swaps', 'shift_users', 'shift_working_days', 'students', 'student_academic_histories', 'student_attachments', 'student_books', 'student_installment_plans', 'student_workers', 'system_roll_numbers', 'teacher_subjects', 'time_periods', 'time_period_subject_week_days', 'time_slots', 'users', 'user_designations', 'wings'];
        foreach ($tables as $key => $name) {
            Schema::table($name, function (Blueprint $table) {
                // $table->dropForeign(['organization_id']);
                $table->dropForeign(['organization_campus_id']);
                $table->dropForeign(['academic_wing_id']);
                // $table->dropColumn(['organization_id']);
                $table->dropColumn(['organization_campus_id']);
                $table->dropColumn(['academic_wing_id']);
            });
        }
    }
}
