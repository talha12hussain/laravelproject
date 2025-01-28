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

class PropertiesExport implements FromCollection, WithHeadings, WithTitle, WithStyles, WithColumnWidths
{
    /**
     * Return all properties for export.
     */
    public function collection()
    {
        // Get all fields from the Property model
        return PropertyNewForm::select(
            'id',
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
            'Type',
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
        return 'Complete Property Data';
    }

    /**
     * Apply styles to the sheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Header row styles
        $sheet->getStyle('A1:P1')->applyFromArray([
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
        $sheet->getStyle('A2:P1000')->applyFromArray([
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
            'B' => 20, // Property Type
            'C' => 15, // City
            'D' => 20, // Property Sub Type
            'E' => 30, // Address
            'F' => 25, // Nearest Landmark
            'G' => 10, // Floor
            'H' => 12, // Bedrooms
            'I' => 12, // Bathrooms
            'J' => 18, // Property Size
            'K' => 18, // Asking Price
            'L' => 15, // Corner Property
            'M' => 18, // Contact No
            'N' => 20, // Agent Name
            'O' => 40, // Description
            'P' => 20, // Created At
        ];
    }
}
