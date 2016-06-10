<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/5/16
 * Time: 7:25 AM
 */

namespace App;


use Carbon\Carbon;

trait SeriesTrait
{
    
    protected $series_dates = [];
    
    protected $max_date = null;

    public function isSeries($comic_object)
    {
        if(isset($comic_object['series']))
        {
            if(isset($comic_object['series']['resourceURI']))
                return $this->getSeriesId($comic_object['series']['resourceURI']);

            return true;
        }

        return false;
    }

    public function hasFutureSeriesDate(array $series_object)
    {
        foreach($series_object as $object)
        {
            $date = $this->getOnSaleDate($object);

            if($date)
            {
                if($date >= $this->getMaxDate())
                {
                    $this->series_dates[] = $object;
                }
            }
                
        }

        return $this->series_dates;
    }

    protected function getSeriesId($comic_series_resource_uri)
    {

        $comic_series_resource_uri = explode("/", $comic_series_resource_uri);


        return end($comic_series_resource_uri);
    }

    protected function getOnSaleDate($object)
    {
        if($object['dates'])
        {
            foreach($object['dates'] as $date)
            {
                if($date['type'] == 'onsaleDate')
                {
                    return Carbon::parse($date['date']);
                }
            }
            
            return false;
        }
        
        return false;
    }

    public function getMaxDate()
    {
        if($this->max_date == null)
            $this->setMaxDate();
        
        return $this->max_date;
    }
    
    public function setMaxDate(Carbon $date = null)
    {
        if($date == null)
            $date = Carbon::now();
        
        $this->max_date = $date;
        
        return $this;
    }
}