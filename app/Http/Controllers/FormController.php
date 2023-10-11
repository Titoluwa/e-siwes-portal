<?php

namespace App\Http\Controllers;

use App\Siwes;
use App\OrgAssessment;
use App\OrgSupervisor;
use App\SiwesAssessment;
use PDF;
// use Illuminate\Http\Request;
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
        $siwes = Siwes::where('id', $id)->with('org', 'student','department_coord')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        return view('_templates.sp3', compact('siwes', 'industry_supervisor'));
    }
    public function viewdocumentSSF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = SiwesAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        return view('_templates.ssf', compact('siwes', 'assessment', 'industry_supervisor'));
    }
    public function viewdocumentSIAR($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = OrgAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        return view('_templates.siar', compact('siwes', 'assessment', 'industry_supervisor'));

    }
    public function viewdocumentForm8($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();

        return view('_templates.form8', compact('siwes'));

    }
    public function downloadSCAF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student', 'user')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->with('org', 'user')->first();

        $pdf = PDF::loadView('_templates.scaf', compact('siwes', 'industry_supervisor'));
        return $pdf->download('SCAF.pdf');
    }
    public function downloadSP3($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','department_coord')->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        $pdf = PDF::loadView('_templates.sp3', compact('siwes', 'industry_supervisor'));
        return $pdf->download('SP3.pdf');
    }
    public function downloadSIAR($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = OrgAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        $pdf = PDF::loadView('_templates.siar', compact('siwes', 'assessment', 'industry_supervisor'));
        return $pdf->download('SIAR.pdf');
    }
    public function downloadSSF($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();
        $assessment = SiwesAssessment::where('siwes_id', $id)->first();
        $industry_supervisor = OrgSupervisor::where('org_id', $siwes->org_id)->first();

        $pdf = PDF::loadView('_templates.ssf', compact('siwes', 'assessment', 'industry_supervisor'));
        return $pdf->download('SSF.pdf');
    }
    public function downloadForm8($id)
    {
        $siwes = Siwes::where('id', $id)->with('org', 'student','assigned_staff')->first();

        $pdf = PDF::loadView('_templates.ssf', compact('siwes'));
        return $pdf->download('Form8.pdf');
    }
}
