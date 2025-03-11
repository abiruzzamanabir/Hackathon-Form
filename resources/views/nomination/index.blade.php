@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nomination Form | {{ $theme->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url('{{ asset('assets/img/' . $theme->background) }}');
        }

        .container {
            max-width: 700px;
            padding: 20px;
            margin: 40px auto;
            background-color: #f2f2f2;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .border {
            border-radius: 15px;
        }

        .form-control {
            background-color: #f2f2f2;
            border: none;
            border-radius: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .form-control:focus {
            outline: none;
            box-shadow: inset 4px 4px 4px rgba(0, 0, 0, 0.1), inset -4px -4px 4px rgba(255, 255, 255, 0.5);
        }

        .btn-primary {
            background-color: #65a9e6;
            border-color: #65a9e6;
            border-radius: 10px;
            box-shadow: 6px 6px 6px rgba(0, 0, 0, 0.1), -6px -6px 6px rgba(255, 255, 255, 0.5);
        }

        .btn-primary:hover {
            background-color: #5593cd;
            border-color: #5593cd;
        }

        .card {
            background-color: #f2f2f2;
            border: none;
            border-radius: 15px;
            /* box-shadow: 10px 10px 20px rgba(0, 0, 0, 0.1), -10px -10px 20px rgba(255, 255, 255, 0.5); */
        }

        .card-header {
            background-color: #f2f2f2;
            border-bottom: none;
        }

        .card-body {
            padding: 20px;
        }

        .card-footer {
            background-color: #f2f2f2;
            border-top: none;
            border-radius: 0 0 15px 15px;
        }

        h5 {
            color: #333;
        }

        label {
            color: #555;
        }

        .count {
            font-size: 10px;
            box-shadow: inset 6px 6px 6px rgba(0, 0, 0, 0.1), inset -6px -6px 6px rgba(255, 255, 255, 0.5);
            display: block;
            text-align: center;
            margin: 5px auto 20px !important;
            width: 30%;
            padding: 5px;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container shadow">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                @php
                    use Carbon\Carbon;
                    $time = Carbon::parse($theme->close);
                    $close = $time;
                @endphp
                @if (Auth::user()->isSubmitted == true)
                    <div class="card shadow">
                        <div class="card-header">
                            @include('partials.header')
                            <h2 class="text-center">Thank You Team <span
                                    class="text-muted text-capitalize">{{ Auth::user()->team_name }}</span> !</h2>
                        </div>
                        <div class="card-body text-center">
                            <h4 class="mb-2 text-success">Your submission has been successfully received!</h4>
                            <p class="text-muted">We appreciate your contribution. Your submission is complete, and
                                we will review it shortly.</p>
                        </div>

                    </div>
                @else
                    <div class="card shadow">

                        @if ($form_type == 'store')
                            @if (Carbon::now() <= $close)
                                <div class="card-body">
                                    @include('partials.header')
                                    @include('validate')
                                    <form action="{{ route('form.update', Auth::user()->email) }}" method="POST"
                                        class="was-validated">
                                        @csrf
                                        @method('PUT')
                                        <u>
                                            <h5 class="text-center text-uppercase">Case Submission Form</h5>
                                        </u>
                                        <p class="text-center">Please Fill The Form</p>
                                        <div class="border p-3 shadow my-3">
                                            <div class="my-2">
                                                <label for="problem" class="form-label"><b>Problem Statement <span
                                                            class="text-danger">*</span></b></label>
                                                <p id="problemcount" class="text-left text-center mb-1 d-none"
                                                    style="font-size: 10px;">
                                                    Word Count: <span id="display_problemcount">0</span> | Word Left:
                                                    <span id="problemword_left">300</span>
                                                </p>
                                                <textarea name="problem" id="problem" class="form-control" cols="10" rows="5"
                                                    placeholder="Describe the problem your AI-based solution aims to solve. (Max 300 words)" required></textarea>
                                                <div class="invalid-feedback text-uppercase">Enter Problem Statement
                                                </div>
                                            </div>

                                            <div class="my-2">
                                                <label for="solution" class="form-label"><b>AI-Based Solution Brief
                                                        <span class="text-danger">*</span></b></label>
                                                <p id="solutioncount" class="text-left text-center mb-1 d-none"
                                                    style="font-size: 10px;">
                                                    Word Count: <span id="display_solutioncount">0</span> | Word Left:
                                                    <span id="solutionword_left">500</span>
                                                </p>
                                                <textarea name="solution" id="solution" class="form-control" cols="10" rows="6"
                                                    placeholder="Provide a brief explanation of your AI-based solution. (Max 500 words)" required></textarea>
                                                <div class="invalid-feedback text-uppercase">Enter AI-Based Solution
                                                    Brief
                                                </div>
                                            </div>

                                            <div class="my-2">
                                                <label for="benefits" class="form-label"><b>Expected Outcomes & Benefits
                                                        <span class="text-danger">*</span></b></label>
                                                <p id="outcomecount" class="text-left text-center mb-1 d-none"
                                                    style="font-size: 10px;">
                                                    Word Count: <span id="display_outcomecount">0</span> | Word Left:
                                                    <span id="outcomeword_left">300</span>
                                                </p>
                                                <textarea name="benefits" id="benefits" class="form-control" cols="10" rows="5"
                                                    placeholder="Describe the expected outcomes and benefits of your solution. (Max 300 words)" required></textarea>
                                                <div class="invalid-feedback text-uppercase">Enter Expected Outcomes &
                                                    Benefits</div>
                                            </div>

                                            <div class="my-2">
                                                <label for="file" class="form-label"><b>Additional File Upload
                                                        <span class="text-danger">*</span></b></label>

                                                <input type="text" name="file" id="file" class="form-control"
                                                    placeholder="Paste the Google Drive Link containing all required files."
                                                    required>
                                                <p class="text-danger mt-1">Upload the necessary materials in a folder
                                                    and
                                                    share the link. The contents must include:</p>
                                                <ul>
                                                    <li>Presentation Deck (given format)</li>
                                                    <li>Valid Photo ID card of Each Participant</li>
                                                </ul>
                                            </div>

                                            <div class="my-2">
                                                <label class="form-label"><b>Declaration & Consent <span
                                                            class="text-danger">*</span></b></label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="consent1"
                                                        required>
                                                    <label class="form-check-label" for="consent1">We confirm that all
                                                        the
                                                        information provided is accurate.</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="consent2"
                                                        required>
                                                    <label class="form-check-label" for="consent2">We agree to abide
                                                        by
                                                        the hackathon rules and guidelines.</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="consent3"
                                                        required>
                                                    <label class="form-check-label" for="consent3">We consent to the
                                                        use
                                                        of our data for hackathon-related communications.</label>
                                                </div>
                                            </div>

                                            <div class="mt-2 text-center">
                                                <button style="width: 120px;" type="submit"
                                                    class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            @else
                                <div class="card-body">
                                    <h3 class="text-center text-danger">
                                        Nomination submission window is now closed.
                                    </h3>
                                </div>
                            @endif
                        @endif
                        @if ($form_type == 'edit')
                            @include('nomination.edit')
                        @endif
                    </div>
                @endif

                <div class="card-footer text-muted text-center">
                    @include('footer')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            var sections = [{
                    id: "#problem",
                    displayId: "#display_problemcount",
                    wordLeftId: "#problemword_left",
                    countId: "#problemcount",
                    maxLength: 300
                },
                {
                    id: "#solution",
                    displayId: "#display_solutioncount",
                    wordLeftId: "#solutionword_left",
                    countId: "#solutioncount",
                    maxLength: 500
                },
                {
                    id: "#benefits",
                    displayId: "#display_outcomecount",
                    wordLeftId: "#outcomeword_left",
                    countId: "#outcomecount",
                    maxLength: 300
                }
            ];

            sections.forEach(function(section) {
                $(section.id).on('input', function() {
                    var words = this.value.match(/\S+/g).length;
                    if (words > section.maxLength) {
                        var trimmed = $(this).val().split(/\s+/, section.maxLength).join(" ");
                        $(this).val(trimmed + " ");
                    } else {
                        $(section.displayId).text(words);
                        $(section.wordLeftId).text(section.maxLength - words);
                        if (words > 1) {
                            $(section.countId).removeClass('d-none');
                        } else if (words < 1) {
                            $(section.countId).addClass('d-none');
                        } else {
                            $(section.countId).addClass('d-none');
                        }
                    }
                });
            });
        });

        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    @php
        $databaseDatetime = strtotime($theme->close);

        // Calculate time remaining
        $currentDatetime = time();
        $timeRemaining = $databaseDatetime - $currentDatetime;

        // Send the time remaining to the client-side JavaScript
        echo '<script>
            var timeRemaining = ' . $timeRemaining . ';
        </script>';
    @endphp
    <script>
        // Receive the time remaining value from the server-side code
        var timeRemaining = <?php echo $timeRemaining; ?>;

        // Function to update the countdown timer
        function updateCountdown() {
            if (timeRemaining <= 0) {
                // The countdown has expired, you can handle this case here
                if (timeRemaining == 0) {
                    location.reload();
                }
            } else {
                var hours = Math.floor(timeRemaining / 3600);
                var minutes = Math.floor((timeRemaining % 3600) / 60);
                var seconds = timeRemaining % 60;
                var h = hours > 1 ? 'hours ' : 'hour ';
                var hz = hours < 10 ? '0' : '';
                var m = minutes > 1 ? 'minutes ' : 'minute ';
                var mz = minutes < 10 ? '0' : '';
                var s = seconds > 1 ? 'seconds ' : 'second ';
                var sz = seconds < 10 ? '0' : '';
                if (timeRemaining <= 86400) {
                    document.getElementById('countdown').innerHTML = '<p>Time Remain: ' + '<span>' + hz + hours + ' ' +
                        ': ' + '</span>' + '<span>' + mz + minutes + ' ' + ': ' + '</span>' + '<span>' + sz + seconds +
                        '</p>';
                }
                timeRemaining--;
                setTimeout(updateCountdown, 1000); // Update the countdown every second
            }
        }

        // Start the countdown
        updateCountdown();
    </script>
    @include('kill')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
