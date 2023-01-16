<?php

namespace restapi\models;

use common\models\Worker;

class WorkerModel extends Worker
{
   public function fields()
   {
       return [
           'id',
           'full_name',
           'phone_number',
           'location',
           'type',
           'status',
           'created_at',
           'updated_at'
       ];
   }
}