<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@100;200;300;400;500;600;700;800;900&display=swap');
    </style>
    <style>
        * {
            margin: 0;
            padding: 0;
            outline: none;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Roboto Slab', serif;
        }

        ul {
            padding: 0;
            margin: 0;
        }

        li {
            list-style: none;
        }

        .my-page {
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat
        }

        p {
            margin: 0;
            line-height: 1;
            padding: 0
        }
    </style>
</head>

<body>
    <div class="my-page page" size="A4">
        <img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('backend/assets/images/noc.jpg'))) }}"
            style="width: 100%" alt="Image">
        <div class="invoice__body" style="width: 100%; position: absolute;top:0;left:0">
            <div class="noc_header">
                <img src="{{ public_path('upload/logo/' . $setting->logo) }}"
                    style="margin-left: 35px;float:left;padding:10px" alt="" />
                <div style="margin-left:15px;margin-top:20px">
                    <h1 style="font-size: 24px">Study International Admission Care</h1>
                    <h6>Leading Education Consultant</h6>
                </div>

                <?php
                $pdfRoute = route('noc.veriry.pdf', [$data->id, Str::random(10)]); // generate a random token
                $pdfRouteEncoded = urlencode($pdfRoute);
                ?>


                <div id="qr_code" style="position: absolute; left: 480px; top: 12px;">
                    <a href="<?= $pdfRoute ?>" target="_blank">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?data=<?= $pdfRouteEncoded ?>&size=120x120"
                            alt="QR Code" style="max-width: 70px;">
                    </a>
                </div>
            </div>

            <div class="noc_main_content" style="margin-top: 50px;padding:0 35px">
                <h1 style="font-size: 24px;text-align:center">Letter of Agreement</h1>
                <span
                    style="color:white;font-size:10px;position: absolute;left:660px;z-index:99999;top:90px">www.siacabroad.com</span>

                <span
                    style="position: absolute;left:742px;color:white;top:1055px;font-size:10px;transform:rotate(90deg)">www.siacabroad.com</span>

                <ul style="position: absolute;left:640px;z-index:99999;top:110px">
                    <li>Date: <?php echo date('d-M-Y'); ?></li>
                    <li>Ref No: siac2094874</li>
                </ul>

                <div style="margin-top: 30px">
                    <div style="width: 48%;float: left;">
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Name of Student :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:232px;display:inline-block">{{ $data->name }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Father's Name :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:242px;display:inline-block">{{ $data->f_name }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Mother's Name :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:241px;display:inline-block">{{ $data->m_name }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Passport Number :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:230px;display:inline-block">{{ $data->passport }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Address :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:285px;display:inline-block">{{ $data->address }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Email :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:296px;display:inline-block">{{ $data->email }}</span>
                        </div>
                        <div>
                            <span style="font-weight: 700">Phone :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:296px;display:inline-block">{{ $data->number }}</span>
                        </div>
                    </div>

                    <div style="width: 48%;float: right;margin-left:4%">
                        <h3 style="margin-bottom: 20px;font-size:18px">Destination Abroad Details :</h3>
                        <div style="margin-bottom: 8px;">
                            <span style="font-weight: 700">Country Name :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:240px;display:inline-block">{{ ucwords($country->name) }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Name OF University :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:210px;display:inline-block">{{ ucwords($university->name) }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">Name Of Course :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:231px;display:inline-block">{{ ucwords($uni_course->name) }}</span>
                        </div>
                        <div style="margin-bottom: 8px">
                            <span style="font-weight: 700">University Address :</span>
                            <span
                                style="border-bottom: 1px dotted black;width:218px;display:inline-block">{{ ucwords($university->address) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <ul style="padding:0 35px;margin-top:200px">
                <li style="list-style-type: circle;margin-bottom:5px;text-align:justify">I say that it has been mutually
                    discussed between SIAC
                    and Me that I Know
                    regarding the courses,
                    tuition fees, Scholarship,
                    university/institute, boarding and lodging expenses, location of university, country’s working
                    conditions etc. and also getting permission
                    from my parents I have done all the admission process. In the future, I will not claim this Group
                    (Study International Admission Care) if
                    I made the wrong decision</li>
                <li style="list-style-type: circle;margin-bottom:5px;text-align:justify">I understand that there will
                    not be
                    any Refund of Tuition
                    fee once the
                    Student Visa is granted. and
                    I will not change the institute till
                    course completion without the written permission from the college, university or institute, after
                    landing in the selected country I have
                    applied for.</li>
                <li style="list-style-type: circle;margin-bottom:5px;text-align:justify">I agree to the fact that "After
                    reaching to the selected
                    country and
                    institution of my choice for my
                    studies, if seats are full for my selected
                    program, I have to select any other program or I would have to wait for the next available intake "
                    and for the same that my consultant
                    (SIAC) would not be responsible.</li>
                <li style="list-style-type: circle;margin-bottom:5px;text-align:justify">I confirm that all the
                    supporting
                    documents submitted by
                    me is genuine and
                    legally valid.
                </li>
                <li style="list-style-type: circle;margin-bottom:5px;text-align:justify">I extremely thank this
                    consultancy
                    firm for giving me
                    amazing suggestions.
                </li>
            </ul>

            <div style="color: #426597;padding:0 35px;margin-top:30px">
                <h2 style="font-size: 24px;">Term & Conditions</h2>
                <ul>
                    <li style="list-style-type: circle;text-align:justify">SIAC Abroad will be obliged
                        to
                        give all guidelines from admission to abroad university, till reaching the university</li>
                    <li style="list-style-type: circle;text-align:justify">SIAC consultancy does not
                        issue
                        visas, but SIAC provides all kinds of assistance in obtaining visas. It is the decision of the
                        embassy to issue a visa.
                    </li>
                    <li style="list-style-type: circle;text-align:justify">SIAC Abroad gives
                        suggestions
                        to students for studying abroad. SIAC will not be responsible for any kind of wrong decision or
                        wrong activities by the
                        student at present and in the future. I further say that SIAC Abroad is only a consultancy firm
                        which provides Education Counselling according to student
                        demand.</li>
                    <li style="list-style-type: circle;text-align:justify">Moreover, fees refund from
                        applied institution is applicable only after visa rejection or as per university’s refund
                        policy. If
                        the university does not have a
                        refund policy, then the student cannot blame SIAC. </li>
                    <li style="list-style-type: circle;text-align:justify">We do not have any service
                        charges if someone takes money from you in our name (SIAC) then the student will be responsible
                        for
                        it.</li>
                    <li style="list-style-type: circle;text-align:justify">If the student goes to a
                        university abroad, the rules and regulations of the university will be followed. Because in the
                        future, all the decisions of the
                        university will be considered as final when there are students at the university.</li>
                    <li style="list-style-type: circle;text-align:justify">SIAC do not charge any
                        further
                        processing fee for getting scholarships from our partner abroad universities.
                    </li>
                    <li style="list-style-type: circle;text-align:justify">If the student applies
                        abroad
                        with fake documents for any reason, the student himself will be responsible for it.
                    </li>
                    <li style="list-style-type: circle;text-align:justify">SIAC consultancy does not
                        take
                        any original documents from the student, in future the student cannot claim SIAC consultancy in
                        this
                        regard.
                    </li>
                </ul>
            </div>

            <h4 style="text-align: center;margin:5px 0">I AM OVER THE AGE OF EIGHTEEN (I8) YEARS AND AM COMPETENT TO
                EXECUTE THIS
            </h4>

            <div style="padding:0 35px;margin-top:15px">
                <div style="text-align: center;float: left;width:33%">
                    <img src="{{ public_path('upload/authorsignature/' . $setting->signature) }}" alt=""
                        width="100px" height="25px">
                    <h6>Authority Signature</h6>
                </div>
                <div style="text-align: center;float: left;width:33%">
                    <img src="{{ public_path('upload/noc/' . $data->signature) }}" alt="">
                    <h6>Student Signature</h6>
                </div>
                <div style="text-align: center;float: left;width:33%">
                    <img src="{{ public_path('upload/noc/' . $data->guirdiansignature) }}" alt="">
                    <h6>Guidian Signature</h6>
                </div>
            </div>

            <div style="padding:0 35px;margin-top;300px">
                <div style="width:18%;margin-top:60px">
                    <h2 style="font-size: 22px;color:white">Phone</h2>
                    <p style="color: white;font-size:16px;margin-bottom:5px">+8801786-067794</p>
                    <p style="color: white;font-size:16px">+8801797-874204</p>
                </div>
                <div style="width:25%;margin-left:150px;position: relative;top:-65px">
                    <h2 style="font-size: 22px;color:white">Email</h2>
                    <p style="color: white;font-size:18px;margin-bottom:5px">contact@siacabroad.com</p>
                    <p style="color: white;font-size:18px;margin-bottom:5px">admission@siacabroad.com</p>
                    <p style="color: white;font-size:18px;">siacadmission@gmail.com</p>
                </div>
                <div style="width:47%;float: right;position: relative;top:-150px">
                    <p style="color: white;margin-bottom:5px"><img style="width: 12px"
                            src="{{ public_path('backend/social/facebook.png') }}"
                            alt="">http://www.facebook.com/studyadmissioncare</p>
                    <p style="color: white;margin-bottom:5px"><img style="width: 12px"
                            src="{{ public_path('backend/social/facebook.png') }}"
                            alt="">http://www.facebook.com/groups/studyadmissioncare</p>
                    <p style="color: white;margin-bottom:5px"><img style="width: 12px"
                            src="{{ public_path('backend/social/facebook.png') }}"
                            alt="">http://www.facebook.com/studyindiahclpzone</p>
                    <p style="color: white;margin-bottom:5px"><img style="width: 12px"
                            src="{{ public_path('backend/social/youtube.png') }}"
                            alt="">http://www.youtube.com/@pappuchandraroy</p>
                    <p style="color: white"><img style="width: 12px"
                            src="{{ public_path('backend/social/youtube.png') }}"
                            alt="">http://www.youtube.com/@nishatfrombangladesh</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
