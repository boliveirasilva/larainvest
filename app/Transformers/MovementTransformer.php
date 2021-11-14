<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Movement;

/**
 * Class MovimentTransformer.
 *
 * @package namespace App\Transformers;
 */
class MovementTransformer extends TransformerAbstract
{
    /**
     * Transform the Moviment entity.
     *
     * @param \App\Entities\Movement $model
     *
     * @return array
     */
    public function transform(Movement $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
