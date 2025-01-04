<?php

namespace App\Exports;

use App\Models\Property;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PropertyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Property::select( 
        'id',
            'agent_id',
            'name',
            'address',
            'plotSize',
            'dimFront',
            'dimWidth',
            'totalSize',
            'leasedArea',
            'nearestLand',
            'corner',
            'parkingcap',
            'demandSqft',
            'absValue',
            'agentname',
            'agentcontact',
            'agentdetail',
            'contactPerson',
        )->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'agent_id',
            'name',
            'address',
            'plotSize',
            'dimFront',
            'dimWidth',
            'totalSize',
            'leasedArea',
            'nearestLandmark',
            'corner',
            'parkingcapacity',
            'demandSqft',
            'absValue',
            'agentname',
            'agentcontact',
            'agentdetail',
            'contactPerson',
           
        ];
    }
}
