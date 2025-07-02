<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Activity;

class DataLayer extends Model
{

    public function getAllActivities()
    {
        return Activity::orderBy('completata')
            ->orderBy('created_at', 'desc')
            ->get();
    }
    public function setCheckedById($id)
    {
        $activity = Activity::find($id);
        if ($activity) {
            $activity->completata = !$activity->completata;
            $activity->save();
        }
        return $this->getAllActivities();
    }
    public function createActivity($data)
    {
        $activity = new Activity();
        $activity->titolo = $data['titolo'];
        $activity->descrizione = $data['descrizione'] ?? null;
        $activity->completata = $data['completata'] ?? false;
        $activity->save();
    }

}