<?php

/**
 * This is the model class for table "property_info_additional_brokerage_details".
 *
 * The followings are the available columns in table 'property_info_additional_brokerage_details':
 * @property integer $property_info_brokerage_details
 * @property integer $property_id
 * @property string $status
 * @property string $fireplace_features
 * @property string $heating_features
 * @property string $exterior_construction_features
 * @property string $roofing_features
 * @property string $interior_features
 * @property string $exterior_features
 * @property string $sales_history
 * @property string $tax_history
 * @property string $foreclosure
 * @property string $short_sale
 * @property string $page_link
 * @property string $updated_mid
 * @property integer $brokerage_mid
 * @property string $mls_id
 * @property string $pagent_name
 * @property string $pagent_phone
 * @property string $pagent_phone_fax
 * @property string $pagent_phone_home
 * @property string $pagent_phone_mobile
 * @property string $pagent_website
 * @property integer $list_agent_public_id
 * @property string $email
 * @property string $buyer_broker_code
 * @property integer $buyer_agent_public_id
 * @property string $lo_phone
 * @property string $list_office_code
 * @property string $owner_licensee
 * @property string $realtor
 * @property string $sale_office_bonus
 * @property string $commission_excluded
 * @property string $commission_variable
 * @property string $additional_showing
 * @property integer $ladom
 * @property string $home_protection_plan
 * @property integer $open_house_flag
 * @property string $list_date
 * @property integer $list_price
 * @property integer $original_list_price
 * @property string $pricechgdate
 * @property integer $sale_price
 * @property integer $previous_price
 * @property string $status_updates
 * @property string $t_status_date
 * @property string $internet
 * @property string $idx
 * @property integer $images
 * @property string $photo_excluded
 * @property string $photo_instructions
 * @property string $lpsqft_wcents
 * @property string $lpsqft
 * @property string $spsqft_wcents
 * @property string $splp
 * @property string $public_address
 * @property string $commentary
 * @property string $avm
 * @property integer $documentfolderid
 * @property integer $documentfoldercount
 * @property string $record_delete_date
 * @property string $record_delete_flag
 * @property string $directions
 * @property string $contingency_desc
 * @property string $temp_off_mrkt_status_desc
 * @property string $possession_description
 * @property string $statuschangedate
 * @property string $entry_date
 * @property string $acceptance_date
 * @property integer $dom
 * @property integer $active_dom
 * @property string $est_clolse_dt
 * @property string $actual_close_date
 * @property integer $days_from_listing_to_close
 * @property string $last_transaction_code
 * @property string $last_transaction_date
 * @property string $package_available
 * @property integer $property_insurance
 * @property integer $sold_appraisal
 * @property integer $sold_down_payment
 * @property integer $earnest_deposit
 * @property integer $sellers_contribution
 * @property string $financing_considered
 * @property integer $amt_owner_will_carry
 * @property integer $existing_rent
 * @property string $nod_date
 * @property string $reporeo
 * @property string $auction_date
 * @property string $auction_type
 * @property string $additional_au_sold_terms
 * @property string $litigation
 * @property string $litigation_type
 * @property integer $studio_rent
 * @property string $cap_rate
 * @property string $gross_rent_multiplier
 * @property string $owner_will_carry
 * @property string $current_loan_assumable
 * @property integer $cash_to_assume
 * @property integer $cost_per_unit
 * @property integer $gross_operating_income
 * @property integer $yearly_operating_income
 * @property string $tenant_pays
 * @property string $other_income_description
 * @property integer $amount_owner_will_carry
 * @property integer $noi
 * @property integer $yearly_operating_expense
 * @property integer $yearly_other_income
 * @property string $other_encumbrance_desc
 * @property string $expense_source
 * @property integer $vacancy
 * @property string $service_contract_inc
 * @property string $parcel_num
 * @property integer $legal_location_range
 * @property integer $legal_lctn_range_search
 * @property integer $legal_location_section
 * @property integer $legal_lctn_section_search
 * @property integer $legal_location_township
 * @property integer $legal_lctntownship_search
 * @property string $tax_district
 * @property integer $assessed_imp_value
 * @property integer $assessed_land_value
 * @property string $block_number
 * @property string $lot_number
 */
class PropertyInfoAdditionalBrokerageDetails extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'property_info_additional_brokerage_details';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('property_id, status, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, page_link, updated_mid, brokerage_mid, mls_id, pagent_name, pagent_phone, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, pagent_website', 'required'),
			array('property_id, brokerage_mid, list_agent_public_id, buyer_agent_public_id, ladom, open_house_flag, list_price, original_list_price, sale_price, previous_price, images, documentfolderid, documentfoldercount, dom, active_dom, days_from_listing_to_close, property_insurance, sold_appraisal, sold_down_payment, earnest_deposit, sellers_contribution, amt_owner_will_carry, existing_rent, studio_rent, cash_to_assume, cost_per_unit, gross_operating_income, yearly_operating_income, amount_owner_will_carry, noi, yearly_operating_expense, yearly_other_income, vacancy, legal_location_range, legal_lctn_range_search, legal_location_section, legal_lctn_section_search, legal_location_township, legal_lctntownship_search, assessed_imp_value, assessed_land_value', 'numerical', 'integerOnly'=>true),
			array('status, sales_history, tax_history, tenant_pays', 'length', 'max'=>50),
			array('fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features', 'length', 'max'=>250),
			array('foreclosure, short_sale', 'length', 'max'=>15),
			array('page_link, pagent_website', 'length', 'max'=>150),
			array('updated_mid, idx', 'length', 'max'=>1),
			array('mls_id, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, service_contract_inc', 'length', 'max'=>30),
			array('pagent_name', 'length', 'max'=>100),
			array('pagent_phone, tax_district', 'length', 'max'=>20),
			array('email', 'length', 'max'=>40),
			array('buyer_broker_code, list_office_code, block_number, lot_number', 'length', 'max'=>6),
			array('lo_phone, additional_au_sold_terms', 'length', 'max'=>12),
			array('owner_licensee, litigation', 'length', 'max'=>7),
			array('realtor, sale_office_bonus, commission_excluded, commission_variable, home_protection_plan, internet, photo_excluded, public_address, commentary, avm, record_delete_flag, package_available, reporeo, owner_will_carry, current_loan_assumable', 'length', 'max'=>3),
			array('additional_showing', 'length', 'max'=>55),
			array('status_updates, possession_description', 'length', 'max'=>25),
			array('photo_instructions', 'length', 'max'=>57),
			array('lpsqft_wcents, lpsqft, spsqft_wcents, splp, cap_rate, gross_rent_multiplier', 'length', 'max'=>10),
			array('directions', 'length', 'max'=>170),
			array('contingency_desc', 'length', 'max'=>39),
			array('temp_off_mrkt_status_desc', 'length', 'max'=>52),
			array('last_transaction_code', 'length', 'max'=>2),
			array('financing_considered', 'length', 'max'=>84),
			array('auction_type', 'length', 'max'=>8),
			array('litigation_type', 'length', 'max'=>19),
			array('other_income_description, expense_source', 'length', 'max'=>60),
			array('other_encumbrance_desc', 'length', 'max'=>16),
			array('parcel_num', 'length', 'max'=>44),
			array('list_date, pricechgdate, t_status_date, record_delete_date, statuschangedate, entry_date, acceptance_date, est_clolse_dt, actual_close_date, last_transaction_date, nod_date, auction_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('property_info_brokerage_details, property_id, status, fireplace_features, heating_features, exterior_construction_features, roofing_features, interior_features, exterior_features, sales_history, tax_history, foreclosure, short_sale, page_link, updated_mid, brokerage_mid, mls_id, pagent_name, pagent_phone, pagent_phone_fax, pagent_phone_home, pagent_phone_mobile, pagent_website, list_agent_public_id, email, buyer_broker_code, buyer_agent_public_id, lo_phone, list_office_code, owner_licensee, realtor, sale_office_bonus, commission_excluded, commission_variable, additional_showing, ladom, home_protection_plan, open_house_flag, list_date, list_price, original_list_price, pricechgdate, sale_price, previous_price, status_updates, t_status_date, internet, idx, images, photo_excluded, photo_instructions, lpsqft_wcents, lpsqft, spsqft_wcents, splp, public_address, commentary, avm, documentfolderid, documentfoldercount, record_delete_date, record_delete_flag, directions, contingency_desc, temp_off_mrkt_status_desc, possession_description, statuschangedate, entry_date, acceptance_date, dom, active_dom, est_clolse_dt, actual_close_date, days_from_listing_to_close, last_transaction_code, last_transaction_date, package_available, property_insurance, sold_appraisal, sold_down_payment, earnest_deposit, sellers_contribution, financing_considered, amt_owner_will_carry, existing_rent, nod_date, reporeo, auction_date, auction_type, additional_au_sold_terms, litigation, litigation_type, studio_rent, cap_rate, gross_rent_multiplier, owner_will_carry, current_loan_assumable, cash_to_assume, cost_per_unit, gross_operating_income, yearly_operating_income, tenant_pays, other_income_description, amount_owner_will_carry, noi, yearly_operating_expense, yearly_other_income, other_encumbrance_desc, expense_source, vacancy, service_contract_inc, parcel_num, legal_location_range, legal_lctn_range_search, legal_location_section, legal_lctn_section_search, legal_location_township, legal_lctntownship_search, tax_district, assessed_imp_value, assessed_land_value, block_number, lot_number', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
                    'property_info'=> array(self::BELONGS_TO, 'PropertyInfo', 'property_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'property_info_brokerage_details' => 'Property Info Brokerage Details',
			'property_id' => 'Property',
			'status' => 'Status',
			'fireplace_features' => 'Fireplace Features',
			'heating_features' => 'Heating Features',
			'exterior_construction_features' => 'Exterior Construction Features',
			'roofing_features' => 'Roofing Features',
			'interior_features' => 'Interior Features',
			'exterior_features' => 'Exterior Features',
			'sales_history' => 'Sales History',
			'tax_history' => 'Tax History',
			'foreclosure' => 'Foreclosure',
			'short_sale' => 'Short Sale',
			'page_link' => 'Page Link',
			'updated_mid' => 'Updated Mid',
			'brokerage_mid' => 'Brokerage Mid',
			'mls_id' => 'Mls',
			'pagent_name' => 'Pagent Name',
			'pagent_phone' => 'Pagent Phone',
			'pagent_phone_fax' => 'Pagent Phone Fax',
			'pagent_phone_home' => 'Pagent Phone Home',
			'pagent_phone_mobile' => 'Pagent Phone Mobile',
			'pagent_website' => 'Pagent Website',
			'list_agent_public_id' => 'List Agent Public',
			'email' => 'Email',
			'buyer_broker_code' => 'Buyer Broker Code',
			'buyer_agent_public_id' => 'Buyer Agent Public',
			'lo_phone' => 'Lo Phone',
			'list_office_code' => 'List Office Code',
			'owner_licensee' => 'Owner Licensee',
			'realtor' => 'Realtor',
			'sale_office_bonus' => 'Sale Office Bonus',
			'commission_excluded' => 'Commission Excluded',
			'commission_variable' => 'Commission Variable',
			'additional_showing' => 'Additional Showing',
			'ladom' => 'Ladom',
			'home_protection_plan' => 'Home Protection Plan',
			'open_house_flag' => 'Open House Flag',
			'list_date' => 'List Date',
			'list_price' => 'List Price',
			'original_list_price' => 'Original List Price',
			'pricechgdate' => 'Pricechgdate',
			'sale_price' => 'Sale Price',
			'previous_price' => 'Previous Price',
			'status_updates' => 'Status Updates',
			't_status_date' => 'T Status Date',
			'internet' => 'Internet',
			'idx' => 'Idx',
			'images' => 'Images',
			'photo_excluded' => 'Photo Excluded',
			'photo_instructions' => 'Photo Instructions',
			'lpsqft_wcents' => 'Lpsqft Wcents',
			'lpsqft' => 'Lpsqft',
			'spsqft_wcents' => 'Spsqft Wcents',
			'splp' => 'Splp',
			'public_address' => 'Public Address',
			'commentary' => 'Commentary',
			'avm' => 'Avm',
			'documentfolderid' => 'Documentfolderid',
			'documentfoldercount' => 'Documentfoldercount',
			'record_delete_date' => 'Record Delete Date',
			'record_delete_flag' => 'Record Delete Flag',
			'directions' => 'Directions',
			'contingency_desc' => 'Contingency Desc',
			'temp_off_mrkt_status_desc' => 'Temp Off Mrkt Status Desc',
			'possession_description' => 'Possession Description',
			'statuschangedate' => 'Statuschangedate',
			'entry_date' => 'Entry Date',
			'acceptance_date' => 'Acceptance Date',
			'dom' => 'Dom',
			'active_dom' => 'Active Dom',
			'est_clolse_dt' => 'Est Clolse Dt',
			'actual_close_date' => 'Actual Close Date',
			'days_from_listing_to_close' => 'Days From Listing To Close',
			'last_transaction_code' => 'Last Transaction Code',
			'last_transaction_date' => 'Last Transaction Date',
			'package_available' => 'Package Available',
			'property_insurance' => 'Property Insurance',
			'sold_appraisal' => 'Sold Appraisal',
			'sold_down_payment' => 'Sold Down Payment',
			'earnest_deposit' => 'Earnest Deposit',
			'sellers_contribution' => 'Sellers Contribution',
			'financing_considered' => 'Financing Considered',
			'amt_owner_will_carry' => 'Amt Owner Will Carry',
			'existing_rent' => 'Existing Rent',
			'nod_date' => 'Nod Date',
			'reporeo' => 'Reporeo',
			'auction_date' => 'Auction Date',
			'auction_type' => 'Auction Type',
			'additional_au_sold_terms' => 'Additional Au Sold Terms',
			'litigation' => 'Litigation',
			'litigation_type' => 'Litigation Type',
			'studio_rent' => 'Studio Rent',
			'cap_rate' => 'Cap Rate',
			'gross_rent_multiplier' => 'Gross Rent Multiplier',
			'owner_will_carry' => 'Owner Will Carry',
			'current_loan_assumable' => 'Current Loan Assumable',
			'cash_to_assume' => 'Cash To Assume',
			'cost_per_unit' => 'Cost Per Unit',
			'gross_operating_income' => 'Gross Operating Income',
			'yearly_operating_income' => 'Yearly Operating Income',
			'tenant_pays' => 'Tenant Pays',
			'other_income_description' => 'Other Income Description',
			'amount_owner_will_carry' => 'Amount Owner Will Carry',
			'noi' => 'Noi',
			'yearly_operating_expense' => 'Yearly Operating Expense',
			'yearly_other_income' => 'Yearly Other Income',
			'other_encumbrance_desc' => 'Other Encumbrance Desc',
			'expense_source' => 'Expense Source',
			'vacancy' => 'Vacancy',
			'service_contract_inc' => 'Service Contract Inc',
			'parcel_num' => 'Parcel Num',
			'legal_location_range' => 'Legal Location Range',
			'legal_lctn_range_search' => 'Legal Lctn Range Search',
			'legal_location_section' => 'Legal Location Section',
			'legal_lctn_section_search' => 'Legal Lctn Section Search',
			'legal_location_township' => 'Legal Location Township',
			'legal_lctntownship_search' => 'Legal Lctntownship Search',
			'tax_district' => 'Tax District',
			'assessed_imp_value' => 'Assessed Imp Value',
			'assessed_land_value' => 'Assessed Land Value',
			'block_number' => 'Block Number',
			'lot_number' => 'Lot Number',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('property_info_brokerage_details',$this->property_info_brokerage_details);
		$criteria->compare('property_id',$this->property_id);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('fireplace_features',$this->fireplace_features,true);
		$criteria->compare('heating_features',$this->heating_features,true);
		$criteria->compare('exterior_construction_features',$this->exterior_construction_features,true);
		$criteria->compare('roofing_features',$this->roofing_features,true);
		$criteria->compare('interior_features',$this->interior_features,true);
		$criteria->compare('exterior_features',$this->exterior_features,true);
		$criteria->compare('sales_history',$this->sales_history,true);
		$criteria->compare('tax_history',$this->tax_history,true);
		$criteria->compare('foreclosure',$this->foreclosure,true);
		$criteria->compare('short_sale',$this->short_sale,true);
		$criteria->compare('page_link',$this->page_link,true);
		$criteria->compare('updated_mid',$this->updated_mid,true);
		$criteria->compare('brokerage_mid',$this->brokerage_mid);
		$criteria->compare('mls_id',$this->mls_id,true);
		$criteria->compare('pagent_name',$this->pagent_name,true);
		$criteria->compare('pagent_phone',$this->pagent_phone,true);
		$criteria->compare('pagent_phone_fax',$this->pagent_phone_fax,true);
		$criteria->compare('pagent_phone_home',$this->pagent_phone_home,true);
		$criteria->compare('pagent_phone_mobile',$this->pagent_phone_mobile,true);
		$criteria->compare('pagent_website',$this->pagent_website,true);
		$criteria->compare('list_agent_public_id',$this->list_agent_public_id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('buyer_broker_code',$this->buyer_broker_code,true);
		$criteria->compare('buyer_agent_public_id',$this->buyer_agent_public_id);
		$criteria->compare('lo_phone',$this->lo_phone,true);
		$criteria->compare('list_office_code',$this->list_office_code,true);
		$criteria->compare('owner_licensee',$this->owner_licensee,true);
		$criteria->compare('realtor',$this->realtor,true);
		$criteria->compare('sale_office_bonus',$this->sale_office_bonus,true);
		$criteria->compare('commission_excluded',$this->commission_excluded,true);
		$criteria->compare('commission_variable',$this->commission_variable,true);
		$criteria->compare('additional_showing',$this->additional_showing,true);
		$criteria->compare('ladom',$this->ladom);
		$criteria->compare('home_protection_plan',$this->home_protection_plan,true);
		$criteria->compare('open_house_flag',$this->open_house_flag);
		$criteria->compare('list_date',$this->list_date,true);
		$criteria->compare('list_price',$this->list_price);
		$criteria->compare('original_list_price',$this->original_list_price);
		$criteria->compare('pricechgdate',$this->pricechgdate,true);
		$criteria->compare('sale_price',$this->sale_price);
		$criteria->compare('previous_price',$this->previous_price);
		$criteria->compare('status_updates',$this->status_updates,true);
		$criteria->compare('t_status_date',$this->t_status_date,true);
		$criteria->compare('internet',$this->internet,true);
		$criteria->compare('idx',$this->idx,true);
		$criteria->compare('images',$this->images);
		$criteria->compare('photo_excluded',$this->photo_excluded,true);
		$criteria->compare('photo_instructions',$this->photo_instructions,true);
		$criteria->compare('lpsqft_wcents',$this->lpsqft_wcents,true);
		$criteria->compare('lpsqft',$this->lpsqft,true);
		$criteria->compare('spsqft_wcents',$this->spsqft_wcents,true);
		$criteria->compare('splp',$this->splp,true);
		$criteria->compare('public_address',$this->public_address,true);
		$criteria->compare('commentary',$this->commentary,true);
		$criteria->compare('avm',$this->avm,true);
		$criteria->compare('documentfolderid',$this->documentfolderid);
		$criteria->compare('documentfoldercount',$this->documentfoldercount);
		$criteria->compare('record_delete_date',$this->record_delete_date,true);
		$criteria->compare('record_delete_flag',$this->record_delete_flag,true);
		$criteria->compare('directions',$this->directions,true);
		$criteria->compare('contingency_desc',$this->contingency_desc,true);
		$criteria->compare('temp_off_mrkt_status_desc',$this->temp_off_mrkt_status_desc,true);
		$criteria->compare('possession_description',$this->possession_description,true);
		$criteria->compare('statuschangedate',$this->statuschangedate,true);
		$criteria->compare('entry_date',$this->entry_date,true);
		$criteria->compare('acceptance_date',$this->acceptance_date,true);
		$criteria->compare('dom',$this->dom);
		$criteria->compare('active_dom',$this->active_dom);
		$criteria->compare('est_clolse_dt',$this->est_clolse_dt,true);
		$criteria->compare('actual_close_date',$this->actual_close_date,true);
		$criteria->compare('days_from_listing_to_close',$this->days_from_listing_to_close);
		$criteria->compare('last_transaction_code',$this->last_transaction_code,true);
		$criteria->compare('last_transaction_date',$this->last_transaction_date,true);
		$criteria->compare('package_available',$this->package_available,true);
		$criteria->compare('property_insurance',$this->property_insurance);
		$criteria->compare('sold_appraisal',$this->sold_appraisal);
		$criteria->compare('sold_down_payment',$this->sold_down_payment);
		$criteria->compare('earnest_deposit',$this->earnest_deposit);
		$criteria->compare('sellers_contribution',$this->sellers_contribution);
		$criteria->compare('financing_considered',$this->financing_considered,true);
		$criteria->compare('amt_owner_will_carry',$this->amt_owner_will_carry);
		$criteria->compare('existing_rent',$this->existing_rent);
		$criteria->compare('nod_date',$this->nod_date,true);
		$criteria->compare('reporeo',$this->reporeo,true);
		$criteria->compare('auction_date',$this->auction_date,true);
		$criteria->compare('auction_type',$this->auction_type,true);
		$criteria->compare('additional_au_sold_terms',$this->additional_au_sold_terms,true);
		$criteria->compare('litigation',$this->litigation,true);
		$criteria->compare('litigation_type',$this->litigation_type,true);
		$criteria->compare('studio_rent',$this->studio_rent);
		$criteria->compare('cap_rate',$this->cap_rate,true);
		$criteria->compare('gross_rent_multiplier',$this->gross_rent_multiplier,true);
		$criteria->compare('owner_will_carry',$this->owner_will_carry,true);
		$criteria->compare('current_loan_assumable',$this->current_loan_assumable,true);
		$criteria->compare('cash_to_assume',$this->cash_to_assume);
		$criteria->compare('cost_per_unit',$this->cost_per_unit);
		$criteria->compare('gross_operating_income',$this->gross_operating_income);
		$criteria->compare('yearly_operating_income',$this->yearly_operating_income);
		$criteria->compare('tenant_pays',$this->tenant_pays,true);
		$criteria->compare('other_income_description',$this->other_income_description,true);
		$criteria->compare('amount_owner_will_carry',$this->amount_owner_will_carry);
		$criteria->compare('noi',$this->noi);
		$criteria->compare('yearly_operating_expense',$this->yearly_operating_expense);
		$criteria->compare('yearly_other_income',$this->yearly_other_income);
		$criteria->compare('other_encumbrance_desc',$this->other_encumbrance_desc,true);
		$criteria->compare('expense_source',$this->expense_source,true);
		$criteria->compare('vacancy',$this->vacancy);
		$criteria->compare('service_contract_inc',$this->service_contract_inc,true);
		$criteria->compare('parcel_num',$this->parcel_num,true);
		$criteria->compare('legal_location_range',$this->legal_location_range);
		$criteria->compare('legal_lctn_range_search',$this->legal_lctn_range_search);
		$criteria->compare('legal_location_section',$this->legal_location_section);
		$criteria->compare('legal_lctn_section_search',$this->legal_lctn_section_search);
		$criteria->compare('legal_location_township',$this->legal_location_township);
		$criteria->compare('legal_lctntownship_search',$this->legal_lctntownship_search);
		$criteria->compare('tax_district',$this->tax_district,true);
		$criteria->compare('assessed_imp_value',$this->assessed_imp_value);
		$criteria->compare('assessed_land_value',$this->assessed_land_value);
		$criteria->compare('block_number',$this->block_number,true);
		$criteria->compare('lot_number',$this->lot_number,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return PropertyInfoAdditionalBrokerageDetails the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
