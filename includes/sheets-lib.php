<?php
// includes/sheets-lib.php - Google Sheets API Wrapper

require_once __DIR__ . '/../vendor/autoload.php';

class GoogleSheetsDB
{
    private $service;
    private $spreadsheetId;

    public function __construct()
    {
        $credentialsJson = getenv('GOOGLE_CREDENTIALS');
        $this->spreadsheetId = getenv('GOOGLE_SPREADSHEET_ID');

        if (!$credentialsJson || !$this->spreadsheetId) {
            return; // Not configured yet
        }

        $client = new \Google\Client();
        $client->setAuthConfig(json_decode($credentialsJson, true));
        $client->addScope(\Google\Service\Sheets::SPREADSHEETS);
        $this->service = new \Google\Service\Sheets($client);
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
            error_log("Google Sheets Error: " . $e->getMessage());
            return false;
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
