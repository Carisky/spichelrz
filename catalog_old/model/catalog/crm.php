<?php

class ModelCatalogCrm extends Model {
	
	public function updateQuantity($products)
	{
		foreach($products as $item) {
			$this->db->query("UPDATE ".DB_PREFIX."product SET quantity = ".(int)array_sum($item['stock'])." WHERE model = '".$item['product_id']."'");
		}
	}
	
	public function updatePrice($products)
	{
		foreach($products as $item) {
			$this->db->query("UPDATE ".DB_PREFIX."product SET price = '".(float)array_shift($item['prices'])."' WHERE model = '".$item['product_id']."'");
		}
	}
}