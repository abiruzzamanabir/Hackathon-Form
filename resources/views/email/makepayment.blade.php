@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    $domain = Config::get('app.url');
    // $domain = 'https://bbf.digital/dma2023/nomination';
    $amount = $theme->amount;
    // $vat = $theme->amount *= 0.15;
    // $total = $amount + $vat;
    $members_array = json_decode($all_members);
    // Initialize an array to store email addresses
    $email_addresses = [];

    $rate_2 = getenv('RATE_2');
    $rate_3 = getenv('RATE_3');

    // Check if decoding was successful
    if ($members_array !== null) {
        // Iterate through each member object
        foreach ($members_array as $member) {
            // Assuming each member object has an 'email' property
            if (isset($member->member_email)) {
                // Add email to the array
                $email_addresses[] = $member->member_email;
            }
        }
    }

    // Return array of email addresses
    $email_addresses;
    $member_count = count($email_addresses) + 1;
    if ($member_count <= 3) {
        $rate = $amount;
    } elseif ($member_count >= 4 && $member_count <= 6) {
        $rate = $rate_2;
    } else {
        $rate = $rate_3;
    }
    $total_amount = $rate * $member_count;
    $vat = $total_amount * 0.15;
    $total = $total_amount + $vat;
@endphp
<!DOCTYPE htmlPUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Request for Payment for Nomination</title>
    <style type="text/css">
        body {
            background-image: linear-gradient(rgba(255, 255, 255, 0.9),
                    rgb(255, 255, 255, 0.9)),
                url({{ $domain . '/public/assets/img/' . $theme->background }});
            margin: 0;
        }

        table {
            border-spacing: 0;
            padding: 20px;
        }

        td {
            padding: 0;
        }

        .main-table {
            max-width: 600px;
            background-image: linear-gradient(rgba(255, 255, 255, 0.5),
                    rgb(255, 255, 255, 0.5)),
                url({{ $domain . '/public/assets/img/' . $theme->background }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            padding: 10px;
            border-spacing: 0;
            margin: 0 auto;
        }

        .container {
            /* max-width: 600px; */
            background-color: #ffffff;
            background-image: linear-gradient(rgba(255, 255, 255, 0.9),
                    rgb(255, 255, 255, 0.9)),
                url({{ $domain . '/public/assets/img/' . $theme->iconbg }});
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
        }

        .logo {
            text-align: center;
            font-size: 0;
        }

        .logo .column {
            width: 100%;
            max-width: 300px;
            display: inline-block;
            vertical-align: middle;
        }

        .logo .column a {
            text-decoration: none;
            vertical-align: middle;
            color: tomato;
        }

        .logo .column strong {
            vertical-align: middle;
            color: tomato;
        }

        .button {
            display: block;
            padding: 7px 20px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            color: #000 !important;
            background-image: linear-gradient(rgba(255, 255, 255, 0.5),
                    rgb(255, 255, 255, 0.5)),
                url({{ $domain . '/public/assets/img/' . $theme->background }});
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center center;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin: 20px auto;
            width: 20%;
            text-align: center;
        }

        .button:hover {
            background-image: linear-gradient(rgba(122, 122, 122, 0.7),
                    rgba(122, 122, 122, 0.7)),
                url({{ $domain . '/public/assets/img/' . $theme->background }});
            /* background-color: #cdcdcd !important; */
            color: #fff !important;
        }

        .footer {
            /* max-width: 600px; */
            margin: 100px auto 0px;
            color: #fff;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            box-shadow: 0 2px 8px rgba(71, 71, 71, 0.5);
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url({{ $domain . '/public/assets/img/' . $theme->background }});
            background-size: cover;
            background-position: center;
        }

        .footer a {
            color: #999999;
            text-decoration: none;
        }

        .footer p {
            text-align: center;
            margin: 20px 0px 5px;
        }

        .footer a:hover {
            color: #555555;
        }

        .fa {
            padding: 7px;
            font-size: 13px;
            width: 20px;
            text-align: center;
            text-decoration: none;
            margin: 10px 5px;
            color: white !important;
        }

        .fa:hover {
            opacity: 0.7;
        }

        .footer img {
            width: 36px !important;
            border: 0px !important;
            display: inline !important;
        }

        @media only screen and (max-width: 600px) {
            img {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }

            .button {
                display: block;
                padding: 10px 15px;
                font-size: 14px;
                margin: 20px auto;
                width: 40%;
            }

            .footer a {
                color: #999999;
                text-decoration: underline;
                border: none;
            }

            .fa {
                padding: 0px;
                font-size: 12px;
                width: 20px;
                text-align: center;
                text-decoration: none;
                margin: 0px 5px;
                color: white !important;
            }
        }
    </style>
</head>

<body>
    <center class="main-table">
        <div class="container">
            <table width="100%">
                <!-- <tr>
                      <td height="8" style="background-color: rgb(94, 255, 0);"></td>
                  </tr> -->

                <!-- <tr>
                      <td style="padding: 15px 0 5px;">
                          <table width="100%">
                              <tr>
                                  <td class="logo">
                                      <table class="column">
                                          <tr>
                                              <td style="padding: 5px 0px 10px 50px;">
                                                  <a href="https://bbf.digital/fintech-award-2023/"><img src="https://bbf.digital/fintech-award-2023/wp-content/uploads/2023/06/Fintech-Logo-01-e1686660175351.png" alt="Logo" width="140"></a>
                                              </td>
                                          </tr>
                                      </table>
                                      <table class="column">
                                          <tr>
                                              <td style="padding: 5px 0px 10px 50px;">
                                                  <a href="#"><img src="https://bbf.digital/wp-content/uploads/2023/06/telephone-auricular-with-cable.png" alt="Phone Icon" width="20"></a>
                                                  <strong>01763872217</strong>
                                              </td>
                                          </tr>
                                      </table>
                                  </td>
                              </tr>
                          </table>
                      </td>
                  </tr> -->
                <tr>
                    <td style="text-align: center; padding: 10px 0px">
                        <a href="{{ $theme->url }}"><img src="{{ $domain . '/public/assets/img/' . $theme->logo }}"
                                alt="" width="140" /></a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 20px 0">
                        <p>Congratulations, <strong>{{ $name }}</strong>!</p>
                        <p>
                            Your team from <b>{{ $organization }}</b> has been successfully formed for
                            <b>{{ Config::get('app.name') }}</b>.
                            Your current team size is <b>{{ $member_count }}</b>. Below is the updated team
                            information:
                        </p>
                        @if (count($members_array) > 0)
                            <table width="100%" style="border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid black; padding: 8px; background-color: #f4f4f4;">
                                            Name</th>
                                        <th style="border: 1px solid black; padding: 8px; background-color: #f4f4f4;">
                                            Email</th>
                                        <th style="border: 1px solid black; padding: 8px; background-color: #f4f4f4;">
                                            Designation</th>
                                        <th style="border: 1px solid black; padding: 8px; background-color: #f4f4f4;">
                                            Contact</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid black; padding: 8px">{{ $name }}
                                            <strong>(Team Lead)</strong>
                                        </td>
                                        <td style="border: 1px solid black; padding: 8px">{{ $email }}</td>
                                        <td style="border: 1px solid black; padding: 8px">{{ $designation }}</td>
                                        <td style="border: 1px solid black; padding: 8px">{{ $phone }}</td>
                                    </tr>
                                    @foreach ($members_array as $member)
                                        <tr>
                                            <td style="border: 1px solid black; padding: 8px">
                                                {{ $member->member_name }}</td>
                                            <td style="border: 1px solid black; padding: 8px">
                                                {{ $member->member_email }}</td>
                                            <td style="border: 1px solid black; padding: 8px">
                                                {{ $member->member_designation }}</td>
                                            <td style="border: 1px solid black; padding: 8px">
                                                {{ $member->member_contact }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                        <p>
                            If you need any assistance or further modifications, feel free to reach out to us.
                        </p>
                        <p>
                            <strong>EMAIL: </strong>reach@innovationconclavebd.com
                        </p>
                        <p>
                            <strong>MOBILE: </strong>+880 1953-991665, +880 1835-858601
                        </p>
                        <p>Best regards,<br /><strong>Team {{ Config::get('app.name') }}</strong></p>
                    </td>
                </tr>

            </table>
        </div>
    </center>
    <table width="100%" class="footer">
        <tr>
            <td style="text-align: center; padding: 10px 0px">
                <h3>Follow our events and news on our social networks</h3>
                <a href="https://www.facebook.com/aihackathonbd/" class="fa"><img
                        src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180519/facebook.png"
                        alt="Facebook"></a>

                <a href="https://www.linkedin.com/company/ai-hackathon" class="fa"><img
                        src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180515/linkedin.png"
                        alt="Linkedin"></a>

                <a href="https://www.instagram.com/bdinnovationconclave/" class="fa"><img
                        src="https://cdn.bbf.digital/wp-content/uploads/2024/09/22180521/instagram.png"
                        alt="Instagram"></a>



                <p>© {{ now()->year }} Bangladesh Innovation Conclave. All rights reserved.</p>
            </td>
        </tr>
    </table>
</body>

</html>
