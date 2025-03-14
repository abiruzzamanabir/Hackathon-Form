@php
    use Rmunate\Utilities\SpellNumber;
    use App\Models\Theme;
    $theme = Theme::findOrFail(1);
    $amount = $theme->amount;
    $vat = $theme->amount * 0.15;
    $total = $amount + $vat;
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>Case Submission Answerscript</title>
    <style type="text/css">
        @page {
            margin: 2cm;
        }

        body {
            font-family: 'Roboto Condensed', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 28px;
            color: #0056b3;
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .section-header {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
            text-decoration: underline;
            text-align: center;
        }

        .section-content {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f9f9f9;
            border: 1px solid #d2d2d2;
            border-radius: 5px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        footer {
            border-top: 1px solid #d2d2d2;
            margin-top: 40px;
            padding: 10px 0;
            background-color: #f4f4f4;
            text-align: center;
            font-size: 12px;
            color: #333;
        }

        .line-break {
            border-bottom: 2px solid #d2d2d2;
            margin: 20px 0;
        }

        .section-content p {
            margin: 0;
        }
    </style>
</head>

<body>

    <h1>Case Submission Answerscript</h1>

    <!-- Problem Section -->
    <div class="content-section">
        <div class="section-header">Problem</div>
        <div class="section-content">
            <p>{{ $problem }}</p>
        </div>
    </div>

    <div class="line-break"></div>

    <!-- Solution Section -->
    <div class="content-section">
        <div class="section-header">Solution</div>
        <div class="section-content">
            <p>{{ $solution }}</p>
        </div>
    </div>

    <div class="line-break"></div>

    <!-- Benefits Section -->
    <div class="content-section">
        <div class="section-header">Benefits</div>
        <div class="section-content">
            <p>{{ $benefits }}</p>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} {{ Config::get('app.name') }}. All Rights Reserved.</p>
    </footer>

</body>

</html>
