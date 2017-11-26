<?php

namespace App\Traits;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogActivities
{
    /**
     * Determine whether record the activity or not
     *
     * @var bool
     */
    protected $logModelEvents = true;

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
     * Enable to record user activities
     *
     * @return $this
     */
    public function enable()
    {
        $this->logModelEvents = true;

        return $this;
    }

    /**
     * Disable to record user activities
     *
     * @return $this
     */
    public function disable()
    {
        $this->logModelEvents = false;

        return $this;
    }

    /**
     * Determine whether record the events or not
     *
     * @return bool
     */
    protected function shouldLogModelEvents()
    {
        return $this->logModelEvents;
    }
}
