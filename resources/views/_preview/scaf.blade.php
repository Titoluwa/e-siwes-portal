@section('style')
    <style>
        .inserted{
            text-decoration: underline;
        }
        table{
            width: 100%;
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
            bottom: 9px;
            right: 9px;
            opacity: 0.6;
            color: black;
            display: block;
            align-items: center;
            justify-content: center;
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
@endsection

<div>
    <img id="imgg" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1697017316/OAU-watermark_dvtyqo.png" alt="">
    <table>
        <tr>
            <td style="width: 10%;">
                <div>
                    <img style="width: 100%;" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
                </div>
            </td>
            <td style="width: 90%; margin: 0; padding: 0;">
                <div style="text-align: center;">
                    <h1 style="margin: 0; font-size: 50px; word-spacing: 10px;" >INDUSTRIAL TRAINING FUND</h1>
                    <h3 style="margin: 0; font-size: 25px">STUDENTS COMMENCEMENT OF ATTACHMENT FORM (SCAF)</h3>
                    <h3 style="margin: 0; font-size: 21px">OBAFEMI AWOLOWO UNIVERSITY, ILE IFE, NIGERIA</h3>
                </div>
            </td>
        </tr>
    </table>
    <br>
    <table id="off-table">
        <tr>
            <td>
                <p style="margin: 10px;"><b>ITF Area Office: </b>___________________________</p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin: 10px;"><b>Name of Organization: </b> <span class="inserted">{{$siwes->org->name}}</span></p>
            </td>
            <td>
                <p style="margin: 10px;"><b>Phone Number of Organization: </b> <span class="inserted">0{{$industry_supervisor->user->contact_no}}</span></p>
            </td>
        </tr>
        <tr>
            <td>
                <p style="margin: 10px;"><b>Email of Organization: </b> <span class="inserted">{{$siwes->org->postal_address}}</span></p>
            </td>
            <td>
                <p style="margin: 10px;"><b>Location Address: </b> <span class="inserted">{{$siwes->org->full_address}}</span></p>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <table class="main-table" style="max-height: 30%;">
        <tr class="main-row">
            <th style="width: 2%;">S/No.</th>
            <th style="width: 20%;">Name of Student</th>
            <th style="width: 10%;">Matric No.</th>
            <th style="width: 18%;">Course of Study and Year/Level</th>
            <!-- <th style="width: 10%;">Year</th>
            <th style="width: 10%;">Level</th> -->
            <th style="width: 10%;">Period of Attachment (Months)</th>
            <th style="width: 10%;">Date of Commencement</th>
            <th style="width: 10%;">Date of Completion</th>
            <th style="width: 10%;">Signature</th>
        </tr>
        <tr class="main-row">
            <td>1</td>
            <td>{{$siwes->student->user->name()}} {{$siwes->student->user->middle_name}}</td>
            <td>{{$siwes->student->matric_no}}</td>
            <td>{{$siwes->student->course_of_study}} ({{$siwes->year_of_training}}) / {{$siwes->level}} </td>
            <!-- <td>Year</td>
            <td>Level</td> -->
            <td>{{$siwes->duration_of_training}}</td>
            <td>{{$siwes->resumption_date}}</td>
            <td>{{$siwes->ending_date}}</td>
            <td>
                {{-- <img src="data:image/png;base64, <?php echo base64_encode(file_get_contents(base_path('/storage/'.$siwes->student->signature))); ?>" width="100%">
                src="{{ storage_path('app/public/images/codeanddeploy.jpg') }}"
                <img src="{{ storage_path('app/public/'.$siwes->student->signature) }}" alt=""> --}}
                <img src="/storage/{{$siwes->student->signature}}" alt="signature" width="100%">
            </td> 
        </tr>
    </table>
    <br>
    <p><b>Date: </b> <span class="inserted">{{Carbon\Carbon::now()->format('d/m/Y')}}</span></p>
    <p><b>Stamp and Signature: </b> <span class="inserted"><img src="/storage/{{$industry_supervisor->profile_pic}}" alt="signature" width="180" height="30"></span></p>
    <div id="watermark">
        <img class="logo" name="oau" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
        <img class="logo" name="itf" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
    </div>    
</div>