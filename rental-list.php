<?php
/*
Template Name: Rental-list
*/
?>
<?php get_header(); ?>
<section class="product-techonlogy-banner fadeInUp">
		<div class="product-techonlogy-banner-box inner">
			<div class="product-techonlogy-banner-text">
				<div class="crumbs-links">
					<span>Products</span>
				</div>
				<div class="crumbs-title">
			    <h1 class="rental-availability-title"><?php echo get_the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="fusce-dapibus-box inner fadeInUp">
<div class="fusce-dapibus-text editor">
<?php echo get_post()->post_content; ?>
</div></div>
<section class="product-techonlogy fadeInUp">
<div class="product-techonlogy-box">
<div class="product-techonlogy-content">

<div class="product-techonlogy-left">
		<div class="product-techonlogy-left-box">
			
			<div class="screen-title-mobile">
				<p>Filter By</p>
			</div>
			<div class="screen-mobile-block">
			<div class="screen-select">
                <p>Location</p>
                <div class="screen-box screen-parent">
                    <input type="text" placeholder="All" data-slug="all" id="location_select">
                    <a class="screen-previous icon iconfont iconPolygon-copy"></a>
                    <a class="screen-next icon iconfont iconPolygon"></a>
                    <ul id="location-ul">
                        <li>All</li>
                        <li data-slug="Adelaide" data-id="Adelaide">Adelaide</li>
                        <li data-slug="Brisbane" data-id="Brisbane">Brisbane</li>
                        <li data-slug="Darwin" data-id="Darwin">Darwin</li>
                        <li data-slug="Kalgoorlie" data-id="Kalgoorlie">Kalgoorlie</li>
                        <li data-slug="Mackay" data-id="Mackay">Mackay</li>
                        <li data-slug="Melbourne" data-id="Melbourne">Melbourne</li>
                        <li data-slug="Newcastle" data-id="Newcastle">Newcastle</li>
                        <li data-slug="Perth" data-id="Perth">Perth</li>
                        <li data-slug="Sydney" data-id="Sydney">Sydney</li>
                        <li data-slug="Tasmania" data-id="Tasmania">Tasmania</li>
                    </ul>
                </div>
            </div>
            <div class="screen-select">
                <p>Category</p>
                <div class="screen-box screen-parent">
                    <input type="text" placeholder="All" data-slug="all" id="category_select">
                    <a class="screen-previous icon iconfont iconPolygon-copy"></a>
                    <a class="screen-next icon iconfont iconPolygon"></a>
                    <ul id="category-ul">
                        <li>All</li>
                        <li data-slug="receiver" data-id="receiver">Air Receiver</li>
                        <li data-slug="air-treatment" data-id="air_treatment">Air Treatment</li>
                        <li data-slug="blower" data-id="blower">Blower</li>
                        <li data-slug="dryer" data-id="dryer">Dryer</li>
                        <li data-slug="desiccant-dryer" data-id="desiccant_dryer">Desiccant Dryer</li>
                        <li data-slug="refrigerated_dryer" data-id="refrigerated-dryer">Refrigerated Dryer</li>
                        <li data-slug="generator" data-id="generator">Generator</li>
                        <!-- li data-slug="compressor" data-id="compressor">Air Compressors</li> -->
                        <li data-slug="portable-compressor" data-id="portable_compressor">Portable Compressor</li>
                        <li data-slug="air-compressor" data-id="air_compressor">Reciprocating Air Compressor</li>
                        <li data-slug="rotary-screw-compressor" data-id="rotary_screw_compressor">Rotary Screw Air Compressor</li>
                    </ul>
                </div>
            </div>
			</div>
			
			<?php
			// Filter definitions
			$filters = [
			    'cfm' => [
			        'label' => 'capacity_cfm',
			        'name' => 'Capacity (CFM)',
			        'min_range' => 8,
			        'max_range' => 1920,
			    ],
			    'm3min' => [
			        'label' => 'capacity_m3min',
			        'name' => 'Capacity (m3/min)',
			        'min_range' => 0,
			        'max_range' => 55,
			    ],
			    'psi' => [
			        'label' => 'capacity_psi',
			        'name' => 'Pressure (psi)',
			        'min_range' => 5,
			        'max_range' => 220,
			    ],
			    'kva' => [
			        'label' => 'prime_power_kva',
			        'name' => 'Prime Power(kVA)',
			        'min_range' => 6,
			        'max_range' => 886,
			    ],
			    'kw' => [
			        'label' => 'prime_power_kw',
			        'name' => 'Prime Power(kW)',
			        'min_range' => 6,
			        'max_range' => 708,
			    ],
			];

			// Get query string values
			$url_arr = $_GET;

			// Initialize filter values
			$filter_values = [];
			foreach ($filters as $key => $filter) {
			    $filter_values[$key] = [
			        'active_class' => '',
			        'min_range' => $filter['min_range'],
			        'max_range' => $filter['max_range'],
			    ];
			}

			// Check if query string values are set
			if (count($url_arr) > 2) {
			    foreach ($filters as $key => $filter) {
			        if (isset($url_arr[$key . '_min']) && $url_arr[$key . '_min'] !== $filter[$key]['min_range']) {
			            $filter_values[$key]['min_range'] = $url_arr[$key . '_min'];
			        }
			        if (isset($url_arr[$key . '_max']) && $url_arr[$key . '_max'] !== $filter['max_range']) {
			            $filter_values[$key]['max_range'] = $url_arr[$key . '_max'];
			        }
			    }
			}

            // Determine slider visibility
			$openCompressorSliders = in_array($url_arr['category'], ['Reciprocating Air Compressor', 'Portable Compressor', 'Rotary Screw Air Compressor']);
			$openGeneratorSliders = $url_arr['category'] === 'Generator';
			?>

            <!-- Start of range slider -->
            <div class="screen-number compressors <?php echo $openCompressorSliders ? 'opencompressorsliders' : ''; ?>" data-label="<?php echo $filters['cfm']['label']; ?>" id="<?php echo $filters['cfm']['label']; ?>">
				<div class="screen-number-title">
					<p><?php echo $filters['cfm']['name']; ?></p>
				</div>
				<div class="screen-number-content screen-number-content-one" data-min="8" data-max="1920" data-min-current="<?php echo $filter_values['cfm']['min_range']; ?>" data-max-current="<?php echo $filter_values['cfm']['max_range']; ?>">
					<div class="rate-values">
						<div class="min-value"><input class="input-0" id="input-with-keypress-one-0" type="text"></div>
						<div class="max-value"><input class="input-1" id="input-with-keypress-one-1" type="text"></div>
					</div>
					<div id="price-range-slider-one" class="price-range-slider compressor-slider"></div>
				</div>
			</div>
			<!-- Start of range slider -->
            <div class="screen-number compressors <?php echo $openCompressorSliders ? 'opencompressorsliders' : ''; ?>" data-label="<?php echo $filters['m3min']['label']; ?>" id="<?php echo $filters['m3min']['label']; ;?>">
				<div class="screen-number-title">
					<p><?php echo $filters['m3min']['name']; ?></p>
				</div>
				<div class="screen-number-content screen-number-content-one" data-min="0" data-max="55" data-min-current="<?php echo $filter_values['m3min']['min_range']; ?>" data-max-current="<?php echo $filter_values['m3min']['max_range']; ?>">
					<div class="rate-values">
						<div class="min-value"><input class="input-0" id="input-with-keypress-one-0" type="text"></div>
						<div class="max-value"><input class="input-1" id="input-with-keypress-one-1" type="text"></div>
					</div>
					<div id="price-range-slider-one" class="price-range-slider compressor-slider"></div>
				</div>
			</div>
			<!-- Start of range slider -->
            <div class="screen-number compressors <?php echo $openCompressorSliders ? 'opencompressorsliders' : ''; ?>" data-label="<?php echo $filters['psi']['label']; ?>" id="<?php echo $filters['psi']['label']; ?>">
				<div class="screen-number-title">
					<p><?php echo $filters['psi']['name']; ?></p>
				</div>
				<div class="screen-number-content screen-number-content-one" data-min="5" data-max="220" data-min-current="<?php echo $filter_values['psi']['min_range']; ?>" data-max-current="<?php echo $filter_values['psi']['max_range']; ?>">
					<div class="rate-values">
						<div class="min-value"><input class="input-0" id="input-with-keypress-one-0" type="text"></div>
						<div class="max-value"><input class="input-1" id="input-with-keypress-one-1" type="text"></div>
					</div>
					<div id="price-range-slider-one" class="price-range-slider compressor-slider"></div>
				</div>
			</div>
			<!-- end slider -->
			
			<!-- Power Generator Sliders -->
            <div class="screen-number generators <?php echo $openGeneratorSliders ? 'opengeneratorliders' : ''; ?>" data-label="<?php echo $filters['kva']['label']; ?>" id="<?php echo $filters['kva']['label']; ?>">
				<div class="screen-number-title">
					<p><?php echo $filters['kva']['name']; ?></p>
				</div>
				<div class="screen-number-content screen-number-content-one" data-min="6" data-max="886" data-min-current="<?php echo $filter_values['kva']['min_range']; ?>" data-max-current="<?php echo $filter_values['kva']['max_range']; ?>">
					<div class="rate-values">
						<div class="min-value"><input class="input-0" id="input-with-keypress-one-0" type="text"></div>
						<div class="max-value"><input class="input-1" id="input-with-keypress-one-1" type="text"></div>
					</div>
					<div id="price-range-slider-one" class="price-range-slider power-gen-slider"></div>
				</div>
			</div>
			
			<div class="screen-number generators <?php echo $openGeneratorSliders ? 'opengeneratorliders' : ''; ?>" data-label="<?php echo $filters['kw']['label']; ?>" id="<?php echo $filters['kw']['label']; ?>">
				<div class="screen-number-title">
					<p><?php echo $filters['kw']['name']; ?></p>
				</div>
				<div class="screen-number-content screen-number-content-one" data-min="6" data-max="708" data-min-current="<?php echo $filter_values['kw']['min_range']; ?>" data-max-current="<?php echo $filter_values['kw']['max_range']; ?>">
					<div class="rate-values">
						<div class="min-value"><input class="input-0" id="input-with-keypress-one-0" type="text"></div>
						<div class="max-value"><input class="input-1" id="input-with-keypress-one-1" type="text"></div>
					</div>
					<div id="price-range-slider-one" class="price-range-slider power-gen-slider"></div>
				</div>
			</div>			
			<div class="screen-button">
				<a data-url="<?php echo home_url() ?>" class="links-red rental-search">Apply</a>
				<a href="<?php echo home_url('/rental-availability/') ?>" class="links-black screen-clear-all">Clear All</a>
			</div>
		</div>
        <div class="details-enquire rent-catalogue-pdf" style="margin-top:20px"><a href="/wp-content/uploads/2024/10/CAPS-Rental-Availability-list-October-2024.pdf" target="_blank" class="links-red" style="width:100%;padding:0 20px">Download<br>catalogue</a></div>
        <div class="not-sure-what-product">
			<a href="/contact">
				<img class="lazy loaded" src="https://www.caps.com.au/wp-content/themes/caps/images/what-icon.svg" data-src="https://www.caps.com.au/wp-content/themes/caps/images/what-icon.svg" alt="icon" data-was-processed="true">
				<h6>Not sure what you’re looking for?</h6>
			</a>
		</div>
</div>

<div class="product-techonlogy-right">
<div class="product-techonlogy-list">
    
<?php
function current_page_url() {
$page_url = 'http';
if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
    $page_url .= "s";
}
	$page_url .= "://";
if ($_SERVER["SERVER_PORT"] != "80") {
	$page_url .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
} else {
	$page_url .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
}
	return $page_url;
}

global $wpdb;
$default_image = "https://www.caps.com.au/wp-content/uploads/2024/07/default-rental-placeholder.png";
$caps_rental_logo = "https://www.caps.com.au/wp-content/uploads/2024/07/logo_Artboard-1.png";

$path_array = parse_url(current_page_url());
$pagenumber = substr($path_array['path'], -2,1);
$page_number = (float)$pagenumber;

//$rental_rows = $wpdb->get_results("SELECT COUNT(*) as num_rows FROM available_rental_upgrade2");
$rental_rows = $wpdb->get_results( "SELECT DISTINCT hire_status, branch, product_code, category, photo FROM available_rental_upgrade2 where product_code IN('MM160KT','Ml200-2S-LV','SDG125LX-5B1N','SDG300S-3A6','SDG220S-3A7','PDS400SC-6B5-T','PDSF1000DPC-4C5','PDSG750SD-4C5','PDSF920SC-4B3',
'PDS655SD-4B2','PDS400SC-6B5-T','PDS185SC-6C2-T','PDS100SC-5C5','PDS100LC-5C5','PDS80SC-5C5') GROUP BY(branch)");
$pageload_count = count($rental_rows);
$total_pages_roundedup = ceil($pageload_count/9);

if($page_number == 0){$paged_from = 0;}
if($page_number >= 2){$paged_from = ($page_number-1) *9;}

if(empty($path_array['query'])){
     $where_string = "";
}else{
    $where_string = " where ";
}

$query_string = $_SERVER['QUERY_STRING'];
$my_arr = [];
if (!empty($query_string)) {
  parse_str($query_string, $my_arr);
}

$queryStringLength = count($my_arr);
$my_arr_string = json_encode($my_arr);
//echo "<script>console.log(".$keyLength.");</script>";
//echo "<script>console.log(".$my_arr_string.");</script>";
$valueLength_arr = [];

foreach($my_arr as $key=>$value){
    //echo "$key => $value<br>";
    
    //$keyLength = $key;
    //$valueLength = 'Val: '.$value.' - '.strlen($value);
    $valueLength = strlen($value);
    array_push($valueLength_arr, $valueLength);
    
    $count ++;
    //Link from hubspot email validation
    if ($key == "utm_medium" || $key == "_hsencBw" || $key == "_hsenc" || $key == "email" || $key == "utm_source" || $key == "_hsenc" ){$key = "branch";}
    if ($key == "location" ){$key = "branch";}
    
    //Link from hubspot email validation
    if ($value == "email" || $value == "_hsencBw" || $value == "_hsenc" || $valueLength > 80){$value = "";}
    
    if ($value == "Perth" ){$value = "ST";}
    if ($value == "All" ){$value = "";}
    
    if ($count == 1){$where_and = " AND ";}
    else{
        $where_and = "";
    }
    $where_string .= " ".$key. " like " ."'%".$value."'";
    $where_string .= $where_and;
    
    if ($count == 2){
        break;
    }
}

$valueLengthString = json_encode($valueLength_arr);
//echo "<script>console.log(".$keyLength.");</script>";
//echo "<script>console.log(".$valueLengthString.");</script>";

$notShowingAllResults = "";
$between_string = '';

if($my_arr['cfm_min'] > 8 && $my_arr['cfm_max'] < 1920){
    $between_string_cfm = " AND product_cfm BETWEEN ".$my_arr['cfm_min']." AND ".$my_arr['cfm_max'];
    $where_string.= $between_string_cfm;
}
if($my_arr['m3min_min'] > 0 && $my_arr['m3min_max'] < 55){
    $between_string_m3min = " OR product_cap_mmin BETWEEN ".$my_arr['m3min_min']." AND ".$my_arr['m3min_max'];
    $where_string.= $between_string_m3min;
}
if($my_arr['psi_min'] > 5 && $my_arr['psi_max'] < 220){
    $between_string_psi = " OR product_psi_working BETWEEN ".$my_arr['psi_min']." AND ".$my_arr['psi_max'];
    $where_string.= $between_string_psi;
}

//Query string for Generator - kVA / KW
//Check the database fields for the kVA and KW
if($my_arr['kva_min'] > 6 && $my_arr['kva_max'] < 886){
    $between_string_kva = " AND prime_power_kva BETWEEN ".$my_arr['kva_min']." AND ".$my_arr['kva_max'];
    $where_string.= $between_string_kva;
}
if($my_arr['kw_min'] > 6 && $my_arr['kw_max'] < 708){
    $between_string_kw = " OR prime_power_kw BETWEEN ".$my_arr['kw_min']." AND ".$my_arr['kw_max'];
    $where_string.= $between_string_kw;
}

if($queryStringLength >= 3){
    //$where_string.=  $between_string;
    $notShowingAllResults = ""; //"Select All in the Category dropdown with the location you want";
}

//this is the loading query and selects the airmans
if(empty($my_arr)){
$myrows = $wpdb->get_results( "SELECT DISTINCT product_title, hire_status, branch, product_code, category, photo FROM available_rental_upgrade2 where product_code IN('MM160KT','Ml200-2S-LV','SDG125LX-5B1N','SDG300S-3A6','SDG220S-3A7','PDS400SC-6B5-T','PDSF1000DPC-4C5','PDSG750SD-4C5','PDSF920SC-4B3',
'PDS655SD-4B2','PDS400SC-6B5-T','PDS185SC-6C2-T','PDS100SC-5C5','PDS100LC-5C5','PDS80SC-5C5') ORDER BY branch ASC, category ASC LIMIT ".$paged_from.",9"); //GROUP BY(product_code)

$all_rows = $wpdb->get_results( "SELECT DISTINCT hire_status, branch, product_code, category, photo FROM available_rental_upgrade2 where product_code IN('MM160KT','Ml200-2S-LV','SDG125LX-5B1N','SDG300S-3A6','SDG220S-3A7','PDS400SC-6B5-T','PDSF1000DPC-4C5','PDSG750SD-4C5','PDSF920SC-4B3',
'PDS655SD-4B2','PDS400SC-6B5-T','PDS185SC-6C2-T','PDS100SC-5C5','PDS100LC-5C5','PDS80SC-5C5')");
$products_in = count($all_rows);
}


// ---- The main query to display paged items ----- //
//Working query to use - removed select * and no duplicates
if(!empty($my_arr)){
$myrows = $wpdb->get_results( "SELECT DISTINCT product_title, hire_status, branch, product_code, category, photo FROM available_rental_upgrade2 ".$where_string." ORDER BY branch ASC, category ASC LIMIT ".$paged_from.",9");
//print_r($wpdb->last_query. "<br><br>");
//print_r($wpdb->last_result. "<br><br>");

$stringRepresentation = json_encode($wpdb->last_query);
//echo "<script>console.log('### last_query ###');</script>";
//echo "<script>console.log(".$stringRepresentation.");</script>";

$allrows = $wpdb->get_results( "SELECT DISTINCT hire_status, branch, product_code, category, photo FROM available_rental_upgrade2 ".$where_string);
$products_distinct = count($allrows);
//print_r("Count ".$products_distinct);
//$myrows = $wpdb->get_results( "SELECT * from available_rental_upgrade2 ".$where_string." LIMIT ".$paged_from.",9");
}

if(!empty($my_arr)){
    $total_rows = $products_distinct;
    $total_pages = $total_rows/9;
    $total_pages_roundedup = ceil($total_pages);
} 
else{
    $total_rows = $products_in;
    $total_pages = $total_rows/9;
    $total_pages_roundedup = ceil($total_pages);
}

//Add defined datasheets to model numbers
$datasheets = [
["model"=>"Example","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Portable-Diesel-Compressor.pdf"],
["model"=>"PDS400SC-6B5-T","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDS400SC-6B5-T-400CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDS80SC-5C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-PDS80SC-5C5.pdf"],
["model"=>"PDSF920SC-4B3","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDSF920SC-4B3-920CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDSF1000DPC-4C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDSF1000DPC-4C5-Portable-Diesel-Compressor.pdf"],
["model"=>"PDS185SC-6C2-T","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-PDS185SC-6C2-T-185CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDS900VRSD-4C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-PDS900VRSD-4C5-900CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDS100LC-5C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDS100LC-5C5-100CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDS400SC-6B5-T","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDS400SC-6B5-T-400CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"PDSG1400LVR-5C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-PDSG1400LVR-5C5-1500CFM-Portable-Diesel-Compressor.pdf"],
["model"=>"SDG300S-3A6","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-SDG300S-3A6.pdf"],
["model"=>"PS200K","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PS200K.pdf"],
["model"=>"PDS655SD-4B2","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDS655SD-4B2.pdf"],
["model"=>"PDS185SC-5C5","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-PDS185SC-5C5.pdf"],
["model"=>"CP13S-TP1","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-CP13S-TP1.pdf"],
["model"=>"CR15","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-CR15.pdf"],
["model"=>"CDRL800-4","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-CDRL800-4.pdf"],
["model"=>"HR3000-1400R","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-HR3000-1400R.pdf"],
["model"=>"UP5-18-10","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/CAPS-Rental-Spec-Sheet-UP5-18-10.pdf"],
["model"=>"SDG220S-3A7","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-SDG220S-3A7-200KVA-PRIME-POWER-GENERATOR.pdf"],
["model"=>"SDG125LX-5B1N","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-SDG125LX-5B1N-100KVA-PRIME-POWER-GENERATOR.pdf"],
["model"=>"SDG13LX-5B1N","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-SDG13LX-5B1N-10.5KVA-PRIME-POWER-GENERATOR.pdf"],
["model"=>"SDG300S-3A6","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-SDG300S-3A6-270KVA-PRIME-POWER-GENERATOR.pdf"],
["model"=>"SDG60S-7A6N","datasheet"=>"https://www.caps.com.au/wp-content/uploads/2024/07/Rental-Spec-Sheet-SDG60-7A6N-50KVA-PRIME-POWER-GENERATOR.pdf"]];

//Add defined photos to model numbers
$productphotos = [
["model"=>"MM160KT","productphoto"=>"https://www.caps.com.au/wp-content/uploads/2020/09/MM160KT-MinersPack-Rental.png"],
["model"=>"MM160KTMINEPACK – 415V","productphoto"=>"https://www.caps.com.au/wp-content/uploads/2020/09/MM160KT-MinersPack-Rental.png"],
["model"=>"MM160KTMINEPACK – 1000V","productphoto"=>"https://www.caps.com.au/wp-content/uploads/2020/09/MM160KT-MinersPack-Rental.png"],
["model"=>"PDS185SC-6C1-T","productphoto"=>"https://www.caps.com.au/wp-content/uploads/2022/07/PDS185_7.png"],
["model"=>"PDS390SC-5B1","productphoto"=>"https://www.caps.com.au/wp-content/uploads/2022/09/pds390-web.jpg"]];

function searchArrayKeyVal($sKey, $id, $array) {
   foreach ($array as $key => $val) {
       if ($val[$sKey] == $id) {
           return $key;
       }
   }
   return false;
}

if(empty($my_arr)){
echo "<h3 style='margin-left: 13px;'>Featured rentals</h3>";
}

echo "<p style='margin-left: 16px;'>".$notShowingAllResults."</p>";
echo "<ul>";
if ($total_rows >0){
    
foreach ( $myrows as $row ){
$location = substr($row->branch, 14);

if($location == 'PLANET ST' || $location == 'PRESIDENT ST'){
    $location = "PERTH";
}

    echo "<li><div class='products-box'><div class='img-and-title'>";
    
     // Obtain The Key Of The Product photo Array
    $arrayKeyPp = searchArrayKeyVal("model", $row->product_code, $productphotos);
    
    if(!empty($row->photo)){
        echo '<img class="database" src="'.aq_resize($row->photo,438,358,true,true,true).'" alt="Photo not found" style="height: 175px;" />';
    }
    else if ($arrayKeyPp!==false) {
        echo '<img class="defined" src="'.$productphotos[$arrayKeyPp]['productphoto'].'" alt="Photo not found" />';
    }else{
        echo '<img class="default" src="'.$default_image.'" alt="'.$row->product_code.'" />';
    }

    //product_title
    if(!empty($row->product_title)):
        echo "<h6>".$row->product_title."</h6></div>"; //product_title
    else:
        echo "<h6>".$row->product_code."</h6></div>";
    endif;
    
    echo '<div class="text-and-link"><div class="parameter">';
    echo "<div class='parameter-box'><p>Location</p><p>".$location."</p></div>";
    echo "<div class='parameter-box'><p>Model</p><p>".$row->product_code."</p></div>";
    echo "<div class='parameter-box'><p>Category</p><p>".$row->category."</p></div>";
    
    // Obtain The Key Of The Datasheet Array
    $arrayKey = searchArrayKeyVal("model", $row->product_code, $datasheets);
    if ($arrayKey!==false) {
        echo "<div class='parameter-box'>";
        echo '<p>&nbsp;</p><p><a href="'.$datasheets[$arrayKey]['datasheet'].'" target="_blank">Download datasheet</a></p>';
        echo '</div>';
    } else {
        echo "";
    }
    
    echo "</div></div>";
    echo '<div class="details-enquire"><a href="https://www.caps.com.au/rental-quote-request-form-availability/?model='.$row->product_code.'" class="links-red">Enquire Now</a></div>';
    //echo '<div class="details-enquire"><a href="javascript:void();" class="links-red">Enquire Now</a></div>';
    echo "</div></li>";
}
}else{
    echo '<div style="margin-left:13px"><strong>Try another search or contact us.</strong><br><br><div><a href="https://www.caps.com.au/rental-quote-request-form/" class="links-red">Enquire Now</a></div></div>';
}
?>
</ul>

<?php
$wp_query = null;
$paged = ($page_number) ? $page_number : 1;
$meta_array = array();
array_push($meta_array,
    array(
    'key' => "total_pages_roundedup",
    'value' => $total_pages_roundedup,
    'total_pages_roundedup' => $total_pages_roundedup
    )
);
$args=array(
  	'meta_query' => $meta_array,
  	'paged' => $paged
);
$wp_query_rental = new WP_Query( $args );
custom_pagenavi($wp_query_rental); //pagination
?>

<div id="productNums" data-num="<?php echo $total_rows;?>" style="display: none;"></div>
</div>
</div>
</div>
</div>
</section>

<!-- Hard coded content until a custom field is setup -->
<div class="fusce-dapibus-box inner fadeInUp">
<div class="fusce-dapibus-text editor">
<h4 class="wp-block-heading">‘Mine Spec’ to support your operations</h4>
<p>The large range of new ‘mine spec’ equipment is ready for immediate dispatch from our local hubs - serviced and ready for work, with standby, 12 hour and 24 hour duty pricing arrangements.</p>
<p>Hiring CAPS Rental equipment gives you access to a huge range of the latest equipment and newest technologies.Trialling new equipment can ensure you are always using the right equipment for your job, and we ensure that the equipment you are using is always up to standard and meets regulations.</p>
<p>When you contact CAPS to arrange a rental, you are speaking to an expert who can help you choose the right equipment for your job. Once the job is finished, the equipment can be returned, without the worry of depreciation, repairs and maintenance and storage costs, or future uses for that piece of equipment. If you need it again, you can always contact CAPS.</p>
</div></div>

<section class="nationwide">
		<div class="nationwide-box inner wowo fadeInUp">
			<?php the_field('advantage_content','options')?>
			<ul>
				<?php
					if(have_rows('advantage_blocks','options')):
						while (have_rows('advantage_blocks','options')) : the_row();
							$image = get_sub_field('image');
					?>
						<li>
							<img src="<?php echo $image['url']?>" alt="" />
							<p><?php the_sub_field('title')?></p>
						</li>
				<?php
					endwhile;
					else:
					endif;
				?>
			</ul>
		</div>
</section>
<?php get_footer(); ?>


<script>
//On load - open the side bar with previous filter
var _previous_filter = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
//console.log("_previous_filter: " + _previous_filter);

//Hide all onload
var rangeSliders = jQuery('.screen-number.compressors');
for ( var i = 0; i < rangeSliders.length; i++ ) {
	jQuery(".screen-number.compressors").css('display','none');
    jQuery(".screen-number-title").css('display','none');
    jQuery(".screen-number-title.isnot-active").css('display','none');
    jQuery(".screen-number.compressors").eq(i).find('.screen-number-title').toggleClass("isnot-active");
    jQuery(".screen-number.compressors").eq(i).find('.screen-number-content').css('display','none');
}

if (_previous_filter.length > 1){
    var _split1 = _previous_filter[0].split("=");
    var _split2 = _previous_filter[1].split("=");
}


if (_previous_filter.length > 1 && _split1[0] != 'utm_medium'){
    var _loc_split = _previous_filter[0].split("=");
    var _cat_split = _previous_filter[1].split("=");
    //console.log("_cat_split[1] " + _cat_split[1]);

    if(_loc_split[1] != ""){
        //var _loc_split = _previous_filter[0].split("=");
        //console.log("_loc_split " + _loc_split[1]);
        jQuery("#location_select").attr('data-slug',_loc_split[1]);
        jQuery("#location_select").attr('placeholder',_loc_split[1]);
        jQuery("#location_select").val(_loc_split[1]);
    }
    if(_cat_split[1] != ""){
        var cat_placeholder = decodeURI(_cat_split[1]);
        //console.log("cat_placeholder " + cat_placeholder);
        
        jQuery("#category_select").attr('data-slug',cat_placeholder);
        jQuery("#category_select").attr('placeholder',cat_placeholder);
        jQuery("#category_select").val(cat_placeholder);
    }
        
    if(_cat_split[1] != "" && cat_placeholder == "Portable Compressor" || _cat_split[1] != "" && cat_placeholder == "Reciprocating Air Compressor" || _cat_split[1] != "" && cat_placeholder == "Rotary Screw Air Compressor"){
        
        var closedCompressorDropdowns = jQuery('.screen-number.compressors');
        for ( var i = 0; i < closedCompressorDropdowns.length; i++ ) {
            jQuery(".screen-number.compressors").css('display','block');
            jQuery("#capacity_cfm .screen-number-title").css('display','block');
            jQuery("#capacity_m3min .screen-number-title").css('display','block');
            jQuery("#capacity_psi .screen-number-title").css('display','block');
            
            jQuery(".screen-number.compressors").eq(i).find('.screen-number-title').css('display','block');
            jQuery(".screen-number.compressors").eq(i).find('.screen-number-content').css('display','block');
        }
        
    }else{
        var closedCompressorDropdowns = jQuery('.screen-number.compressors');
        for ( var i = 0; i < closedCompressorDropdowns.length; i++ ) {
            jQuery(".screen-number.compressors").css('display','none');
            jQuery("#capacity_cfm .screen-number-title").css('display','none');
            jQuery("#capacity_m3min .screen-number-title").css('display','none');
            jQuery("#capacity_psi .screen-number-title").css('display','none');
            
            jQuery(".screen-number.compressors").eq(i).find('.screen-number-title').css('display','none');
            jQuery(".screen-number.compressors").eq(i).find('.screen-number-content').css('display','none');
        }
    }
    if(_cat_split[1] != "" && cat_placeholder == "generator"){
        
        var closedGeneratorDropdowns = jQuery('.screen-number.generators');
        for ( var i = 0; i < closedGeneratorDropdowns.length; i++ ) {
            jQuery(".screen-number.generators").css('display','block');
            jQuery("#prime_power_kva .screen-number-title").css('display','block');
            jQuery("#prime_power_kw .screen-number-title").css('display','block');
            jQuery(".screen-number.generators").eq(i).find('.screen-number-title').css('display','block');
            jQuery(".screen-number.generators").eq(i).find('.screen-number-content').css('display','block');
        }
        
    }else{
        
        var closedGeneratorDropdowns = jQuery('.screen-number.generators');
        for ( var i = 0; i < closedGeneratorDropdowns.length; i++ ) {
            jQuery(".screen-number.generators").css('display','none');
            jQuery("#prime_power_kva .screen-number-title").css('display','none');
            jQuery("#prime_power_kw .screen-number-title").css('display','none');
            jQuery(".screen-number.generators").eq(i).find('.screen-number-title').css('display','none');
            jQuery(".screen-number.generators").eq(i).find('.screen-number-content').css('display','none');
        }
    }
}


/* When selecting a category */
jQuery("#category-ul li").click(function(){
    var catSelect = jQuery(this).attr('data-id');
    //console.log("Selection:" + catSelect);
    
    //When selecting generator show range slider
    if(catSelect == "compressor" || catSelect == "portable_compressor" || catSelect == "air_compressor" || catSelect == "rotary_screw_compressor"){
        //Only show the compressor sliders
        var rangeSliders = jQuery('.screen-number.compressors');
	    for ( var i = 0; i < rangeSliders.length; i++ ) {
    		jQuery(".screen-number.compressors").css('display','block');
	        jQuery(".screen-number.compressors .screen-number-title").css('display','block');
	        jQuery(".screen-number.compressors").eq(i).find('.screen-number-title').toggleClass("is-active");
		    jQuery(".screen-number.compressors").eq(i).find('.screen-number-content').css('display','block');
	     }
    }else{
        var rangeSliders = jQuery('.screen-number.compressors');
	    for ( var i = 0; i < rangeSliders.length; i++ ) {
    		jQuery(".screen-number.compressors").css('display','none');
	        jQuery(".screen-number.compressors .screen-number-title").css('display','none');
	        jQuery(".screen-number.compressors").eq(i).find('.screen-number-title').toggleClass("isnot-active");
		    jQuery(".screen-number.compressors").eq(i).find('.screen-number-content').css('display','none');
	     }
    }
    if(catSelect == "generator"){
        //Only show the generator sliders
        var rangeSliders = jQuery('.screen-number.generators');
    	for ( var i = 0; i < rangeSliders.length; i++ ) {
    		jQuery(".screen-number.generators").css('display','block');
    	    //jQuery(".screen-number-title").css('display','block');
    	    jQuery(".screen-number.generators .screen-number-title").css('display','block');
    	    jQuery(".screen-number.generators").eq(i).find('.screen-number-title').toggleClass("is-active");
    	    jQuery(".screen-number.generators").eq(i).find('.screen-number-content').css('display','block');
    	}
    }else{
        var rangeSliders = jQuery('.screen-number.generators');
    	for ( var i = 0; i < rangeSliders.length; i++ ) {
    		jQuery(".screen-number.generators").css('display','none');
    	    //jQuery(".screen-number-title").css('display','none');
    	    jQuery(".screen-number.generators .screen-number-title").css('display','none');
    	    jQuery(".screen-number.generators").eq(i).find('.screen-number-title').toggleClass("isnot-active");
    	    jQuery(".screen-number.generators").eq(i).find('.screen-number-content').css('display','none');
    	}
    }
});
</script>
<script>
//When clicking the Apply btn create the URL with the query string
jQuery('.rental-search').click(function(event){
    
    event.stopPropagation();
    var _location = jQuery('#location_select').val();
    var _category = jQuery('#category_select').val();
    var _locationstring = "location="+_location;
    var _categorystring = "category="+_category;
    
    if (_category == 'Compressor' || _category == 'Portable Compressor' || _category == 'Reciprocating Air Compressor' || _category == 'Rotary Screw Air Compressor' || _category == 'Generator'){
        
        //Get the Compressor CFM range
        var _default_cfm_range = "capacity_cfm=8-1920";
        var _default_m3min_range = "capacity_m3min=0-55";
        var _default_psi_range = "capacity_psi=5-220";
        var _default_kva_range = "prime_power_kva=6-886";
        var _default_kw_range = "prime_power_kw=6-708";
        
        var _cfm_range = jQuery("#capacity_cfm > div.screen-number-content.screen-number-content-one").attr("data-value");
        var _m3min_range = jQuery("#capacity_m3min > div.screen-number-content.screen-number-content-one").attr("data-value");
        var _psi_range = jQuery("#capacity_psi > div.screen-number-content.screen-number-content-one").attr("data-value");
        var _kva_range = jQuery("#prime_power_kva > div.screen-number-content.screen-number-content-one").attr("data-value");
        var _kw_range = jQuery("#prime_power_kw > div.screen-number-content.screen-number-content-one").attr("data-value");
        
        if(_cfm_range == '' || _cfm_range == null){
            _cfm_range = _default_cfm_range;
        }
        if(_m3min_range == '' || _m3min_range == null){
            _m3min_range = _default_m3min_range;
        }
        if(_psi_range == '' || _psi_range == null){
            _psi_range = _default_psi_range;
        }
        if(_kva_range == '' || _kva_range == null){
            _kva_range = _default_kva_range;
        }
        if(_kw_range == '' || _kw_range == null){
            _kw_range = _default_kw_range;
        }
        
        
        var _cfm_arr = _cfm_range.split("=");
        var _cfm_arr_values = _cfm_arr[1].split("-");
        var cfm_low = _cfm_arr_values[0];
        var cfm_high = _cfm_arr_values[1];
        var _cfmstring = "cfm_min="+cfm_low+"&cfm_max="+cfm_high;
        //console.log("cfm_low " + cfm_low + ": cfm_high " + cfm_high);
        
        var _m3min_arr = _m3min_range.split("=");
        var _m3min_arr_values = _m3min_arr[1].split("-");
        var m3min_low = _m3min_arr_values[0];
        var m3min_high = _m3min_arr_values[1];
        var _m3minstring = "m3min_min="+m3min_low+"&m3min_max="+m3min_high;
        //console.log("m3min_low " + m3min_low + ": m3min_high " + m3min_high);
        
        var _psi_arr = _psi_range.split("=");
        var _psi_arr_values = _psi_arr[1].split("-");
        var psi_low = _psi_arr_values[0];
        var psi_high = _psi_arr_values[1];
        var _psistring = "psi_min="+psi_low+"&psi_max="+psi_high;
        //console.log("psi_low " + psi_low + ": psi_max " + psi_high);
        
        var _kva_arr = _kva_range.split("=");
        var _kva_arr_values = _kva_arr[1].split("-");
        var kva_low = _kva_arr_values[0];
        var kva_high = _kva_arr_values[1];
        var _kvastring = "kva_min="+kva_low+"&kva_max="+kva_high;
        //console.log("kva_low " + kva_low + ": kva_max " + kva_high);
        
        var _kw_arr = _kw_range.split("=");
        var _kw_arr_values = _kw_arr[1].split("-");
        var kw_low = _kw_arr_values[0];
        var kw_high = _kw_arr_values[1];
        var _kwstring = "kw_min="+kw_low+"&kw_max="+kw_high;
        //console.log("kw_low " + kw_low + ": kw_max " + kw_high);
        
        var _metrics_value = _cfmstring+"&"+_m3minstring+"&"+_psistring;
        if(_category == 'Generator'){
            _metrics_value = _kvastring+"&"+_kwstring
        }
        
        var _searchstring = _locationstring+"&"+_categorystring+"&"+_metrics_value;
        //console.log("_searchstring: " + _searchstring);
        
    }else{
        var _searchstring = _locationstring+"&"+_categorystring;
    }
    
    var baseUrl = jQuery(this).attr('data-url');
    baseUrl = baseUrl+'/rental-availability/?'+_searchstring;
    jQuery(".rental-search").attr('href',baseUrl);
})
</script>
