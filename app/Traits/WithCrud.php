<?php

namespace App\Traits;

// protected $fillable should be present to all models

trait WithCrud {

    public function getById($id)
    {
        return $this->where('id', '=', $id)->first();
    }

    public function saveNew($data, $is_return_data = false)
    {
        $model = new static;
        $model->fill($data);

        if ($model->save())
        {
            if($is_return_data)
            {
                return $model;
            }
            return true;
        }
        return false;
    }

    public function saveChanges($data, $is_return_data = false)
    {
        $model = $this->getById($data['id']);
        if (!is_null($model))
        {
            $model->fill($data);
            $model->save();

            if($is_return_data)
            {
                return $model;
            }

            return true;
        }
        return false;
    }

    public function saveData($data, $is_return_data = false)
    {
        if (!empty($data['id']))
        {
            return $this->saveChanges($data, $is_return_data);
        }
        else
        {
            return $this->saveNew($data, $is_return_data);
        }
    }
}
