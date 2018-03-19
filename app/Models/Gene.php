<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\DateTimeTrait;

class Gene extends Model
{
    use DateTimeTrait;

    protected $fillable=['name','gene_type'];

    protected $dates=['created_at', 'updated_at'];

    /**
     * @return \Illuminate\Config\Repository|mixed|string
     */
    public function geneTypeTransform()
    {
        $geneType=config("dictionaries.gene_type.{$this->gene_type}");
        return $geneType ?? '';
    }


}
