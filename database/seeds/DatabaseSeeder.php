<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(CountrySeeder::class);
        // $this->call(CitySeeder::class);
        // $this->call(PermissionsSeeder::class);
        // $this->call(RolesSeeder::class);
        // $this->call(AdminSeeder::class);
        // $this->call(MigrateStdRollNoToSystemRollNo::class);
        // $this->call(StudentSectionUpdateSeeder::class);
        // $this->call(RectifyStudentAcademicHistory::class);
        // $this->call(UpdateAcademicHistoryColToDateSheetStudent::class);
        // $this->call(UpdateAcademicHistoryColToExamFines::class);
        // $this->call(UpdateAcademicHistoryColToPackagesAndChilds::class);
        // $this->call(UpdateColAcademicHistoryToAttendanceAndChild::class);
        // $this->call(UpdateAffiliatedBodyAndDegreeTypeToEnquiry::class);
        // $this->call(UpdateAffiliatedBodyDegreeLevelAndDegreeTypeColToAdmission::class);
        // $this->call(UpdateAffiliatedBodyToStudent::class);
        // $this->call(UpdateSessionStartDateEndDateDegreeTypeAndAffiliatedBodyToSessionCourse::class);
        // $this->call(UpdateTransportCheckInAdmissionAndStudentTable::class);
        // $this->call(UpdateStudentRollNumbers::class);
        // $this->call(UpdateEmployeeAttendanceSeeder::class);

        // Seeders need to update the old database to run with new changes in code (Organization_structure and Session and Users and other)

        $this->call(UpdateEnquiryTable::class);
        $this->call(UpdateEnquiryFollowupTable::class);
        $this->call(UpdateCityTable::class);
        $this->call(UpdateAdmissionTableSeeder::class);
        $this->call(OpenEnquiryGuestUserSeeder::class);
        $this->call(AddNewUserSeeder::class);

        // ---------------------------------------------------------------------------------

    }
}
