<?php

namespace App\Http\Controllers;

use App\Models\AffiliatedBody;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\EnquiryFollowup;
use App\Models\OrganizationCampus;
use App\Models\Reference;
use App\Models\Session;
use App\Repositories\EnquiryRepository;
use App\User;
use ConstantStrings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as SystemSession;

class OpenEnquiryController extends Controller
{
    private $enquiryRepository;

    public function __construct(EnquiryRepository $enquiryRepo)
    {
        $this->enquiryRepository = $enquiryRepo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enquiries = Enquiry::where('enquiry_type', 'outbound')->orWhere('enquiry_type', 'inbound')->get();
        return view('enquiries.openEnquiries.index', ['enquiries' => $enquiries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guest = User::where('email', 'guest@cfe.com')->first();
        if(Auth::loginUsingId($guest->id)) {
            return view('enquiries.openEnquiries.create', [
                'users'                 => User::with('roles')->get(), 
                'cities'                => City::orderBy('name')->pluck('name', 'id'), 
                'courses'               => Course::pluck('name', 'id'),
                'statuses'              => ConstantStrings::statuses(), 
                'sessions'              => Session::pluck('session_name', 'id'), 
                'countries'             => Country::all(), 
                'references'            => Reference::all(), 
                'affiliated_bodies'     => AffiliatedBody::pluck('name', 'id'),
                'organization_campuses' => OrganizationCampus::pluck('name', 'id')
            ]);
        } else {
            abort(500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enquiry = $this->enquiryRepository->findWithoutFail($id);

        if (empty($enquiry)) {
            return redirect()->route('enquiries.openEnquiries.index')->with('danger', 'Enquiry Not Found!');
        }

        return view('enquiries.openEnquiries.show', [ 
            'enquiry'    => $enquiry,
            'countries'  => Country::all(),
            'references' => Reference::all(),
            'cities'     => City::pluck('name', 'id'),
            'courses'    => Course::pluck('name', 'id'),
            'users'      => User::with('roles')->get(),
            'statuses'   => ConstantStrings::statuses()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        $countries  = Country::all();
        $references = Reference::all();
        $cities     = City::pluck('name', 'id');
        $courses    = Course::pluck('name', 'id');
        $users      = User::with('roles')->get();
        $statuses   = ConstantStrings::statuses();

        if (empty($enquiry)) {
            return redirect()->back()->with('danger', 'Enquiry Not Found!');
        }

        return view('enquiries.openEnquiries.edit')->with([
            'enquiry'    => $enquiry,
            'references' => $references,
            'users'      => $users,
            'statuses'   => $statuses,
            'cities'     => $cities,
            'countries'  => $countries,
            'courses'    => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // if enquiry is empty
        if (empty($enquiry)) {
            return response()->json(['success' => false, 'message' => 'no enquiry found!'], 404);
        }

        try {
            \DB::beginTransaction();
            
            // get input
            $input = $request->all();

            $enquiry['user_name'] = User::find($input['user_id'])->display_name;

            // update worker details
            if (isset($input['worker_details'])) {
                $enquiry_worker_details = $input['worker_details'];
                //delete previous 
                $enquiry->enquiryWorkers()->delete();
                // loop to save
                foreach ($enquiry_worker_details as $key => $detail) {
                    if (!empty($detail)) {
                        $enquiry->enquiryWorkers()->create($detail);
                    }
                }
            }

            if (isset($input['contact_infos'])) {
                //// delete previous contacts
                $enquiry->enquiryContactInfos()->delete();
                foreach ($input['contact_infos'] as $key => $contact_info) {
                    if (!empty($contact_info)) {
                        $enquiry->enquiryContactInfos()->create($contact_info);
                    }
                }


            }

            $enquiry->update(request()->all());
            \DB::commit();
            return response()->json(['message' => 'Enquiry created successfully.'], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (!empty($e) && $e != '') {
                    if (in_array(1062, $e->errorInfo)) {
                        $exception_message = str_replace('', '', $e->errorInfo[2]);
                        $replaced_message = str_replace('', '', $exception_message);
                        $message = str_replace('key', '', $replaced_message);
                        return response()->json(['success' => false, 'error' => $message], 500);
                    } else {
                        return response()->json(['success' => false, 'error' => $e->errorInfo[2]], 500);
                    }
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $enquiry = $this->enquiryRepository->findWithoutFail($id);

        if (empty($enquiry)) {
            return redirect()->route('openEnquiries.index')->with('danger', 'Enquiry Not Found!');
        }
        $followups = EnquiryFollowup::where('enquiry_id', $enquiry->id)->count();
        if ($followups > 0) {
            // foreach ($followups as $key => $followup) {
            EnquiryFollowup::where('enquiry_id', $enquiry->id)->delete();
            // }
        }
        $this->enquiryRepository->delete($id);
        // redirect
        return redirect()->back()->with('info', 'Enquiry Deleted Successfully!');
    }


    public function storeOrganizationCampusSession($id)
    {
        if (is_null(SystemSession::get('organization_campus_id'))) {
            SystemSession::put(['organization_campus_id' => $id]);
        }
    }
}
