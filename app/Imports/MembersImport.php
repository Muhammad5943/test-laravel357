<?php

namespace App\Imports;

use App\Models\Member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MembersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Member([
            'group_id' => $row['group_id'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'alamat' => $row['alamat'],
            'hp' => $row['hp']
        ]);
    }
}
