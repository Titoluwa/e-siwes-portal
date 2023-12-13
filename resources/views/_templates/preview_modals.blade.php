{{-- PREVIEW SP3 before Printing --}}
<div class="modal fade" id="SP3previewmodal" tabindex="-1" role="dialog" aria-labelledby="SP3preview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="SP3preview"><b> Preview OAU/SIWES/SP.3 Letter </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <b aria-hidden="true"><b>&times;</b></b>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex-center">
                    <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-sp3/{{$siwes->id}}">Download</a>
                </div>

                @include('_preview.sp3')
            </div>
            <div class="modal-footer">
                <a target='_blank' class="btn btn-outline-primary" href="/form/download-sp3/{{$siwes->id}}">Download</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- PREVIEW SCAF before Printing --}}
<div class="modal fade" id="Scafpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="Scafpreview" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Scafpreview"><b> Preview STUDENTS COMMENCEMENT OF ATTACHMENT FORM (SCAF) </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <b aria-hidden="true"><b>&times;</b></b>
                </button>
                <br>
            </div>
            <div class="modal-body">
                <div class="flex-center">
                    <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-scaf/{{$siwes->id}}">Download</a>
                </div>
                @include('_preview.scaf')
            </div>
            <div class="modal-footer">
                <a target='_blank' class="btn btn-outline-primary" href="/form/download-scaf/{{$siwes->id}}">Download</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 

{{-- PREVIEW ssf before Printing --}}
<div class="modal fade" id="ssfpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="Sffpreview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Sffpreview"><b> Preview SIWES Supervision Form </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <b aria-hidden="true"><b>&times;</b></b>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex-center">
                    @if(!empty($assessment))
                        <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-ssf/{{$siwes->id}}">Download</a>
                    @endif
                </div>
                <br>
                @if (!empty($assessment))
                    @include('_preview.ssf')
                @else
                    <h4 class="text-center">NO Assessment has been submitted</h4>
                    <p class="text-center">Contact assigned visiting supervisor (<b>{{$siwes->assigned_staff->user->name()}}</b> - 0{{$siwes->assigned_staff->user->contact_no}} or <a href="mailto:{{$siwes->assigned_staff->user->email}}">{{$siwes->assigned_staff->user->email}}</a>)</p>
                @endif         
            </div>
            <div class="modal-footer">
                @if(!empty($assessment))
                    <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-ssf/{{$siwes->id}}">Download</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 

{{-- PREVIEW SIAR before Printing --}}
<div class="modal fade" id="siarpreviewmodal" tabindex="-1" role="dialog" aria-labelledby="Siarpreview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Siarpreview"><b> Preview STUDENT'S INDUSTRIAL ASSESSMENT REPORT </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <b aria-hidden="true"><b>&times;</b></b>
                </button>
            </div>
            <div class="modal-body">
                <div class="flex-center">
                    @if(!empty($orgassessment))
                        <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-siar/{{$siwes->id}}">Download</a>
                    @endif
                </div>
                <br>
                @if (!empty($orgassessment))
                    @include('_preview.siar')
                @else
                    <h4 class="text-center">NO Assessment has been submitted</h4>
                    <p class="text-center">Contact industry based supervisor (<b>{{$industry_supervisor->user->name()}}</b> - 0{{$industry_supervisor->user->contact_no}} or <a href="mailto:{{$industry_supervisor->user->email}}">{{$industry_supervisor->user->email}}</a>)</p>
                @endif
            </div>
            <div class="modal-footer">
                @if(!empty($orgassessment))
                    <a target='_blank' class="btn btn-outline-primary" href="/form/download-siar/{{$siwes->id}}">Download</a>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> 

{{-- PREVIEW Form 8 before Printing --}}
<div class="modal fade" id="Form8previewmodal" tabindex="-1" role="dialog" aria-labelledby="Form8preview" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Form8preview"><b> Preview END-OF-PROGRAMME REPORT SHEET (Form 8) </b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <b aria-hidden="true"><b>&times;</b></b>
                </button>
                
            </div>
            <div class="modal-body">
                <div class="flex-center">
                    @if(!empty($form8))
                        @if($form8 != null && $form8->student_filled != null && $form8->employer_filled != null && $form8->staff_filled != null)
                            <a target='_blank' class="float-right btn btn-outline-primary" href="/form/download-form8/{{$siwes->id}}">Download</a>
                        @endif
                    @endif
                </div>
                @if (!empty($form8))
                    @if($form8 != null && $form8->student_filled == null)
                        <h4 class="text-center">Student has <b>not</b> filled the form</h4>
                    @endif
                    @if($form8 != null && $form8->employer_filled == null)
                        <h4 class="text-center">Industry Based Supervisor has <b>not</b> filled the form</h4>
                        <p class="text-center">Contact industry based supervisor (<b>{{$industry_supervisor->user->name()}}</b> - 0{{$industry_supervisor->user->contact_no}} or <a href="mailto:{{$industry_supervisor->user->email}}">{{$industry_supervisor->user->email}}</a>)</p>
                        <p class="text-center text-danger">Industry based supervisor has to fill the form before Visiting Supervisor can get access to fill the form</p>
                    @endif
                    @if ($form8 != null && $form8->staff_filled == null)
                        <h4 class="text-center">Visiting Supervisor has <b>not</b> filled the form</h4>
                        <p class="text-center">Contact assigned visiting supervisor (<b>{{$siwes->assigned_staff->user->name()}}</b> - 0{{$siwes->assigned_staff->user->contact_no}} or <a href="mailto:{{$siwes->assigned_staff->user->email}}">{{$siwes->assigned_staff->user->email}}</a>)</p>
                    @endif
                    @if($form8 != null && $form8->student_filled != null && $form8->employer_filled != null && $form8->staff_filled != null)
                        @include('_preview.form8')
                    @endif
                @else
                    {{-- <h4 class="text-center">Form has <b>not</b> been filled</h4> --}}
                    <h4 class="text-center">Student has <b>not</b> filled the form</h4>
                @endif
            </div>
            <div class="modal-footer">
                @if(!empty($form8))
                    @if($form8 != null && $form8->student_filled != null && $form8->employer_filled != null && $form8->staff_filled != null)
                        <a target='_blank' class="btn btn-outline-primary" href="/form/download-form8/{{$siwes->id}}">Download</a>
                    @endif
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>