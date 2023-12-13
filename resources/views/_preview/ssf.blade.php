@section('style')
    <style>
        table{
            width: 100%;
        }
        .main-table, .main-row, .main-row>tr, .main-row>td {
            border: 1px solid;  
            border-collapse: collapse;
        }
        .no-margin{
            margin: 0;
        }
        #imgg{
            margin: 20% 10%;
            position: absolute; 
            align-items: center; 
            justify-content: center; 
            height: 50vh;
        }
        #watermark{
            position: fixed;
            bottom: 9px;
            right: 9px;
            opacity: 0.6;
            color: black;
            display: block;
            align-items: center;
            justify-content: center;
        }
    </style>
@endsection
<div>
    <img id="imgg" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1697017316/OAU-watermark_dvtyqo.png" alt="">
    <table>
        <tr>
            <td style="width: 10%;">
                <div>
                    <img style="width: 100%;" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
                </div>
            </td>
            <td style="width: 90%; margin: 0; padding: 0;">
                <div style="text-align: center;">
                    <h3 style="margin: 0;" >INDUSTRIAL TRAINING COORDINATING UNIT (ITCU)</h3>
                    <h3 style="margin: 0;">OBAFEMI AWOLOWO UNIVERSITY, ILE IFE</h3>
                    <h3 style="margin: 0;">SIWES SUPERVISION FORM</h3>
                </div>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <p>
                <td>NAME OF STUDENT: <b>{{$siwes->student->user->name()}} {{$siwes->student->user->middle_name}}</b></td>
                <td>REGISTRATION NUMBER: <b>{{$siwes->student->matric_no}}</b></td>
            </p>
        </tr>
    </table>
    <table>
        <tr>
            <p style="padding: 6px 0px">
                COURSE OF STUDY AND LEVEL: <b>{{$siwes->student->course_of_study}} | {{$siwes->level}}</b>
            </p>
        </tr>
        <tr>
            <p style="padding: 3px 0px; line-height: 1.5;">
                NAME AND ADDRESS OF INDUSTRY: <b>{{$siwes->org->name}} | {{$siwes->org->full_address}}</b>
            </p>
        </tr>
        <tr>
            <p style="padding: 3px 0px">
                DATE OF VISITATION: <b>{{$assessment->visitation_date}}</b>
            </p>
        </tr>
    </table>

    <p>ASSESSMENT OF CANDIDATE <i>(Compeleted in conjunction with the industry based supervisor)</i></p>
    <section style="margin: 0; padding-left:16px; padding-bottom:5px;">
        
        <p style="line-height: 1.5">
            (a) Is student in the industry at the time of visit?  
            <span> 
                @if($assessment->available_at_visit == 0)
                    <b>NO</b>
                    Why? <b>{{$assessment->why_not_available}}</b>
                @else
                    <b>YES</b>
                @endif
            </span>
        </p>
        <p>
            (b) Is the logbook sighted during the visit?  
            <span> 
                @if($assessment->logbook_seen == 0)
                    <b>NO</b>
                @else
                    <b>YES</b>
                @endif
            </span>
        </p>
        <p>
            (c) Is the logbook completed up-to-data at the time of visit?  
            <span> 
                @if($assessment->logbook_completed == 0)
                    <b>NO</b>
                @else
                    <b>YES</b>
                @endif
            </span>
        </p>
        <p style="line-height: 1.5">
            (d) Is the logbook appropriately?  
            <span> 
                @if($assessment->logbook_appropriate == 0)
                    <b>NO</b>
                    state the deficiences? <b>{{$assessment->why_not_appropriate}}</b>
                @else
                    <b>YES</b>
                @endif
            </span>
        </p>
        <p style="line-height: 1.5">
            (e) Attitude of the student to training <b> {{$assessment->attitude_student}}</b>
        </p>
        <p style="line-height: 1.5">
            (f) Any major challenge(s) requiring immediate attention of the SIWES office? Please specify 
            @if ($assessment->challenges == null)
                <b>None</b>
            @else
                <b>{{$assessment->challenges}}</b>
            @endif
        </p>
    </section>

    <p>Name and Signature of Industry based supervisor: <b>{{$industry_supervisor->user->name()}}</b> </p>
    <p>Name and Signature of University based supervisor: <b>{{$siwes->assigned_staff->user->name()}} </b> </p>
    <br>
    <small style="padding-left: 8px;"><b>For official Use only: </b></small>
    <small>
        <table class="main-table">
            <tr class="main-row">
                <td style="padding-left: 8px;">
                    <p class="no-margin">Number on placement list:</p>
                    <p class="no-margin">Department of Candidate:</p>
                    <p class="no-margin">Name of Department SIWES Coordinator:</p>
                </td>
            </tr>
            <tr class="main-row">
                <td style="padding: 100px;">

                </td>
            </tr>
        </table>
    </small>
    <div id="watermark">
        <img class="logo" name="oau" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
        <img class="logo" name="itf" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
    </div>
</div>