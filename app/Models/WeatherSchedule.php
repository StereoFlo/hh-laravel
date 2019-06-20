<?php

namespace App\Models;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property CarbonInterface run_at
 */
class WeatherSchedule extends Model
{
    /**
     * @param string $date
     *
     * @return $this
     */
    public function store(string $date): self
    {
        $this->run_at = $date;
        $this->save();

        return $this;
    }

    public function getList()
    {
        return self::paginate(10);
    }

    /**
     * @param string $time
     *
     * @return Collection
     */
    public function getByTime(string $time): Collection
    {
        return self::where('run_at', $time)->get();
    }

    /**
     * @param int $id
     *
     * @return mixed
     */
    public function removeById(int $id)
    {
        return self::where('id', $id)->delete();
    }
}
