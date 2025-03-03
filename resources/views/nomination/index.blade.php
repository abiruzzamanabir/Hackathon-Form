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
                <div class="card shadow">
                    @php
                        use Carbon\Carbon;
                        $time = Carbon::parse($theme->close);
                        $close = $time;
                    @endphp
                    @if ($form_type == 'store')
                        @if (Carbon::now() <= $close)
                            <div class="card-body">
                                @include('partials.header')
                                @include('validate')
                                <form action="{{ route('form.store') }}" method="POST" class="was-validated">
                                    @csrf
                                    <u>
                                        <h5 class="text-center text-uppercase">Case Submission Form</h5>
                                    </u>
                                    <p class="text-center">Please Fill The Form</p>
                                    <div class="border p-3 shadow my-3">
                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Background <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="backgroundcount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_backgroundcount">0</span> | Word Left:
                                                <span id="backgroundword_left">200</span>
                                            </p>
                                            <textarea name="background" id="background" class="form-control" cols="10" rows="3"
                                                placeholder="A concise description of the context of how the innovation was designed (problem statement). (Not more than 50 words)"
                                                value="{{ old('background') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Background</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Objective <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="objectivecount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_objectivecount">0</span> | Word Left:
                                                <span id="objectiveword_left">200</span>
                                            </p>
                                            <textarea name="objective" id="objective" class="form-control" cols="10" rows="3"
                                                placeholder="Define specific objectives of the Innovation in the given amount of time and highlight other important factors relative to its success. (Not more than 50 words)"
                                                value="{{ old('objective') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Objective</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Vision <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="visioncount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_visioncount">0</span> | Word Left: <span
                                                    id="visionword_left">200</span>
                                            </p>
                                            <textarea name="vision" id="vision" class="form-control" cols="10" rows="3"
                                                placeholder="What is the long-term vision of this innovation? (Not more than 50 words)" value="{{ old('vision') }}"
                                                required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Vision</div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Innovation Idea <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="ideacount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_ideacount">0</span> | Word Left: <span
                                                    id="ideaword_left">200</span>
                                            </p>
                                            <textarea name="idea" id="idea" class="form-control" cols="10" rows="3"
                                                placeholder="What was the Innovation idea/concept of the innovation? (Not more than 150 words)"
                                                value="{{ old('idea') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Innovation Idea
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Execution <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="executioncount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_executioncount">0</span> | Word Left:
                                                <span id="executionword_left">200</span>
                                            </p>
                                            <textarea name="execution" id="execution" class="form-control" cols="10" rows="3"
                                                placeholder="Describe the strategy implied and how it was executed. What were the challenges in execution and how were they addressed? (Not more than 150 words)"
                                                value="{{ old('execution') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Execution Plan
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Value Addition <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="value_additioncount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_value_additioncount">0</span> | Word
                                                Left: <span id="value_additionword_left">200</span>
                                            </p>
                                            <textarea name="value_addition" id="value_addition" class="form-control" cols="10" rows="3"
                                                placeholder="How has the innovation added to the wellbeing of society/organization/nation? (Not more than 75 words)"
                                                value="{{ old('value_addition') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Value Addition
                                            </div>
                                        </div>

                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Result/Impact <span
                                                        class="text-danger">*</span></b></label>
                                            <p id="resultcount" class="text-left text-center mb-1 d-none"
                                                style="font-size: 10px;">
                                                Word Count: <span id="display_resultcount">0</span> | Word Left: <span
                                                    id="resultword_left">200</span>
                                            </p>
                                            <textarea name="result" id="result" class="form-control" cols="10" rows="3"
                                                placeholder="What was/were the result/impact of the innovation? What are some of the measures of success? (Not more than 100 words)"
                                                value="{{ old('result') }}" required></textarea>
                                            <div class="invalid-feedback text-uppercase">Enter Your Result/Impact</div>
                                        </div>


                                        <div class="my-2">
                                            <label for="validationPhone" class="form-label"><b>Supporting Documents
                                                    Google Drive Link <span class="text-danger">*</span></b></label>
                                            <textarea name="link" class="form-control" cols="10" rows="3"
                                                placeholder="Paste the Google Drive Link Here. (Upload the necessary materials in a folder and share the link here. The contents must include: PPT, Visuals, NOC, Innovation AV and any other supporting documents)"
                                                value="{{ old('link') }}" required></textarea>
                                            <p class="text-danger mt-1">Disclaimer: Without proper supporting documents
                                                nomination will be disqualified.</p>
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
                    id: "#background",
                    displayId: "#display_backgroundcount",
                    wordLeftId: "#backgroundword_left",
                    countId: "#backgroundcount",
                    maxLength: 50
                },
                {
                    id: "#objective",
                    displayId: "#display_objectivecount",
                    wordLeftId: "#objectiveword_left",
                    countId: "#objectivecount",
                    maxLength: 50
                },
                {
                    id: "#vision",
                    displayId: "#display_visioncount",
                    wordLeftId: "#visionword_left",
                    countId: "#visioncount",
                    maxLength: 50
                },
                {
                    id: "#idea",
                    displayId: "#display_ideacount",
                    wordLeftId: "#ideaword_left",
                    countId: "#ideacount",
                    maxLength: 150
                },
                {
                    id: "#execution",
                    displayId: "#display_executioncount",
                    wordLeftId: "#executionword_left",
                    countId: "#executioncount",
                    maxLength: 150
                },
                {
                    id: "#value_addition",
                    displayId: "#display_value_additioncount",
                    wordLeftId: "#value_additionword_left",
                    countId: "#value_additioncount",
                    maxLength: 75
                },
                {
                    id: "#result",
                    displayId: "#display_resultcount",
                    wordLeftId: "#resultword_left",
                    countId: "#resultcount",
                    maxLength: 100
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
