<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Lucido;


class DataLayer extends Model
{

    public function storeLucido($data)
    {
        $lucido = new Lucido();
        $lucido->titolo = $data['titolo'];
        $lucido->link = $data['link'];
        $lucido->commento = $data['commento']  ?? '';
        if (isset($data['isVisible']) && $data['isVisible'] == 'on') {
            $lucido->isVisible = true;
        } else {
            $lucido->isVisible = false;
        }
        $lucido->created_at = now();
        $lucido->updated_at = now();
        $lucido->save();

        return $lucido;

    }
    public function getAllLucidi()
    {
        return Lucido::where('isVisible', true)
            ->orderBy('created_at', 'desc')
            ->get();
    }
}