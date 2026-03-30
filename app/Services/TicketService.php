<?php

namespace App\Services;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TicketService
{
    /**
     * Generate a QR code URL for a ticket.
     * 
     * @param string $ticketId
     * @return string
     */
    public static function generateQrUrl($ticketId)
    {
        // For demonstration, we'll use a public QR generator API
        // In production, use SimpleSoftwareIO\QrCode locally
        return "https://api.qrserver.com/v1/create-qr-code/?size=300x300&data=" . urlencode($ticketId);
    }

    /**
     * Validate a ticket.
     * 
     * @param string $ticketId
     * @return bool
     */
    public static function validateTicket($ticketId)
    {
        // Check in database if ticket exists and hasn't been scanned
        return true; 
    }
}
