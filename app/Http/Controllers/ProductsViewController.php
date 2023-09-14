<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\OrganizationCampus;
use App\Models\Wing;
use App\Models\Course;
use App\Models\AffiliatedBody;
use App\Models\CourseAffiliatedBody;

class ProductsViewController extends Controller
{
    public function index()
    {
        $organizations = Organization::all()->toArray();
        if(!empty($organizations)){

            for($z=0; $z<count($organizations); $z++){

                $offices = OrganizationCampus::whereRaw('organization_id = ?', [$organizations[$z]['id']])->get()->toArray();
                if(!empty($offices)){
                    for($i=0;$i<count($offices); $i++){
                        $officeID = $offices[$i]['id'];
                        $developers = AffiliatedBody::whereRaw('organization_id = ? and organization_campus_id = ?', [$organizations[$z]['id'] , $officeID])->get()->toArray();

                        if(!empty($developers)){
                            for($j=0;$j<count($developers);$j++){
                                
                                $projects = Wing::whereRaw(' wing_type_id = ? ', [$developers[$j]['id'] ])->get()->toArray();
                                if(!empty($projects)){
                                    for($k=0;$k<count($projects);$k++){

                                        $products = Course::whereRaw('project = ?', [ $projects[$k]['id'] ])->get()->toArray();
                                        $projects[$k]['products'] = $products;
                                    }
                                }
                                $developers[$j]['projects'] = $projects;
                            }
                        }
                        $offices[$i]['developers'] = $developers;
                    }
                }

                $organizations[$z]['offices'] = $offices;
            }

        }
        // echo "<pre />";
        // print_r($organizations);
        // exit;
        return view('viewdevproducts.index')
            ->with('org', $organizations);
    }
}
