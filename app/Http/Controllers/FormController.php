<?php

namespace App\Http\Controllers;

use PDF;
use App\Form8;
use App\Siwes;
use App\Staff;
use App\PrintDoc;
use Carbon\Carbon;
// use Illuminate\Http\Request;
use App\OrgAssessment;
use App\OrgSupervisor;
use App\SiwesAssessment;
use Illuminate\Http\Response;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function viewdocumentSCAF($id) 
    {
        // Retrieve data from the database
        $siwes = Siwes::where('id', $id)->with('org', 'student', 'user')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->with('org', 'user')->first();

        return view('_templates.scaf', compact('siwes', 'industry_supervisor'));
    }
    public function viewdocumentSP3($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student', 'user')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
        $dept_coord = Staff::where('department', $siwes->department())->first();

        return view('_templates.sp3', compact('siwes', 'industry_supervisor', 'dept_coord'));
    }
    public function viewdocumentSSF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = SiwesAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
        if ($assessment == null) {
            return response('No Assessment Found', 404);
        }else{
            return view('_templates.ssf', compact('siwes', 'assessment', 'industry_supervisor'));
        }
    }
    public function viewdocumentSIAR($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $orgassessment = OrgAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
        if ($orgassessment == null) {
            return response('No Assessment Found', 404);
        }else{
            return view('_templates.siar', compact('siwes', 'orgassessment', 'industry_supervisor'));
        }
    }
    public function viewdocumentForm8($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $form8 = Form8::where('siwes_id', $id)->with('siwes')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
        
        return view('_templates.form8', compact('siwes', 'form8', 'industry_supervisor'));

    }
    public function downloadSCAF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student', 'user')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->with('org', 'user')->first();

        $current_date = Carbon::now()->format('Y-m-d');
        $printed = PrintDoc::where('siwes_id', $id)->first();
        $printed->update(['scaf' => 1, 'scaf_print' => $current_date]);

        $pdf = PDF::loadView('_templates.scaf', compact('siwes', 'industry_supervisor'));
        return $pdf->download('SCAF.pdf');
    }
    public function downloadSP3($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student', 'user')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();
        $dept_coord = Staff::where('department', $siwes->department())->first();

        $current_date = Carbon::now()->format('Y-m-d');
        $printed = PrintDoc::where('siwes_id', $id)->first();
        $printed->update(['sp3' => 1, 'sp3_print' => $current_date]);

        $pdf = PDF::loadView('_templates.sp3', compact('siwes', 'industry_supervisor', 'dept_coord'));
        return $pdf->download('SP3.pdf');
    
    }
    public function downloadSIAR($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $orgassessment = OrgAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        if ($orgassessment == null) {
            return response('No Assessment Found', 404);
        }else{
            $current_date = Carbon::now()->format('Y-m-d');
            $printed = PrintDoc::where('siwes_id', $id)->first();
            $printed->update(['siar' => 1, 'siar_print' => $current_date]);

            $pdf = PDF::loadView('_templates.siar', compact('siwes', 'orgassessment', 'industry_supervisor'));
            return $pdf->download('SIAR.pdf');
        }
    }
    public function downloadSSF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = SiwesAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        if ($assessment == null) {
            return response('No Assessment Found', 404);
        }else{
            $current_date = Carbon::now()->format('Y-m-d');
            $printed = PrintDoc::where('siwes_id', $id)->first();
            $printed->update(['ssf' => 1, 'ssf_print' => $current_date]);

            $pdf = PDF::loadView('_templates.ssf', compact('siwes', 'assessment', 'industry_supervisor'));
            return $pdf->download('SSF.pdf');
        }
    }
    public function downloadForm8($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $form8 = Form8::where('siwes_id', $id)->with('siwes')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        $current_date = Carbon::now()->format('Y-m-d');
        $printed = PrintDoc::where('siwes_id', $id)->first();
        $printed->update(['form8' => 1, 'form8_print' => $current_date]);
        
        $pdf = PDF::loadView('_templates.form8', compact('siwes', 'form8', 'industry_supervisor'));
        return $pdf->download('Form8.pdf');
    }
}
