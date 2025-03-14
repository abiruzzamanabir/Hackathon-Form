@php
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    $rate_2 = getenv('RATE_2');
    $rate_3 = getenv('RATE_3');
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration Form | {{ $theme->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <style>
        body {
            background-color: #f2f2f2;
            background-image: url("{{ asset('assets/img/' . $theme->background) }}");
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
    {{-- @include('partials.header') --}}
    <div class="container shadow">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-12">
                @if (env('SSLCZ_STORE_ID') === 'bangl6362104f9019c' && env('SSLCZ_STORE_PASSWORD') === 'bangl6362104f9019c@ssl')
                    <p class="badge bg-success p-1">⚪ Test Mode</p>
                @else
                    <!-- <p class="badge bg-danger p-1">⚪ Live</p> -->
                @endif

                {{-- <div class="card-header text-center bg-light rounded-top">
                    <!-- Logo and Link Section -->
                    <a href="{{ $theme->url }}">
                        <img width="150px" src="{{ asset('assets/img/' . $theme->logo) }}" alt="Theme Logo"
                            class="mb-0">
                    </a>
                    <!-- Countdown Timer Section -->
                    <div class="time py-3 rounded-lg" id="countdown">
                        <!-- Countdown content will go here -->
                    </div>
                </div> --}}

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
                                <form action="{{ route('info.update', Auth::user()->email) }}" method="POST"
                                    class="was-validated">
                                    @csrf
                                    @method('PUT')
                                    <u>
                                        <h5 class="text-center text-uppercase">Update Your Information</h5>
                                    </u>
                                    <div class="border p-3 shadow my-3">
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Team Name <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="team_name" class="form-control"
                                                @if (Auth::user()->team_name) value="{{ Auth::user()->team_name }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Team Name</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="category" class="form-label">
                                                <b>Category <span class="text-danger">*</span></b>
                                            </label>
                                            <select name="category" class="form-control" id="category" required
                                                @if (Auth::user()->isUpdated) disabled @endif>
                                                <option value="" disabled selected>Select Your Category</option>

                                                <option
                                                    value="City Problems – Traffic Congestion, Waste Management, Pollution Control, Smart Infrastructure"
                                                    @if (Auth::user()->category ==
                                                            'City Problems – Traffic Congestion, Waste Management, Pollution Control, Smart Infrastructure') selected @endif>City Problems –
                                                    Traffic Congestion, Waste Management, Pollution Control, Smart
                                                    Infrastructure</option>

                                                <option
                                                    value="Manufacturing – Process Optimization, Automation, Quality Control, Supply Chain Efficiency"
                                                    @if (Auth::user()->category ==
                                                            'Manufacturing – Process Optimization, Automation, Quality Control, Supply Chain Efficiency') selected @endif>
                                                    Manufacturing – Process Optimization, Automation, Quality Control,
                                                    Supply Chain Efficiency
                                                </option>

                                                <option
                                                    value="Education – AI-Driven Personalized Learning, Accessibility, Content Curation, Skill Development"
                                                    @if (Auth::user()->category ==
                                                            'Education – AI-Driven Personalized Learning, Accessibility, Content Curation, Skill Development') selected @endif>
                                                    Education – AI-Driven Personalized Learning, Accessibility, Content
                                                    Curation, Skill Development
                                                </option>

                                                <option
                                                    value="Agriculture – Smart Farming, Predictive Analytics, Irrigation Solutions, Pest Control"
                                                    @if (Auth::user()->category == 'Agriculture – Smart Farming, Predictive Analytics, Irrigation Solutions, Pest Control') selected @endif>
                                                    Agriculture – Smart Farming, Predictive Analytics, Irrigation
                                                    Solutions, Pest Control
                                                </option>

                                                <option
                                                    value="Fintech – Financial Inclusion, Fraud Detection, AI-Driven Credit Scoring, Secure Transactions"
                                                    @if (Auth::user()->category ==
                                                            'Fintech – Financial Inclusion, Fraud Detection, AI-Driven Credit Scoring, Secure Transactions') selected @endif>
                                                    Fintech – Financial Inclusion, Fraud Detection, AI-Driven Credit
                                                    Scoring, Secure Transactions
                                                </option>

                                                <option
                                                    value="Healthcare – AI-Driven Diagnosis, Remote Patient Monitoring, Predictive Analytics, and Smart Healthcare Systems"
                                                    @if (Auth::user()->category ==
                                                            'Healthcare – AI-Driven Diagnosis, Remote Patient Monitoring, Predictive Analytics, and Smart Healthcare Systems') selected @endif>
                                                    Healthcare – AI-Driven Diagnosis, Remote Patient Monitoring,
                                                    Predictive Analytics, and Smart Healthcare Systems
                                                </option>

                                            </select>

                                            <div class="invalid-feedback text-uppercase">Enter Your Team Name</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Institution / Organization <span class="text-danger">*</span></b>
                                            </label>
                                            <input list="organization" type="text" name="organization"
                                                class="form-control"
                                                @if (Auth::user()->organization) value="{{ Auth::user()->organization }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Institution /
                                                Organization Name
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Full Name <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="name" class="form-control"
                                                @if (Auth::user()->name) value="{{ Auth::user()->name }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Full Name</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationEmail" class="form-label">
                                                <b>Email <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="email" readonly name="email" class="form-control"
                                                @if (Auth::user()->email) value="{{ Auth::user()->email }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Email</div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Phone Number <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="phone" class="form-control"
                                                @if (Auth::user()->phone) value="{{ Auth::user()->phone }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Phone Number
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationName" class="form-label">
                                                <b>Role / Designation <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="designation" class="form-control"
                                                @if (Auth::user()->designation) value="{{ Auth::user()->designation }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Role / Designation
                                            </div>
                                        </div>
                                        <div class="mb-2">
                                            <label for="validationPhone" class="form-label">
                                                <b>Address <span class="text-danger">*</span></b>
                                            </label>
                                            <input type="text" name="address" class="form-control"
                                                @if (Auth::user()->address) value="{{ Auth::user()->address }}" @endif
                                                @if (Auth::user()->isUpdated == true) disabled @endif required>
                                            <div class="invalid-feedback text-uppercase">Enter Your Address</div>
                                        </div>

                                    </div>
                                    <u>
                                        <h5 class="text-center text-uppercase">Team Member</h5>
                                    </u>
                                    <p class="text-center text-muted">Detail Information About Your Team Member</p>
                                    <div class="border p-3 shadow my-3">
                                        <div class="my-4">
                                            <div class="form-group order member-btn-opt">
                                                <div class="member-btn-opt-area">
                                                    @php
                                                        $members = json_decode(Auth::user()->members, true);
                                                        $total_members = isset($members) ? count($members) : 0;
                                                        $initial_members = max($total_members, 2); // Ensure at least 2 members
                                                    @endphp

                                                    @for ($i = 0; $i < $initial_members; $i++)
                                                        @php $member = $members[$i] ?? null; @endphp
                                                        <div class="btn-section">
                                                            <div class="d-flex justify-content-between">
                                                                <b>Member {{ $i + 1 }}</b>
                                                                @if ($i >= 2)
                                                                    <span style="cursor: pointer"
                                                                        class="bg-danger px-2 py-1 rounded text-white remove-btn">Remove
                                                                        <i class="fas fa-times"></i></span>
                                                                @endif
                                                            </div>

                                                            <input name="member_name[]" required
                                                                class="form-control my-3" type="text"
                                                                value="{{ $member['member_name'] ?? '' }}"
                                                                placeholder="Full Name">

                                                            <input name="member_email[]" required
                                                                class="form-control my-3" type="text"
                                                                value="{{ $member['member_email'] ?? '' }}"
                                                                placeholder="Email">

                                                            <input name="member_contact[]" required
                                                                class="form-control my-3" type="text"
                                                                value="{{ $member['member_contact'] ?? '' }}"
                                                                placeholder="Phone">

                                                            <input name="member_designation[]" required
                                                                class="form-control my-3" type="text"
                                                                value="{{ $member['member_designation'] ?? '' }}"
                                                                placeholder="Role / Designation">
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                            <button id="add-new-member-button" class="btn btn-primary">Add
                                                Member</button>
                                        </div>
                                    </div>

                                    <div class="mt-2 text-center">
                                        @if (Auth::user()->isUpdated)
                                            <a class="btn btn-primary text-uppercase"
                                                href="{{ route('form.index') }}">Go TO
                                                Submission Form</a>
                                        @else
                                            <button style="width: 120px;" type="submit"
                                                class="btn btn-primary text-uppercase">Submit</button>
                                        @endif

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
                        {{-- @include('nomination.edit') --}}
                    @endif
                </div>
                <div class="card-footer text-muted text-center">
                    @include('footer')
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (!Auth::user()->isUpdated)
            Swal.fire({
                title: "Warning",
                text: "You can update your information only once. After submission, further modifications will not be possible. Please review your details carefully before proceeding.",
                icon: "warning"
            });
        @endif


        $(document).ready(function() {
            let initialMembers = 2;
            let maxAdditionalMembers = 2;
            let btn_no = $(".member-btn-opt-area .btn-section").length + 1;

            // Ensure initial 2 members are present
            for (let i = $(".member-btn-opt-area .btn-section").length; i < initialMembers; i++) {
                addNewMember();
            }

            // Check if the "Add Member" button should be visible or not
            toggleAddMemberButton();

            $("#add-new-member-button").click(function(e) {
                e.preventDefault();
                if ($(".member-btn-opt-area .btn-section").length < initialMembers + maxAdditionalMembers) {
                    addNewMember();
                    toggleAddMemberButton(); // Hide the button if 4 members are reached
                }
            });

            $(document).on("click", ".remove-btn", function() {
                if ($(".member-btn-opt-area .btn-section").length > initialMembers) {
                    $(this).closest(".btn-section").remove();
                    updateMemberNumbers();
                    toggleAddMemberButton(); // Show the button again if the member count is less than 4
                }
            });

            function addNewMember() {
                let memberHTML = `
        <div class="btn-section">
            <div class="d-flex justify-content-between">
                <b>Member ${btn_no}</b>
                <span class="bg-danger px-2 py-1 rounded text-white remove-btn" style="cursor: pointer;">Remove <i class="fas fa-times"></i></span>
            </div>
            <input name="member_name[]" required class="form-control my-3" type="text" placeholder="Full Name">
            <input name="member_email[]" required class="form-control my-3" type="text" placeholder="Email">
            <input name="member_contact[]" required class="form-control my-3" type="text" placeholder="Phone">
            <input name="member_designation[]" required class="form-control my-3" type="text" placeholder="Role / Designation">

        </div>`;

                $(".member-btn-opt-area").append(memberHTML);
                btn_no++;
            }

            function updateMemberNumbers() {
                $(".member-btn-opt-area .btn-section").each(function(index) {
                    $(this).find("b:first-child").text(`Member ${index + 1}`);
                });
                btn_no = $(".member-btn-opt-area .btn-section").length + 1;
            }

            // Function to toggle the visibility of the "Add Member" button
            function toggleAddMemberButton() {
                if ($(".member-btn-opt-area .btn-section").length >= 4) {
                    $("#add-new-member-button").hide();
                } else {
                    $("#add-new-member-button").show();
                }
            }
        });
    </script>
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
                    var words = this.value.match(/\S+/g) ? this.value.match(/\S+/g).length : 0;
                    if (words > section.maxLength) {
                        var trimmed = $(this).val().split(/\s+/, section.maxLength).join(" ");
                        $(this).val(trimmed + " ");
                    } else {
                        $(section.displayId).text(words);
                        $(section.wordLeftId).text(section.maxLength - words);
                        if (words > 0) {
                            $(section.countId).removeClass('d-none');
                        } else {
                            $(section.countId).addClass('d-none');
                        }
                    }
                });
            });

            // Set timeout to fade out and remove alerts
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function() {
                    $(this).remove();
                });
            }, 3000);
        });
    </script>





    {{-- <script>
        $(document).ready(function() {
            alert('jQuery is working');

            let initialMembers = 2;
            let maxAdditionalMembers = 2;
            let btn_no = $(".member-btn-opt-area .btn-section").length + 1;

            // Ensure initial 2 members are present
            for (let i = $(".member-btn-opt-area .btn-section").length; i < initialMembers; i++) {
                addNewMember();
            }

            $("#add-new-member-button").click(function(e) {
                e.preventDefault();
                if ($(".member-btn-opt-area .btn-section").length < initialMembers + maxAdditionalMembers) {
                    addNewMember();
                }
            });

            $(document).on("click", ".remove-btn", function() {
                if ($(".member-btn-opt-area .btn-section").length > initialMembers) {
                    $(this).closest(".btn-section").remove();
                    updateMemberNumbers();
                }
            });

            function addNewMember() {
                let memberHTML = `
            <div class="btn-section">
                <div class="d-flex justify-content-between">
                    <b>Member ${btn_no}</b>
                    <span class="bg-danger px-2 py-1 rounded text-white remove-btn" style="cursor: pointer;">Remove <i class="fas fa-times"></i></span>
                </div>
                <input name="member_name[]" required class="form-control my-3" type="text" placeholder="Full Name">
                <input name="member_designation[]" required class="form-control my-3" type="text" placeholder="Designation">
                <input name="member_organization[]" required class="form-control my-3" type="text" placeholder="Organization">
                <input name="member_contact[]" required class="form-control my-3" type="text" placeholder="Contact">
                <input name="member_email[]" required class="form-control my-3" type="text" placeholder="Email">
            </div>`;

                $(".member-btn-opt-area").append(memberHTML);
                btn_no++;
            }

            function updateMemberNumbers() {
                $(".member-btn-opt-area .btn-section").each(function(index) {
                    $(this).find("b:first-child").text(`Member ${index + 1}`);
                });
                btn_no = $(".member-btn-opt-area .btn-section").length + 1;
            }
        }

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
    </script> --}}
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
    {{-- @include('kill') --}}
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
