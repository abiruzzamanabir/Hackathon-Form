<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WhatsAppController extends Controller
{
    public function sendMessage($phone, $name)
    {
        // Check if the phone number starts with +880, if not, add it
        if (substr($phone, 0, 1) === '0') {
            // Add +880 country code before the phone number
            $phone = '+880' . substr($phone, 1);
        } elseif (substr($phone, 0, 4) !== '+880') {
            // If the phone number does not start with +880, prepend the country code
            $phone = '+880' . $phone;
        }

        // Define the message with a dynamic name
        $message = "Dear {$name},\n\n"
            . "This is a polite reminder that the submission deadline for AI Hackathon 2025 is March 25, 2025. "
            . "Please ensure that the team leader has registered and filled up all the team member's information on the official AI Hackathon website "
            . "and that your solution has been submitted correctly in accordance with the provided guidelines.\n\n"
            . "Additionally, please note that each team must consist of 3 to 5 members to be eligible for participation.\n\n"
            . "Do not miss this opportunity to showcase your AI innovation and make a meaningful impact!\n\n"
            . "Best regards,\nAI Hackathon Team";

        // URL encode the message to ensure it works in a URL context
        $encodedMessage = urlencode($message);

        // Generate the WhatsApp link
        $whatsappLink = "https://wa.me/{$phone}?text={$encodedMessage}";

        // Redirect to the WhatsApp link
        return Redirect::away($whatsappLink);
    }
}
