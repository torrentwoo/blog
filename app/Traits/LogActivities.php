<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogActivities
{
    /**
     * Record user activities via model events
     */
    public static function bootLogActivities()
    {
        foreach (static::getModelEvents() as $event) {
            static::$event(function($model) use ($event) {
                if (!$model->shouldLogModelEvents()) {
                    return false;
                }
                $description = $model->getEventDescription($event);
                $model->logActivity($event, $description);
            });
        }
    }

    /**
     * Get the model event name
     *
     * @return array
     */
    public static function getModelEvents()
    {
        if (isset(static::$logEvents)) {
            return static::$logEvents;
        }

        return ['created'];
    }

    /**
     * Record the user activities (save the data to database)
     *
     * @param string $event       the model event name
     * @param string $description the description of model event name
     */
    public function logActivity($event = 'created', $description = 'created')
    {
        Activity::create([
            'user_id'           =>  Auth::id(),
            'activable_id'      =>  $this->id,
            'activable_type'    =>  get_class($this),
            'log_name'          =>  $event,
            'description'       =>  $description,
        ]);
    }

    /**
     * Get the description of model event
     *
     * @param $event the model event name
     * @return mixed
     */
    public function getEventDescription($event)
    {
        return $event;
    }

    /**
     * Determine whether record the events or not
     *
     * @return bool
     */
    protected function shouldLogModelEvents()
    {
        if (property_exists($this, 'logModelEvents')) {
            return (boolean) $this->logModelEvents;
        }

        return true;
    }
}
