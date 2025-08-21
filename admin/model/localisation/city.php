<?php
class ModelLocalisationCity extends Model {
    public function addCity($data) {
        $this->db->query("INSERT INTO " . DB_PREFIX . "city SET name = '" . $this->db->escape($data['name']) . "', keyword = '" . $this->db->escape($data['keyword']) . "', status = '" . (int)$data['status'] . "'");

        return $this->db->getLastId();
    }

    public function editCity($city_id, $data) {
        $this->db->query("UPDATE " . DB_PREFIX . "city SET name = '" . $this->db->escape($data['name']) . "', keyword = '" . $this->db->escape($data['keyword']) . "', status = '" . (int)$data['status'] . "' WHERE city_id = '" . (int)$city_id . "'");
    }

    public function deleteCity($city_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "'");
    }

    public function getCity($city_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "city WHERE city_id = '" . (int)$city_id . "'");

        return $query->row;
    }

    public function getCities($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "city";

        if (!empty($data['filter_name'])) {
            $sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $sort_data = array('name', 'keyword', 'status');

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY name";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalCities($data = array()) {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "city";

        if (!empty($data['filter_name'])) {
            $sql .= " WHERE name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
        }

        $query = $this->db->query($sql);

        return $query->row['total'];
    }
}
