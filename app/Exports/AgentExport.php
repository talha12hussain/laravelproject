<?php

namespace App\Exports;

use App\Models\Agent;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class AgentExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Agent::select([
        'id',
        'agencyName',
        'agencyAddress',
        'agencyCity',
        'memName',
        'memNumber',
        'agentName',
        'agentminName',
        'agentlastName',
        'cnicNum',
        'cnicExp',
        'agentEmail'
        
        ])->get();


    }

    public function headings(): array
    {
        return [
                 'id',
                 'agency Name',
                 'agency Address',
                 'agency City',
                 'Membership Name',
                 'Membership Number',
                 'agent Name',
                 'agent mid Name',
                 'agent last Name',
                 'cnic No.',
                'cnic Exp.',
                'agentEmail ',
                

           
        ];
    }

}
