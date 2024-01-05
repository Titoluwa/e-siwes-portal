<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            margin: 10px; 
            padding: 10px;
        }
        .inserted{
            text-decoration: underline;
        }
        table{
            width: 100%;
        }
        span{
            font-weight: bold;
            text-decoration: underline;
        }
        #imgg{
            margin: 10% 20%;
            position: absolute; 
            align-items: center; 
            justify-content: center; 
            height: 70vh;
        }
        #watermark{
            position: fixed;
            /* bottom: 19px; */
            /* right: 19px; */
            opacity: 0.6;
            color: black;
            display: block;
            align-items: center;
            justify-content: center;
        }
        .part-a, .part-a>th, .part-a>td{
            line-height: 1.5;
        }
        .main-table, .main-row, .main-row>th, .main-row>td {
            text-align: center;
            border: 1px solid;  
            border-collapse: collapse;
            line-height: 200%;
        }
        #off-table{
            border: 0;
        }
    </style>
    <title>Form 8 - End of Programme Report Sheet</title>
</head>
<body>
    <img id="imgg" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1697017316/OAU-watermark_dvtyqo.png" alt="">
    <table>
        <tr>
            <td style="width: 10%;">
                <div>
                    <img style="width: 100%;" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
                    {{-- <img style="width: 100%;" src="/images/itf_logo_large.png" alt=""> --}}
                </div>
            </td>
            <td style="width: 75%; margin: 0; padding: 0;">
                <div style="text-align: center;">
                    <h1 style="margin: 0; font-size: 30px; word-spacing: 2px;" >INDUSTRIAL TRAINING FUND</h1>
                    <h3 style="margin: 0; font-size: 24px">MIANGO ROAD, P.M.B. 2199, JOS</h3>
                    {{-- <h3 style="margin: 0; font-size: 21px">OBAFEMI AWOLOWO UNIVERSITY, ILE IFE, NIGERIA</h3> --}}
                </div>
            </td>
            <td style="width: 15%;">
                <div>
                    <img style="width: 100%" src="/images/default_user.png" alt="">
                </div>
            </td>
        </tr>
    </table>
    <div style="margin:0px; padding:0px; text-align: center;">
        <p style="text-decoration: underline;">STUDENT INDUSTRIAL WORK EXPERIENCE SCHEME</p>
        <p style="text-decoration: underline;">END-OF-PROGRAMME REPORT SHEET</p>
    </div>
    <b>Part A (Completed by the student)</b>
    <section id="part-a" style="margin: 0; padding-left:16px; padding-bottom:5px;">
        <table class="part-a">
            <tr>
                <td>
                    1.
                </td>
                <td>
                    (a) Name in full: <span>  {{$siwes->user->name()}} {{$siwes->user->middle_name}} </span>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    (b) Registration/Matriculation Number: <span> {{$siwes->student->matric_no}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (c) Course of Study:  <span> {{$siwes->student->course_of_study}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (d) Year of Study:  <span> {{$siwes->year_of_training}} </span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (e) Name of Institution: <span> Obafemi Awolowo University </span>
                </td>
            </tr>
            <tr>
                <td>
                    2.
                </td>
                <td>
                    (a) Name & Address of the Company/Establishment: <span> {{$siwes->org->name}} / {{$siwes->org->full_address}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (b) The Department/Section: <span> {{$form8->depts_at_org}} </span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (c) Period of Attachment: From: <span>{{$siwes->resumption_date}}</span>  To: <span>{{$siwes->ending_date}}</span>
                    <br> Number of Weeks: <span> {{$siwes->duration_of_training}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    3.
                </td>
                <td>
                    Total Allowance Received by Student:  <span>#{{$form8->total_allowance}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    4.
                </td>
                <td>
                    Brief Outline of experience/relevance of training provided: <span>{{$form8->experience_outline}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (a) Where were you attached last (if applicable): <span> {{$form8->perivous_attachement}}  </span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    (b) Total Number of weeks engaged on industrial attachment: <span> {{$form8->weeks_engaged}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    Signature: <span><img src="{{asset('storage/'. $siwes->student->signature)}}" alt="signature" width="10%" height="3%"></span>  Date: <span>{{$form8->student_filled}}</span>
                </td>
            </tr>
        </table>
    </section>
    
    <b>Part B (Completed by the Employer)</b>
    <section id="part-b" style="margin: 0; padding-left:16px; padding-bottom:5px;">
        <table class="part-a">
            <tr>
                <td>
                    5.
                </td>
                <td>
                    Do you agree with the student's comments in items 3&4 in Part A?
                    <span>   
                        @if($form8->employer_agree_3 == 0)
                            <b>NO</b>
                        @else
                            <b>YES</b>
                        @endif    
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    State total amount paid to student as ITF allowance: <span>#{{$form8->employer_total_allowance}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    In Words: <span> {{numberToWords($form8->employer_total_allowance)}} Naira</span>
                </td>
            </tr>
            <tr>
                <td>
                    6.
                </td>
                <td>
                    Assess the student's overall performance: <span> {{$form8->employer_assessment}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    7.
                </td>
                <td>
                    Will you accept the student in any future attachment?
                    <span> 
                        {{$form8->accept_student}}
                        {{-- @if()
                            <b>NO</b>
                            Why? <b>{{$assessment->why_not_available}}</b>
                        @else
                            <b>YES</b>
                        @endif     --}}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    8.
                </td>
                <td>
                    Is your Company/Establishment in a position to offer this student a job in the future? <span> {{$form8->future_position}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    9.
                </td>
                <td>
                    Name of Reporting Officer: <span>{{$industry_supervisor->user->name()}}</span>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    Designation/Rank: <span>{{$form8->employer_rank}}</span>
                </td>
            </tr>
            <tr>
                <td><p></p></td>
                <td></td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    Signature/Stamp: <span><img src="{{asset('storage/'. $industry_supervisor->user->signature)}}" alt="signature" width="10%" height="3%"></span>  Date: <span>{{$form8->employer_filled}}</span>
                </td>
            </tr>
        </table>
            
        <p><b>NB: </b>Forms duly completed by employers should be forwarded to/collected by the respective institutions under seal.</p>
    </section>
    
    <b>Part C (Completed by the Institution)</b>
    <section id="part-c" style="margin: 0; padding-left:16px; padding-bottom:5px;">
        <table class="part-a">
            <tr>
                <td>
                    10.
                </td>
                <td>
                    Indicate number of visit(s): <span> {{$form8->no_of_visits}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    11.
                </td>
                <td>
                    Assessment of facilites provided by Company during visit(s): <span> {{$form8->assess_facilties}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    12.
                </td>
                <td>
                    Impression of the Student's involvement in training: <span>{{$form8->student_impression}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    13.
                </td>
                <td>
                    Assessment of student's performance (Grading): <span> {{$form8->assess_student_grade}}</span>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
                <td>
                    Full name of Supervisor: <span>{{$siwes->assigned_staff->user->name()}} </span>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    Rank: <span> {{$form8->staff_rank}}</span>
                </td>
            </tr>
            <tr>
                <td>

                </td>
                <td>
                    Department/Discipline: <span>{{$siwes->assigned_staff->department}} </span>
                </td>
            </tr>
            <tr>
                <td>
                    <p></p>
                </td>
                <td>
                   
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td>
                    Signature/Stamp: <span><img src="{{asset('storage/'. $siwes->assigned_staff->user->signature)}}" alt="signature" width="10%" height="3%"></span>  Date: <span>{{$form8->staff_filled}}</span>
                </td>
            </tr>
        </table>    
        <p><b>NB: </b>This form is to be returned to the ITF on completion by the institution under seal.</p>
    </section>
    
    <div id="watermark">
        <img class="logo" name="oau" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
        <img class="logo" name="itf" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
    </div>    
</body>
</html>