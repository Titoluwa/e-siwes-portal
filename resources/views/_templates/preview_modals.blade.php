@if (!empty($siwes))
    @if ($siwes->siwes_type_id == 3 || $siwes->siwes_type_id == 2)
        {{-- PREVIEW Form 8 before Printing --}}
        <div class="modal fade" id="Form8previewmodal" tabindex="-1" role="dialog" aria-labelledby="Form8preview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Form8preview"><b> Preview END-OF-PROGRAMME REPORT SHEET (Form 8) </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (!empty($form8))
                            @if($form8 != null && $form8->student_filled == null)
                                <h4 class="text-center">Student has <b>not</b> filled the form</h4>
                            @endif
                            @if($form8 != null && $form8->employer_filled == null)
                                <h4 class="text-center">Industry Based Supervisor has <b>not</b> filled the form</h4>
                            @endif
                            @if ($form8 != null && $form8->staff_filled == null)
                                <h4 class="text-center">Visiting Supervisor has <b>not</b> filled the form</h4>
                            @endif
                            @if($form8 != null && $form8->student_filled != null && $form8->employer_filled != null && $form8->staff_filled != null)
                                @include('_templates.form8')
                            @endif
                        @else
                            <h4 class="text-center">Form has <b>not</b> been filled</h4>
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

        {{-- PREVIEW SP3 before Printing --}}
        <div class="modal fade" id="SP3previewmodal" tabindex="-1" role="dialog" aria-labelledby="SP3preview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="SP3preview"><b> Preview OAU/SIWES/SP.3 Letter </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        @include('_templates.sp3')
                        
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
                            <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @include('_templates.scaf')
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
                            <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (!empty($assessment))
                            @include('_templates.ssf')
                        @else
                            <h4 class="text-center">NO Assessment has been submitted</h4>
                        @endif
                        
                    </div>
                    <div class="modal-footer">
                        @if(!empty($assessment))
                            <a target='_blank' class="btn btn-outline-primary" href="/form/download-ssf/{{$siwes->id}}">Download</a>
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
                            <span aria-hidden="true"><b>&times;</b></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (!empty($orgassessment))
                            @include('_templates.siar')
                        @else
                        <h4 class="text-center">NO Assessment has been submitted</h4>
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
    @endif 
@endif