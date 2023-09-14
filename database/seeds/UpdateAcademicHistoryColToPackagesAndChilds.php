<?php

use Illuminate\Database\Seeder;
use App\Models\Student;

class UpdateAcademicHistoryColToPackagesAndChilds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$students = Student::with('studentAcademicHistories', 'feePackages', 'feePackages.feePackageInstallments', 'headFineStudents', 'feePackages.feePackageInstallments.feeFines', 'feePackages.feeFines', 'attendanceFines')->get();

    	foreach ($students as $key => $student) 
    	{
    		if(count($student->studentAcademicHistories) > 0)
    		{
    			foreach($student->feePackages as $fee_package)
    			{
    				$fee_package->academic_history_id = $student->studentAcademicHistories->last()->id;
    				$fee_package->update();
    				foreach($fee_package->feePackageInstallments->where('academic_history_id', null) as $fee_package_installment)
    				{
    					$fee_package_installment->academic_history_id = $student->studentAcademicHistories->last()->id;
    					$fee_package_installment->update();
    					if($fee_package_installment->feeFines->count() > 0)
    					{
                            // dd('hey crazy');
    						foreach($fee_package_installment->feeFines->where('installment_id' ,'!=', null)->where('academic_history_id', null) as $fee_fine)
    						{
    							$fee_fine->academic_history_id = $student->studentAcademicHistories->last()->id;
    							$fee_fine->update();
    						}
    					}
    				}
    				if($fee_package->feeFines->count() > 0)
    				{
    					foreach($fee_package->feeFines->where('package_id', '!=', null) as $package_fee_fine)
    					{
    						$package_fee_fine->academic_history_id = $student->studentAcademicHistories->last()->id;
    						$package_fee_fine->update();
    					}
    				}
    			}
    			if($student->attendanceFines->where('academic_history_id', null)->count() > 0)
    			{
    				foreach($student->attendanceFines->where('academic_history_id', null) as $attendancefine)
    				{
    					$attendancefine->academic_history_id = $student->studentAcademicHistories->last()->id;
    					$attendancefine->update();
    				}
    			}

    			if($student->headFineStudents->where('academic_history_id', null)->count() > 0)
    			{
    				foreach($student->headFineStudents->where('academic_history_id', null) as $headfine)
    				{
    					$headfine->academic_history_id = $student->studentAcademicHistories->last()->id;
    					$headfine->update();
    				}
    			}

    		}
    	}
    }
}
