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
    <title>
        @if ($page == 'dashboard')
            Dashboard
        @elseif($page == 'block')
            Blocked User
        @else
            Payment Verified
        @endif
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.css" />
    <script src="https://use.fontawesome.com/b477068b8c.js"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/' . $theme->favicon) }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background-color: #f1f1f1;
            background-image: url('{{ asset(' assets/img/' . $theme->background) }}');
        }

        .container-fluid {
            background-color: #f1f1f1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
        }

        .container {
            background-color: #f1f1f1;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
        }

        .card {
            background-color: #fff;
            box-shadow: 8px 8px 16px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: none;
        }

        .card-header {
            background-color: #f1f1f1;
            border-radius: 10px;
            border-bottom: 1px solid #e1e1e1;
        }

        .card-body {
            background-color: #f1f1f1;
            border-radius: 10px;
        }

        .btn {
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table {
            border-radius: 10px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
        }

        .badge {
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .btnsize {
            width: 20px;
            height: 20px;
            padding: 0;
            border-radius: 50%;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        textarea {
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            box-shadow: 4px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 8px;
        }

        .btn-info {
            background-color: #58a3f7;
            color: #fff;
        }

        .btn-danger {
            background-color: #f15151;
            color: #fff;
        }

        .btn-success {
            background-color: #4caf50;
            color: #fff;
        }

        .btn-info:hover,
        .btn-info:focus {
            background-color: #4f93d6;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            background-color: #e04343;
        }

        .btn-success:hover,
        .btn-success:focus {
            background-color: #47a847;
        }
    </style>

</head>

<body>
    @if (session('authenticatedDashboard'))
        <div class="container-fluid">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-md-12">
                    <div class="card-header">
                        @if ($page == 'dashboard')
                            <a href="{{ route('block.user') }}" class="btn btn-primary">
                                Block user <span class="badge bg-light text-dark">{{ $count }} </span>
                            </a>
                        @else
                            <a href="{{ route('dashboard.index') }}" class="btn btn-primary">
                                Dashboard <span class="badge bg-light text-dark">{{ $count }}</span>
                            </a>
                        @endif
                    </div>

                    <div class="card">

                        <div class="card-body overflow-auto">
                            @include('validate')
                            <table style="text-align: center" id="dashboard" class="table table-striped table-bordered">
                                <thead>
                                    <tr class="table-info">
                                        <th scope="col">#</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Team Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Organization</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Team Members</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Problem</th>
                                        <th scope="col">Solution</th>
                                        <th scope="col">Outcomes</th>
                                        <th scope="col">Files</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_nomination as $item)
                                        <tr>
                                            <th onclick="copyUserId('{{ $item->ukey }}')"
                                                @if (!empty($item->comment)) style="background-color: #fadbd8"
                                        @else @endif
                                                scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{{ date('l, F j, Y, g:i A', strtotime($item->created_at)) }}</td>
                                            <td>{{ $item->team_name }}</td>
                                            <td>{{ $item->category }}</td>
                                            <td>{{ $item->organization }}</td>
                                            <td class="text-capitalize">{{ $item->name }}
                                                @if ($item->avatar)
                                                    <img style="width: 50px" src="{{ $item->avatar }}" alt="icon">
                                                @endif
                                            </td>
                                            <td onclick="copyUserEmail('{{ $item->email }}')">{{ $item->email }}
                                                @if ($item->google_id)
                                                    <img style="width: 15px"
                                                        src="{{ asset('assets/img/google_icon.png') }}" alt="icon">
                                                @endif
                                            </td>
                                            <td>{{ $item->phone }}</td>
                                            <td>{{ $item->designation }}</td>
                                            <td>
                                                @php
                                                    $members = json_decode($item->members, true);
                                                @endphp

                                                @if (!empty($members) && is_array($members))
                                                    <ul class="list-group">
                                                        @foreach ($members as $member)
                                                            <li class="list-group-item shadow-sm rounded my-1">
                                                                <strong>Name:</strong> {{ $member['member_name'] }}<br>
                                                                <strong>Designation:</strong>
                                                                {{ $member['member_designation'] }}<br>
                                                                {{-- <strong>Organization:</strong>
                                                                {{ $member['member_organization'] }}<br> --}}
                                                                <strong>Contact:</strong>
                                                                {{ $member['member_contact'] }}<br>
                                                                <strong>Email:</strong> <a
                                                                    href="mailto:{{ $member['member_email'] }}">{{ $member['member_email'] }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <div class="alert-warning p-2 shadow-sm">
                                                        No members available.
                                                    </div>
                                                @endif
                                            </td>


                                            <td>{{ $item->address }}</td>
                                            <td>{{ $item->problem }}</td>
                                            <td>{{ $item->solution }}</td>
                                            <td>{{ $item->benefits }}</td>
                                            <td><a href="{{ $item->file }}" target="_blank">{{ $item->file }}</a>
                                            </td>
                                            {{-- <td>
                                                <a class="btn btn-sm btn-{{ $item->isBlocked ? 'success' : 'warning' }}"
                                                    href="{{ route('user.ban', $item->id) }}">
                                                    <i class="fa {{ $item->isBlocked ? 'fa-check' : 'fa-ban' }}"
                                                        aria-hidden="true"></i>
                                                </a>
                                            </td> --}}
                                            <td class="d-flex gap-1">
                                                @if ($item->phone)
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('whatsapp.message', ['phone' => $item->phone, 'name' => $item->name]) }}"
                                                        target="_blank">
                                                        <i class="fa fa-whatsapp" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                @if ($item->isUpdated)
                                                    <a class="btn btn-sm btn-primary" href="javascript:void(0);"
                                                        onclick="resetIsUpdated({{ $item->id }})">
                                                        <i class="fa fa-undo" aria-hidden="true"></i>
                                                    </a>
                                                @endif
                                                @if ($item->isSubmitted)
                                                    <a class="btn btn-sm btn-warning" href="javascript:void(0);"
                                                        onclick="resetIsSubmitted({{ $item->id }})">
                                                        <i class="fa fa-refresh" aria-hidden="true"></i>
                                                    </a>
                                                @endif

                                                <a class="btn btn-sm btn-{{ $item->isBlocked ? 'success' : 'danger' }}"
                                                    href="javascript:void(0);"
                                                    onclick="toggleBan({{ $item->id }}, this)">
                                                    <i class="fa {{ $item->isBlocked ? 'fa-check' : 'fa-ban' }}"
                                                        aria-hidden="true"></i>
                                                </a>
                                            </td>


                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer text-center">@include('footer')</div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-md-12">
                    <div class="card-header text-center">
                        <h3><u>Settings</u></h3>
                    </div>
                    <div class="card shadow">
                        <div class="card-body">
                            @include('validate')
                            <form action="{{ route('authenticate.dashboard') }}" method="POST" class="was-validated">
                                @csrf
                                <div class="border p-3 shadow my-3">
                                    <div class="mb-2">
                                        <label for="validationName" class="form-label">
                                            <b>Password</b> <span class="text-danger">*</span></b>
                                        </label>
                                        <input type="password" name="password" class="form-control"
                                            placeholder="Enter Password To View This Page" autofocus required>
                                    </div>
                                </div>
                                <div class="mt-2 text-center">
                                    <button style="width: 120px;" type="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-footer text-muted text-center">
                        @include('footer')
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script src="https://code.jquery.com/jquery-3.6.3.slim.min.js"
        integrity="sha256-ZwqZIVdD3iXNyGHbSYdsmWP//UBokj2FHAxKuSBKDSo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.13.2/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function toggleBan(userId, button) {
            // Send AJAX request to toggle block/unblock
            $.ajax({
                url: '{{ route('user.toggle.ban', ':id') }}'.replace(':id', userId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    // Update button UI based on response
                    if (response.isBlocked) {
                        $(button).removeClass('btn-warning').addClass('btn-success');
                        $(button).find('i').removeClass('fa-ban').addClass('fa-check');
                    } else {
                        $(button).removeClass('btn-success').addClass('btn-warning');
                        $(button).find('i').removeClass('fa-check').addClass('fa-ban');
                    }
                },
                error: function() {
                    alert('An error occurred while processing your request.');
                }
            });
        }

        function resetIsUpdated(userId) {
            $.ajax({
                url: '{{ route('user.reset.isupdated', ':id') }}'.replace(':id', userId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json', // Ensure the response is JSON
                success: function(response) {
                    if (response.success) {
                        alert('Updated successfully!');
                    } else {
                        alert('Failed to update: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    // Log the error for better debugging
                    console.error('Error Status:', status);
                    console.error('Error Message:', error);
                    console.error('Response:', xhr.responseText);
                    alert('An error occurred while processing your request. Please try again.');
                }
            });
        }

        function resetIsSubmitted(userId) {
            $.ajax({
                url: '{{ route('user.reset.issubmitted', ':id') }}'.replace(':id', userId),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                dataType: 'json', // Ensure the response is JSON
                success: function(response) {
                    if (response.success) {
                        alert('Updated successfully!');
                    } else {
                        alert('Failed to update: ' + (response.message || 'Unknown error'));
                    }
                },
                error: function(xhr, status, error) {
                    // Log the error for better debugging
                    console.error('Error Status:', status);
                    console.error('Error Message:', error);
                    console.error('Response:', xhr.responseText);
                    alert('An error occurred while processing your request. Please try again.');
                }
            });
        }
    </script>

    <script>
        var time = new Date().getTime();
        $(document.body).bind("mousemove keypress", function(e) {
            time = new Date().getTime();
        });

        function refresh() {
            if (new Date().getTime() - time >= 300000)
                window.location.reload(true);
            else if (new Date().getTime() - time >= 240000 && new Date().getTime() - time <= 246000) {
                let timerInterval
                Swal.fire({
                    title: 'Auto reload alert!',
                    html: 'I will reload in <b></b> milliseconds.',
                    timer: 54000,
                    allowOutsideClick: true,
                    showCancelButton: true,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        window.location.reload(true);
                    }
                })
            } else
                setTimeout(refresh, 10000);
        }

        setTimeout(refresh, 10000);
        $(document).ready(function() {
            $(".delete-form").submit(function(e) {
                let conf = confirm("Are you sure?");

                if (conf) {
                    return true;
                } else {
                    e.preventDefault();
                }
            });
            $('#dashboard').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 3000);
    </script>
    @if (session('authenticatedDashboard'))
    @else
        @include('kill')
    @endif
    <script>
        function copyUserId(userId) {
            var dummyInput = document.createElement('input');
            document.body.appendChild(dummyInput);
            dummyInput.setAttribute('value', userId);
            dummyInput.select();
            document.execCommand('copy');
            document.body.removeChild(dummyInput);
            // alert('User ID copied to clipboard: ' + userId);
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User ID copied to clipboard: ' + userId,
                showConfirmButton: false,
                timer: 2000
            })
        }

        function copyUserEmail(userEmail) {
            var dummyInput = document.createElement('input');
            document.body.appendChild(dummyInput);
            dummyInput.setAttribute('value', userEmail);
            dummyInput.select();
            document.execCommand('copy');
            document.body.removeChild(dummyInput);
            // window.location.href = "mailto:"+ userEmail;
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'User Email copied to clipboard: ' + userEmail,
                showConfirmButton: false,
                timer: 2000
            })
            // alert('User Email copied to clipboard: ' + userEmail);
        }
    </script>

</body>

</html>
