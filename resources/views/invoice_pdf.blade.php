@php
    use Rmunate\Utilities\SpellNumber;
    use App\Models\Theme;
    use Barryvdh\DomPDF\Facades\Pdf;

    $theme = Theme::findOrFail(1);
    $amount = $theme->amount;
    $vat = $theme->amount * 0.15;
    $total = $amount + $vat;

    $case_descriptions = [
        'City Problems – Traffic Congestion, Waste Management, Pollution Control, Smart Infrastructure' =>
            'Bangladesh’s rapid urbanization has led to significant challenges in city management, particularly in traffic congestion, inefficient waste disposal, rising pollution levels, and outdated infrastructure. AI can revolutionize urban planning by analyzing traffic patterns in real-time, optimizing public transportation schedules, and introducing smart traffic light systems that adjust dynamically based on congestion levels. In waste management, AI-driven automated sorting systems, route optimization for waste collection, and predictive maintenance of disposal units can enhance efficiency. AI-based air quality monitoring and pollution prediction models can help authorities take proactive steps in combating environmental degradation. Smart infrastructure solutions like AI-powered energy consumption tracking, building automation, and flood risk prediction systems can lead to more sustainable and resilient cities.',

        'Manufacturing – Process Optimization, Automation, Quality Control, Supply Chain Efficiency' =>
            'Bangladesh’s manufacturing sector is one of its economic pillars, yet it faces inefficiencies in production, quality control, and supply chain management. AI-driven predictive maintenance can prevent unexpected machinery failures, reducing downtime and increasing productivity. Computer vision-powered quality control systems can detect defects in real-time, ensuring higher product consistency while reducing waste. Automation using AI and robotics can enhance repetitive manufacturing processes, increasing precision and efficiency. AI-driven demand forecasting models can improve inventory management, helping businesses reduce excess stock while meeting market demand. Additionally, AI-powered logistics optimization can improve supply chain transparency, minimize delays, and cut down operational costs, making Bangladesh’s manufacturing sector more competitive on a global scale.',

        'Education – AI-Driven Personalized Learning, Accessibility, Content Curation, Skill Development' =>
            'Education in Bangladesh is undergoing a transformation, with a growing need for personalized and accessible learning solutions. AI-powered adaptive learning platforms can customize study plans based on students’ progress, learning speed, and weaknesses, ensuring better engagement and outcomes. AI chatbots and virtual assistants can provide 24/7 tutoring support, reducing dependency on traditional classroom settings. In special needs education, AI-powered speech recognition and text-to-speech tools can help students with disabilities access learning materials effectively. Automated content curation using AI can help educators create customized lesson plans, filtering out irrelevant information and focusing on contextual, high-quality content. Furthermore, AI-based career guidance systems can analyze students’ strengths and market trends to recommend personalized career paths and skill development programs, preparing them for the evolving job market.',

        'Agriculture – Smart Farming, Predictive Analytics, Irrigation Solutions, Pest Control' =>
            'Agriculture remains a crucial sector in Bangladesh’s economy, but climate change, resource mismanagement, and outdated farming techniques threaten its sustainability.AI can empower farmers with predictive analytics models that analyze weather patterns, soil quality, and crop health to optimize planting and harvesting schedules. Smart irrigation systems powered by AI can monitor soil moisture levels in real-time and automatically regulate water distribution, reducing waste and enhancing efficiency. AI-driven pest detection and disease prediction tools can help farmers take preventive measures, reducing crop losses and reliance on harmful pesticides. Drone-based AI monitoring systems can provide real-time insights into large-scale farms, ensuring better decision-making. AI-powered market intelligence can also connect farmers directly with buyers, ensuring fair pricing and reducing dependency on middlemen.',

        'Fintech – Financial Inclusion, Fraud Detection, AI-Driven Credit Scoring, Secure Transactions' =>
            'The fintech revolution is changing the way people access and manage their finances in Bangladesh, particularly in financial inclusion, fraud prevention, and secure digital transactions. AI-powered credit scoring models can analyze alternative data points, such as mobile transaction history, utility bill payments, and spending behavior, to provide credit access to unbanked and underbanked populations. AI-driven fraud detection systems use machine learning to analyze transaction patterns in real-time, identifying suspicious activities and preventing financial crimes. AI-powered chatbots can improve customer service, enabling instant loan approvals, automated financial advice, and seamless banking experiences. Additionally, AI-powered biometric authentication systems, such as facial recognition and voice recognition, can enhance transaction security, reducing the risks of fraud and cyber threats. These AI-driven innovations have the potential to make financial services more accessible, secure, and efficient for millions in Bangladesh.',

        'Healthcare – AI-Driven Diagnosis, Remote Patient Monitoring, Predictive Analytics, and Smart Healthcare Systems' =>
            'Bangladesh’s healthcare system faces significant challenges such as limited access to quality medical care, a shortage of healthcare professionals, inefficient hospital management, and the growing burden of non-communicable diseases. AI has the potential to revolutionize healthcare by enhancing diagnosis, treatment planning, and patient care. AI-powered medical imaging analysis can help detect diseases like cancer, tuberculosis, and diabetic retinopathy at an early stage with higher accuracy than traditional methods. AI-driven chatbots and virtual assistants can provide 24/7 medical consultations, offering primary healthcare guidance to remote or underserved populations. In telemedicine, AI can assist doctors by automatically analyzing patient symptoms and medical history, suggesting possible diagnoses, and recommending treatment options. Remote patient monitoring (RPM) systems integrated with AI can track vital signs like blood pressure, heart rate, and glucose levels in real-time, alerting doctors to potential health risks before they become critical.AI-powered predictive analytics models can analyze large-scale patient data to forecast disease outbreaks, helping governments and healthcare providers take proactive measures to control the spread of infectious diseases like dengue, COVID-19, and cholera. In hospital management, AI-driven automated scheduling systems can optimize doctor appointments, reduce patient waiting times, and improve resource allocation.AI-enabled robotic-assisted surgeries are also emerging as a transformative innovation, increasing precision and reducing human error. Additionally, AI-driven drug discovery can accelerate the development of new medicines, addressing Bangladesh’s need for affordable and effective treatments.AI-powered electronic health record (EHR) systems can streamline medical data management, reducing paperwork and enhancing interoperability between hospitals, clinics, and pharmacies. Personalized healthcare solutions powered by AI can tailor treatment plans based on a patient’s genetic makeup, lifestyle, and previous health conditions, improving treatment efficacy. AI can also combat medical fraud by detecting irregular insurance claims and identifying counterfeit medicines. By integrating AI into Bangladesh’s healthcare system, access to quality medical care can be improved, operational efficiencies can be enhanced, and overall patient outcomes can be significantly strengthened, ultimately leading to a healthier and more resilient nation.',
    ];

    $case_description = $case_descriptions[$category] ?? 'No description available.';
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Case Submission Answerscript</title>
    <style type="text/css">
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            margin: 5px auto;
            padding: 10px;
            background: #ffffff;
            border: 1px solid #ccc;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            font-size: 28px;
            color: #222;
            text-align: center;
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 2px solid #ccc;
        }

        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #f8f8f8;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .header-info div {
            font-weight: bold;
            flex: 1;
            text-align: center;
        }

        .team-members {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 20px;
        }

        .team-member {
            background: #f1f1f1;
            padding: 10px;
            border-radius: 6px;
            border: 1px solid #ddd;
            width: calc(50% - 10px);
            text-align: center;
            margin-bottom: 10px;
        }

        .content-section {
            margin-bottom: 30px;
        }

        .section-header {
            font-size: 20px;
            color: #444;
            margin-bottom: 10px;
            text-align: center;
            font-weight: bold;
            padding: 8px;
            border-bottom: 1px solid #ccc;
        }

        .section-content {
            font-size: 16px;
            line-height: 1.6;
            padding: 15px;
            border: 1px solid #ccc;
            background: #f9f9f9;
            border-radius: 6px;
            text-align: justify;
        }

        footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            border-top: 1px solid #ccc;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Case Submission Answerscript</h1>

        <div class="header-info">
            <div>Team Leader: {{ $name }}</div>
            <div>Designation: {{ $designation }}</div>
            <div>Organization: {{ $organization }}</div>
        </div>

        <div class="team-members">
            @foreach ($members_array as $member)
                <div class="team-member">
                    <div><strong>Team Member: {{ $member->member_name }}</strong></div>
                    <div>Designation: {{ $member->member_designation }}</div>
                </div>
            @endforeach
        </div>

        <div class="content-section">
            <div class="section-header">Category Definition</div>
            <div class="section-content">{{ $case_description }}</div>
        </div>

        <div class="content-section">
            <div class="section-header">Problem</div>
            <div class="section-content">{{ $problem }}</div>
        </div>

        <div class="content-section">
            <div class="section-header">Solution</div>
            <div class="section-content">{{ $solution }}</div>
        </div>

        <div class="content-section">
            <div class="section-header">Benefits</div>
            <div class="section-content">{{ $benefits }}</div>
        </div>
    </div>

    <footer>
        <p>&copy; {{ date('Y') }} {{ Config::get('app.name') }}. All Rights Reserved.</p>
    </footer>
</body>

</html>
