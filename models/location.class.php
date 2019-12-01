<?php
namespace FSR_AI;

class location extends BaseModel
{
    const TABLENAME = '`location`';

    protected $schema = [
        'id'               => [ 'type' => BaseModel::TYPE_INT ],
        'created_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'updated_at'       => [ 'type' => BaseModel::TYPE_STRING ],
        'street'             => [ 'type' => BaseModel::TYPE_STRING ],
        'number'             => [ 'type' => BaseModel::TYPE_STRING ],
        'zipcode'      => [ 'type' => BaseModel::TYPE_STRING ],
        'city'          => [ 'type' => BaseModel::TYPE_STRING ],
        'room'      => [ 'type' => BaseModel::TYPE_STRING ]
    ];

    public static function getLocationDetails($location_id = null){

        $results = location::find();
        foreach ($results as $output) {
            if(!empty($location_id)) {

                if ($output['room'] == null) {
                    return $output['city'] . ', ' . $output['street'] . ' ' . $output['number'] . ', ' . $output['zipcode'];
                } else {
                    return $output['city'] . ', ' . $output['street'] . ' ' . $output['number'] . ', ' . $output['zipcode'] . ', Raum: ' . $output['room'];
                }
            }else{

                if($output['room'] == null){
                    echo '<option value="'.$output['id'].'">'.$output['city'].', '.$output['street'].' '.$output['number'].', '.$output['zipcode'].'</option>';
                }else{
                    echo '<option value="'.$output['id'].'">'.$output['city'].', '.$output['street'].' '.$output['number'].', '.$output['zipcode'].', Raum: '.$output['room'].'</option>';
                }
            }
        }
    }
}