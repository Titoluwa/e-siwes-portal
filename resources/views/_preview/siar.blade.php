@section('style')
    <style>
        p, b{
            font-size: 18px;
        }
        .main-table, .main-row, .main-row>th, .main-row>td {
            border: 1px solid;  
            border-collapse: collapse;
        }
        .no-margin{
            margin: 0;
        }
        .inserted-text{
            color: red;
        }
        .width60{
            width: 55%;
        }
        .width40{
            width: 45%;
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
                    <h3 style="margin: 0;">OBAFEMI AWOLOWO UNIVERSITY, ILE IFE, NIGERIA</h3>
                    <h3 style="margin: 0;">STUDENT'S INDUSTRIAL ASSESSMENT REPORT</h3>
                </div>
            </td>
        </tr>
    </table>
    <p>Name of Student: <b>{{$siwes->student->user->name()}} {{$siwes->student->user->middle_name}}</b></p>
    <p>Matric Number: <b>{{$siwes->student->matric_no}}</b></p>
    <p>Name of Industry: <b>{{$siwes->org->name}}</b></p>
    <p>Date of Resumption: <b>{{$siwes->resumption_date}}</b></p>
    <br>
    <p class="no-margin">Table of Assessment for {{$siwes->siwes_type->name}} Student in the Industry</p>
    
    <table class="main-table" style="width:100%;">
        <tr class="main-row">
            <td style="padding-left: 15px"><p>General Qualitative Assessment</p></td>
            <td style="padding-left: 15px"><p>Score (20)</p></td>
        </tr>
        <tr class="main-row">
            <td style="padding-left: 15px">
                <p>
                    <b>
                        @if($orgassessment->qualitative != null)
                            {{$orgassessment->qualitative}}
                        @endif
                    </b>
                </p>
            </td>
            <td style="padding-left: 15px">
                <p>
                    <b>
                        @if($orgassessment->qualitative_score != null)
                            {{$orgassessment->qualitative_score}}
                        @endif
                    </b>
                </p>
            </td>
        </tr>
    </table>

    <br>

    <table style="width: 100%">
        <tr>
            <td>
                <p>Industry Supervisor Name</p>
            </td>
            <td>
                <p>Signature/Stamp/Date</p>
            </td>
        </tr>
        <tr>
            <td>
                <b> {{$industry_supervisor->user->name()}}</b>
            </td>
            <td>
                <b><img src="{{asset('storage/'. $industry_supervisor->user->signature)}}" alt="signature" width="10%" height="3%"></b>
                <b><img src="{{asset('storage/'. $siwes->org->stamp)}}" alt="signature" width="10%" height="3%"></b>
                <b>{{Carbon\Carbon::now()->format('d/m/Y')}}</b>
            </td>
        </tr>
    </table>
    <div id="watermark">
        <img class="logo" name="oau" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
        <img class="logo" name="itf" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
    </div>
</div>