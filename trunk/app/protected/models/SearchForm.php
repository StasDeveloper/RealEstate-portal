<?php

/**
 * SearchForm class.
 * Данные для поиска в классе 'SiteController'.
 */
class SearchForm extends CFormModel
{
    
    public $address;
    public $street_number ;
    public $street_address ;
    public $city ;
    public $state ;
    public $zipcode ;
    public $country ;
    public $sale_type ;
    public $min_price ;
    public $max_price ;
    public $property_type = array() ;
    public $min_price_sqft ;
    public $max_price_sqft ;
    public $min_sqft ;
    public $max_sqft ;
    public $bed ;
    public $bath ;
    public $keywords ;
    public $min_year_built ;
    public $max_year_built ;
    public $min_lot_size ;
    public $max_lot_size ;
    

    public function rules()
    {
        return array(
              
            array('address, street_number, street_address, city, state, zipcode, 
                   country, sale_type, min_price, max_price,  property_type, min_price_sqft, max_price_sqft
                   min_sqft, max_sqft, bed, bath, keywords, min_year_built, 
                   max_year_built, min_lot_size, max_lot_size', 'safe'),
            //array('min_price, max_price, min_sqft, max_sqft', 'numerical'),
          
        );
    }

    
    public function attributeLabels()
    {
        
        return array(
            
            'address'=>'Address',
            'street_number'=>'Street Number',
            'city'=>'City',
            'state'=>'State',
            'zipcode'=>'Zipcode',
            'country'=>'Country',
            'sale_type'=>'Sale Type',
            'min_price'=>'Min Price',
            'max_price'=>'Max Price',
            'property_type'=>'Property Type',
            'min_price_sqft' => 'Min price sqft',
            'max_price_sqft' => 'Max price sqft',
            'min_sqft'=>'Min sqft',
            'max_sqft'=>'Max_sqft',
            'bed'=>'Bed',
            'bath'=>'Bath',
            'keywords'=>'Keywords',
            'min_year_built'=>'Min Year Built',
            'max_year_built'=>'Max Year Built',
            'min_lot_size'=>'Min Lot Size',
            'max_lot_size'=>'Max Lot Size'
            
        );
    }

    
    public function searchQuery($query)
    {
        $search = Yii::App()->search;
        $search->setSelect('*');
        $search->setArrayResult(true);
        $search->setMatchMode(SPH_MATCH_EXTENDED2);
        $search->SetLimits(0,10,1000);
        $search->setSortMode(SPH_SORT_RELEVANCE);
        // $search->SetFieldWeights(array('title' => 20, 'short_description' => 10));
        
        $resArray = $search->query( $query, '*');
        return $resArray;
    }

}