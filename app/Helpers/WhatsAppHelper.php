<?php

namespace App\Helpers;

class WhatsAppHelper
{
    /**
     * Generate WhatsApp URL with pre-filled message
     *
     * @param string $productName
     * @param string|null $customMessage
     * @return string
     */
    public static function generateUrl($productName, $customMessage = null)
    {
        $whatsappNumber = config('contact.whatsapp.number');
        $messageTemplate = config('contact.whatsapp.message_template');
        
        // Use custom message if provided, otherwise use template
        if ($customMessage) {
            $message = $customMessage;
        } else {
            $message = str_replace('{product_name}', $productName, $messageTemplate);
        }
        
        return "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
    }
    
    /**
     * Generate WhatsApp URL for general inquiry
     *
     * @param string $message
     * @return string
     */
    public static function generateGeneralUrl($message = 'Halo, saya ingin bertanya tentang produk Anda.')
    {
        $whatsappNumber = config('contact.whatsapp.number');
        return "https://wa.me/{$whatsappNumber}?text=" . urlencode($message);
    }
    
    /**
     * Check if WhatsApp number is configured
     *
     * @return bool
     */
    public static function isConfigured()
    {
        $number = config('contact.whatsapp.number');
        return !empty($number) && strlen($number) >= 10; // Check if number is valid length
    }
    
    /**
     * Get formatted WhatsApp number for display
     *
     * @return string
     */
    public static function getFormattedNumber()
    {
        $number = config('contact.whatsapp.number');
        if (strlen($number) === 13 && substr($number, 0, 2) === '62') {
            return '+62 ' . substr($number, 2, 3) . '-' . substr($number, 5, 4) . '-' . substr($number, 9, 4);
        }
        return $number;
    }
} 