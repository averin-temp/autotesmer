<?php
/**
 * Created by PhpStorm.
 * User: hustler
 * Date: 09.12.2019
 * Time: 14:59
 */

namespace common\classes;


use common\models\PackageVariant;
use common\models\Service;

class PackageHelper
{
    /**
     * @param PackageVariant $packageVariant
     * @return array
     */
    public static function getServiceNames($packageVariant){

        $services = $packageVariant->servicesSettings;
        $labels = Service::labels();
        $names = [];
        foreach($services as $serviceOptions){
            $serviceName = $labels[$serviceOptions->service_type];
            if(!in_array($serviceName,$names)){
                $names[] = $serviceName;
            }
        }
        return $names;

    }
    /**
     * @param PackageVariant $packageVariant
     * @return array
     */
    public static function getVariantServiceTypes($packageVariant){
        $services = $packageVariant->servicesSettings;
        $types = [];
        foreach($services as $serviceOptions){
            $types[$serviceOptions->service_type] = 1;
        }
        return array_keys($types);
    }


}