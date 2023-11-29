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
            .no-margin{
                margin: 0;
            }
            .inserted-text{
                color: blueviolet;
                text-decoration: underline;
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
        <title>SP.3</title>
    </head>
    <body>
        <img id="imgg" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1697017316/OAU-watermark_dvtyqo.png" alt="">
        <p><b>Ref: OAU/SIWES/SP.3/</b></p>
        <table style="width: 100%; margin: 0; padding: 0;">
            <tr>
                <td style="width: 30%; margin: 0; padding: 0;">
                    <div style="text-align: right;">
                        <p class=""><i> (Company Name & Address)</i> </p>
                        <p class="no-margin inserted-text"> {{$siwes->org->name}} </p>
                        <p class="no-margin inserted-text"> {{$siwes->org->full_address}} </p>
                        <p> Date: <span class="inserted-text">{{Carbon\Carbon::now()->format('d/m/Y')}}</span></p>
                    </div>
                </td>
            </tr>
        </table>
        
        <div class="no-margin">
            <b>
                <p class="no-margin" style="text-decoration: underline;">
                    PLEASE RETURN WITHIN A WEEK TO:
                </p>
                <p class="no-margin">
                    The SIWES Coordinator,
                </p>
                <p class="inserted-text no-margin">
                    <i>{{$dept_coord->user->name()}}</i>
                </p>
                <p class="no-margin">
                    Obafemi Awolowo University
                </p>
                <p class="no-margin">
                    Ile-Ife, Osun State.
                </p>
            </b>
        </div>
        
        <p>
            <b>Dear Sir/Ma, </b>
        </p>

        <p>
            <b style="text-decoration: underline;">ASSUMPTION OF DUTY AT PLACE OF INDUSTRIAL ATTACHMENT</b>
        </p>

        <p>
            I have assumed duty at my place of Industrial Attachment as indicated above. Other information required are given below:
        </p>
        <p style="margin-top: 4%">
            DATE OF ASSUMPTION OF DUTY: <span class="inserted-text">{{$siwes->resumption_date}}</span>
        </p>
        <p style="margin-top: 5%">
            NAME OF INDUSTRIAL BASED SUPERVISOR: <span class="inserted-text">{{$industry_supervisor->user->name()}} {{$industry_supervisor->user->middle_name}}</span>
        </p>
        <table>
            <tr>
                <td class="width60">
                    <p>
                        RANK: <span class="inserted-text">{{$industry_supervisor->position}}</span>
                    </p>
                </td>
                <td class="width40"> 
                    <p>
                        SIGNATURE: <img src="/storage/{{$siwes->student->signature}}" alt="signature" width="10%" height="3%"> 
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        PHONE NUMBER: <span class="inserted-text">0{{$industry_supervisor->user->contact_no}}</span>
                    </p>
                </td>
                <td>         
                    <p>
                        OFFICIAL STAMP: <span></span>
                    </p>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        NAME OF STUDENT: <span class="inserted-text"> {{$siwes->user->name()}} {{$siwes->user->middle_name}} </span>
                    </p>
                </td>
                <td>
                    <p>
                        MATRIC NUMBER: <span class="inserted-text">{{$siwes->student->matric_no}}</span>
                    </p>
                </td>
            </tr>
            <tr>
                <td class="width40">
                    <p>
                        PHONE NUMBER: <span class="inserted-text">0{{$siwes->user->contact_no}}</span>
                    </p>
                </td>
                <td class="width60">
                    <p>
                        SIGNATURE/DATE: <img src="/storage/{{$siwes->student->signature}}" alt="signature" width="10%" height="3%"> {{Carbon\Carbon::now()->format('d/m/Y')}}
                    </p>
                </td>
            </tr>
        </table>
        <div id="watermark">
            <img class="logo" name="oau" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/OAU-Logo_grazuh.png" alt="">
            <img class="logo" name="itf" width="60" height="60" src="https://res.cloudinary.com/dwpdkfhmv/image/upload/v1696958202/itf_logo_large_tasfhy.png" alt="">
        </div>
    </body>
</html>