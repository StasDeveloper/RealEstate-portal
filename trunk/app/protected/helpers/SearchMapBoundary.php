<?php

abstract class SearchMapBoundary extends SearchCriteria{

    protected $mapBoundary;

    public function __construct(MapBoundary $mapBoundary){
        $this->mapBoundary = $mapBoundary;
    }

    abstract public function setFilter(DGSphinxSearch $search, $lat_attr, $lon_attr);

    public function getMapBoundary(){
        return $this->mapBoundary;
    }
} 