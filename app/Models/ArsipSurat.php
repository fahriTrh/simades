<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArsipSurat extends Model
{
    protected $fillable = [
        'warga_id',
        'template_id',
        'created_by',
        'nomor_surat',
        'tanggal_surat',
        'file_surat',
        'keterangan',
    ];

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function template()
    {
        return $this->belongsTo(TemplateSurat::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }
}
