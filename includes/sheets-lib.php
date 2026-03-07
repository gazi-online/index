<?php
// includes/sheets-lib.php - Google Sheets API Wrapper

require_once __DIR__ . '/../vendor/autoload.php';

class GoogleSheetsDB
{
    private $service;
    private $spreadsheetId;
    private $initError = null;

    public function __construct()
    {
        $credentialsJson = $_ENV['GOOGLE_CREDENTIALS'] ?? getenv('GOOGLE_CREDENTIALS');
        $this->spreadsheetId = $_ENV['GOOGLE_SPREADSHEET_ID'] ?? getenv('GOOGLE_SPREADSHEET_ID');

        if (!$credentialsJson) {
            $this->initError = "Missing GOOGLE_CREDENTIALS";
            return;
        }
        if (!$this->spreadsheetId) {
            $this->initError = "Missing GOOGLE_SPREADSHEET_ID";
            return;
        }

        // Sanitize credentials JSON (Vercel sometimes adds quotes or escapes)
        $credentialsJson = trim($credentialsJson);
        // Remove surrounding quotes if present
        if (preg_match('/^["\'](.*)["\']$/s', $credentialsJson, $matches)) {
            $credentialsJson = $matches[1];
        }
        // Decode escaped characters (like \n or \")
        $decoded = json_decode($credentialsJson, true);
        if ($decoded === null) {
            // Try unescaping if first attempt failed
            $tempJson = str_replace('\\n', "\n", $credentialsJson);
            $tempJson = str_replace('\\"', '"', $tempJson);
            $decoded = json_decode($tempJson, true);
        }

        // CRITICAL FIX for "OpenSSL unable to validate key":
        // Ensure the private_key contains actual newlines, not literal '\n' strings
        if ($decoded && isset($decoded['private_key'])) {
            $key = $decoded['private_key'];
            // Handle multiple types of escaping that can happen on Vercel/pasting
            $key = str_replace('\\n', "\n", $key);
            $key = str_replace('\n', "\n", $key);
            $key = trim($key);

            // Ensure it has PEM wrappers
            if (strpos($key, '-----BEGIN PRIVATE KEY-----') === false && strpos($key, '-----BEGIN') !== false) {
            // It might be partially malformed PEM
            }

            $decoded['private_key'] = $key;
        }

        try {
            if ($decoded === null) {
                $this->initError = "Invalid JSON in GOOGLE_CREDENTIALS: " . json_last_error_msg();
                return;
            }

            $client = new \Google\Client();
            $client->setAuthConfig($decoded);
            $client->addScope(\Google\Service\Sheets::SPREADSHEETS);
            $this->service = new \Google\Service\Sheets($client);
        }
        catch (Exception $e) {
            $this->initError = "Exception: " . $e->getMessage();
        }
    }

    public function getInitError()
    {
        return $this->initError;
    }

    public function isConfigured()
    {
        return $this->service !== null;
    }

    public function appendRow($sheetName, $values)
    {
        if (!$this->isConfigured())
            return false;

        $body = new \Google\Service\Sheets\ValueRange([
            'values' => [$values]
        ]);
        $params = ['valueInputOption' => 'RAW'];

        try {
            $this->service->spreadsheets_values->append($this->spreadsheetId, $sheetName . '!A1', $body, $params);
            return true;
        }
        catch (Exception $e) {
            error_log("Google Sheets Append Error (" . $sheetName . "): " . $e->getMessage());
            return $e->getMessage(); // Return the error message itself for debugging
        }
    }

    public function getRows($sheetName)
    {
        if (!$this->isConfigured())
            return [];

        try {
            $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $sheetName . '!A:Z');
            return $response->getValues() ?: [];
        }
        catch (Exception $e) {
            error_log("Google Sheets Error: " . $e->getMessage());
            $this->initError = "Runtime Error: " . $e->getMessage();
            return [];
        }
    }

    public function updateStatus($sheetName, $bookingId, $newStatus)
    {
        if (!$this->isConfigured())
            return false;

        $rows = $this->getRows($sheetName);
        $rowIndex = -1;

        // Assuming ID is in column A (index 0)
        foreach ($rows as $index => $row) {
            if ($row[0] == $bookingId) {
                $rowIndex = $index + 1; // Sheets is 1-indexed
                break;
            }
        }

        if ($rowIndex === -1)
            return false;

        // Assuming Status is in column H (index 7)
        $range = $sheetName . '!H' . $rowIndex;
        $body = new \Google\Service\Sheets\ValueRange(['values' => [[$newStatus]]]);
        $params = ['valueInputOption' => 'RAW'];

        try {
            $this->service->spreadsheets_values->update($this->spreadsheetId, $range, $body, $params);
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
?>
