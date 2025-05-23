<?php
/**
 *  Copyright (c) 2023 Noir
 *  All Rights Reserved
 */

class ModelExtensionShippingInpost extends Model {

    public function getQuote( $address )
    {
        $this->load->language('extension/shipping/inpost');
		
		$quote_data = array();
		
        $cost = $this->config->get('shipping_inpost_total_courier');
        if ($this->cart->getSubTotal() >= 180) { //AG
			$cost = 0.0;
		}

		$quote_data['courier'] = [
			'code'         => 'inpost.courier',
			'title'        => $this->language->get('text_description_courier'),
			'cost'         => $cost,
			'tax_class_id' => 10, //AG $this->config->get('shipping_inpost_tax_class_id'),
			'text'         => $this->currency->format($this->tax->calculate($cost, 10, $this->config->get('config_tax')), $this->session->data['currency']) //AG $this->config->get('shipping_inpost_tax_class_id') -> 10
		];
		
		if(!empty($this->session->data['shipping_method']) and $this->session->data['shipping_method']['code'] == 'inpost.point' and isset($this->session->data['shipping_method']['ID'])) {
			$quote_data['point'] = $this->session->data['shipping_method'];
		}
		
		if(empty($quote_data['point'])) {
			$query = '';
			if($address['city'] or $address['postcode']) {
				$query = $this->db->query("
					SELECT * FROM ".DB_PREFIX."shipping_inpost 
					WHERE CITY = '".ucfirst(strtolower($address['city']))."' OR POST_CODE = '".$address['postcode']."' 
					ORDER BY CITY ASC, STREET ASC LIMIT 1
				");
			}
			if(!$query or !$query->num_rows) {
				$query = $this->db->query("SELECT * FROM ".DB_PREFIX."shipping_inpost ORDER BY CITY ASC, STREET ASC LIMIT 1");
			}
			$quote_data['point'] = $this->buildQuote($query->rows[0]);
		}
        
		$method_data = [
			'code'       => 'inpost',
			'title'      => $this->language->get('text_title'),
			'quote'      => $quote_data,
			'sort_order' => $this->config->get('shipping_inpost_sort_order'),
			'error'      => false
		];

		return $method_data;
    }
	
	public function buildQuote($point)
	{
		$this->load->language('extension/shipping/inpost');
		$point_name = $point['ID'].' - '.$point['STREET'].' '.$point['BUILDING_NUMBER'].', '.$point['CITY'];
		$cost = $this->config->get('shipping_inpost_total');
        // if ($this->cart->getSubTotal() >= 60) { //AG
		// 	$cost = 0.0;
		// }
        $costtxt = $this->currency->format($this->tax->calculate($cost, 10, $this->config->get('config_tax')), $this->session->data['currency']); //AG $this->config->get('shipping_inpost_tax_class_id') -> 10
		$html = '<a href="javascript:;" class="btn-map df aic" data-modal-map>Wybierz paczkomat'.//$point_name.
			'<svg><use xlink:href="/catalog/view/theme/default/image/sprite.svg#trigger"></use></svg>'.
			'</a>'.
            // <div id="inpostModalMap" class="modal fade" tabindex="-1" role="dialog" style="display:none;">
            // <div class="modal-content" style="height: 100%">
            //     <div class="modal-body" style="height: 100%; min-height: 200px;">
            //     <label for="inpostzip">Kod pocztowy (12-345):</label>
            //     <input id="inpostzip" style="display:block !important" type="text" placeholder="12-345" value=""></input> 
            //     <a href="javascript:;" style="margin-top: 8px;height: 40px;width: 130px;" class="btn df aic" onclick="getInpostPoits($(\'#inpostzip\').val())">Szukaj</a>
            //     <div id="inpostlist"> </div>
            //     </div>
            // </div>
            // </div>';
            '<div id="inpostModalMap" class="modal fade" tabindex="-1" role="dialog" style="display:none;height: 100vh;">'.
			//'<div id="inpost-google-map"></div>'.
			'<div class="modal-content" style="height: 100%">
                <div class="modal-body" style="height: 100%; min-height: 500px;">
                    <inpost-geowidget id="geoWidget" onpoint="afterPointSelected" token="eyJhbGciOiJSUzI1NiIsInR5cCIgOiAiSldUIiwia2lkIiA6ICJzQlpXVzFNZzVlQnpDYU1XU3JvTlBjRWFveFpXcW9Ua2FuZVB3X291LWxvIn0.eyJleHAiOjIwNTY3MTc1NjcsImlhdCI6MTc0MTM1NzU2NywianRpIjoiNjFlYTU4MzItNWZjNi00NDUxLTk3N2YtNTMzYjhiY2Y3NTYwIiwiaXNzIjoiaHR0cHM6Ly9sb2dpbi5pbnBvc3QucGwvYXV0aC9yZWFsbXMvZXh0ZXJuYWwiLCJzdWIiOiJmOjEyNDc1MDUxLTFjMDMtNGU1OS1iYTBjLTJiNDU2OTVlZjUzNTpiNmY4cEM5ZXNpS1l5YzZpOS1tWHV2eXd6M2dLOURBb0xBOS1SX0t4dXVVIiwidHlwIjoiQmVhcmVyIiwiYXpwIjoic2hpcHgiLCJzZXNzaW9uX3N0YXRlIjoiODdmMzBhMmEtMTVmNS00MzA4LTg2YTQtNWFlZmNhZmY2MDA0Iiwic2NvcGUiOiJvcGVuaWQgYXBpOmFwaXBvaW50cyIsInNpZCI6Ijg3ZjMwYTJhLTE1ZjUtNDMwOC04NmE0LTVhZWZjYWZmNjAwNCIsImFsbG93ZWRfcmVmZXJyZXJzIjoic3BpY2hsZXJ6MjQucGwiLCJ1dWlkIjoiZTE2NGQ4OWYtZDJmMS00MmQwLTg3MTMtOWUwMmM1MjQ5ZTZmIn0.U_7O1HUjHcHUflbo90tZtJsdDK1-8nKjWw4jtjn-Yp68vdb39pzzQsAAGLMkvNIfxnKC0Gft9XvXEBby318CWXGYTFqG7usdu1Vte7YY6l6voaqSNSQYIs08GIinrdhR1w6K7qwxmakJ1vRpDFSr9fn79xdpsbM6LgmYi4GL8qNeevnkb-Sa1ULKVIU87Eoe0bvvTb7gRf1ldI5pswAjkKwbjTK2166YwdnR1HLoPd1KjJnqrHX9R4hCu_UolhV8OgiNQjLVhQ_FyNDjuJCudbik2VC4lZda9cesvVNXc8cKXzx7Vb3f1uZMNPjvtYGJNnhaorGSLNxvqHkNMsXJPw" language="pl" config="parcelCollect"></inpost-geowidget>
                    <script>
                    function afterPointSelected(point) { btnSelectPoint(point.name, point.name + " - " + point.address.line1 + ", " + point.address.line2);} 
                    </script>
                </div>
            </div>'.
			'</div>';
		
		return [
			'code'  => 'inpost.point',
			'title' => $this->language->get('text_title'),
			'cost'  => $cost,
			'tax_class_id' => 10, //AG $this->config->get('shipping_inpost_tax_class_id')
			'text'  => $costtxt,
			'point_name' => $point_name,
			'ID' => $point['ID'],
			'html' => $html
		];
	}

    public function getJson($data = null)
    {
        $map=array();
        if( !empty( $data['postcode'] )) {
            $q[] = "POST_CODE='" . $data['postcode'] . "'";
        }
        if( !empty( $data['id'] )) {
            $q[] = "ID='" . $data['id'] . "'";
        }

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_inpost" . (!empty( $q ) ? " WHERE " . implode( " AND " , $q ) : ""));
        if ($query->num_rows) {
            foreach( $query->rows as $item )
            {
                $map[] = [
                    'id' => $item['ID'],
                    'description' => $item['LOCATION_DESCRIPTION'],
                    'street' => $item['STREET'] . ' ' . $item['BUILDING_NUMBER'],
                    'postcode' => $item['POST_CODE'],
                    'city' => $item['CITY'],
                    'state' => $item['PROVINCE'],
                    'lat' => $item['LATITUDE'],
                    'lng' => $item['LONGITUDE']
                ];

                $inpost_id = 'inpost_' . $item['ID'];
                $quote_data[$inpost_id] = array(
                    'code'         => 'inpost.' . $inpost_id,
                    'title'        => '(' . $item['ID'] . ') - ' . $item['STREET'] . ' ' . $item['BUILDING_NUMBER'] . ', ' . $item['CITY'] . '" class="hidden"',
                    'cost'         => $this->config->get('shipping_inpost_total'),
                    'tax_class_id' => 10, //AG $this->config->get('shipping_inpost_tax_class_id')
                    'text'         => $this->currency->format($this->tax->calculate($this->config->get('shipping_inpost_total'), 10, $this->config->get('config_tax')), $this->session->data['currency']) //AG $this->config->get('shipping_inpost_tax_class_id') -> 10
                );
            }
        }

        return $map;
    }
	
	public function getPoint($id) 
	{
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_inpost WHERE ID = '".$id."'");
		if($query->num_rows) return $query->row;
		return array();
	}

    public function generateQuote( $post )
    {
        $this->load->language('extension/shipping/inpost');

        if( empty( $post['id'] )) {
            $json = array('error' => true, 'msg' => 'Brak parametru POST id');
        } else {
            $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "shipping_inpost WHERE ID='" . $post['id'] . "'");
            if ($query->num_rows) {
                foreach( $query->rows as $item )
                {
                    $inpost_id = 'inpost_' . $item['ID'];
                    $quote_data[$inpost_id] = array(
                        'code'         => 'inpost.' . $inpost_id,
                        'title'        => '(' . $item['ID'] . ') - ' . $item['STREET'] . ' ' . $item['BUILDING_NUMBER'] . ', ' . $item['CITY'],
                        'cost'         => $this->config->get('shipping_inpost_total'),
                        'tax_class_id' => 10, //AG $this->config->get('shipping_inpost_tax_class_id')
                        'text'         => $this->currency->format($this->tax->calculate($this->config->get('shipping_inpost_total'), 10, $this->config->get('config_tax')), $this->session->data['currency']) //AG $this->config->get('shipping_inpost_tax_class_id') -> 10
                    );
                }

                //file_put_contents( DIR_APPLICATION . 'inpost.log' , print_r($this->session->data, true));
                $this->session->data['shipping_methods']['inpost'] = [
                    'title' => 'Paczkomaty Inpost',
                    'quote' => $quote_data,
                    'sort_order' => 0,
                    'error' => ''

                ];
                //file_put_contents( DIR_APPLICATION . 'inpost.log' , print_r($this->session->data['shipping_methods'], true));

                $json = array('success' => true);
            }
        }

        return json_encode( $json );
    }
}
