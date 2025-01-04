<?php

namespace App\Exports;

use App\Models\Property;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AgentPropertyExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $agentId;

    public function __construct($agentId)
    {
        $this->agentId = $agentId;
    }



    public function collection()
    {
        return Property::where('agent_id', $this->agentId)->get();
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
