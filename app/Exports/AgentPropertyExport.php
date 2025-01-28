<?php

namespace App\Exports;

use App\Models\PropertyNewForm;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AgentPropertyExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    protected $agentId;

    public function __construct($agentId)
    {
        $this->agentId = $agentId;
    }

    /**
     * Fetch properties based on the agent ID.
     */
    public function collection()
    {
        return PropertyNewForm::where('agent_id', $this->agentId)->select(
            'id',
            'agent_id',
            'type',
           'property_type',
            'city',
            'property_types',
            'address',
            'nearest_landmark',
            'floor',
            'bedrooms',
            'bathrooms',
            'property_size',
            'asking_price',
            'corner_property',
            'contact_no',
            'agent_name',
            'description',
            'created_at'
        )->get();
    }

    /**
     * Add headings for the Excel columns.
     */
    public function headings(): array
    {
        return [
            'ID',
            'Agent ID',
            'type',
            'Property Type',
            'City',
            'Property Types',
            'Address',
            'Nearest Landmark',
            'Floor',
            'Bedrooms',
            'Bathrooms',
            'Property Size ',
            'Asking Price',
            'Corner Property',
            'Contact No',
            'Agent Name',
            'Description',
            'Created At',
        ];
    }

    /**
     * Set the title of the sheet.
     */
    public function title(): string
    {
        return 'Agent Properties';
    }

    /**
     * Apply styles to the sheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Header row styles
        $sheet->getStyle('A1:R1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12,
                'color' => ['argb' => 'FFFFFFFF'], // White font
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['argb' => 'FF4CAF50'], // Green background
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Black border
                ],
            ],
        ]);

        // Data row styles
        $sheet->getStyle('A2:R1000')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FFCCCCCC'], // Light gray border
                ],
            ],
        ]);

        // Set row height for better visibility
        $sheet->getDefaultRowDimension()->setRowHeight(20);
    }

    /**
     * Set column widths.
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,  // ID
            'B' => 10, // Agent ID
            'C' => 20, // Name
            'D' => 30, // Address
            'E' => 12, // Plot Size
            'F' => 15, // Dimension Front
            'G' => 15, // Dimension Width
            'H' => 12, // Total Size
            'I' => 15, // Leased Area
            'J' => 25, // Nearest Landmark
            'K' => 15, // Corner Property
            'L' => 20, // Parking Capacity
            'M' => 18, // Demand/Sqft
            'N' => 18, // Absolute Value
            'O' => 20, // Agent Name
            'P' => 15, // Agent Contact
            'Q' => 30, // Agent Details
            'R' => 20, // Contact Person
        ];
    }
}
