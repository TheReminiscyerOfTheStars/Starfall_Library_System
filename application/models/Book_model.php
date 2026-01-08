<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    // Get all genres for the dropdown
    public function get_all_genres() {
        $this->db->order_by('GenreName', 'ASC');
        return $this->db->get('table_genres')->result_array();
    }

    // JOINED FETCH: Get Books + Genre Names
    public function get_books_paginated($filter, $search, $rating, $limit, $start) {
        $this->db->select('table_books.*, table_genres.GenreName');
        $this->db->from('table_books');
        $this->db->join('table_genres', 'table_books.Genre = table_genres.ID', 'left');

        $this->_apply_filters($filter, $search, $rating);
        
        $this->db->limit($limit, $start);
        $this->db->order_by('table_books.ID', 'ASC'); 
        return $this->db->get()->result_array();
    }

    // Count for pagination
    public function count_all_books($filter, $search, $rating) {
        $this->db->from('table_books');
        $this->db->join('table_genres', 'table_books.Genre = table_genres.ID', 'left');
        $this->_apply_filters($filter, $search, $rating);
        return $this->db->count_all_results();
    }

    // Get Single Book (for Edit Modal)
    public function get_book_by_id($id) {
        $this->db->select('table_books.*, table_genres.GenreName');
        $this->db->from('table_books');
        $this->db->join('table_genres', 'table_books.Genre = table_genres.ID', 'left');
        $this->db->where('table_books.ID', $id);
        return $this->db->get()->row_array();
    }

    public function insert_book($data) {
        $this->db->insert('table_books', $data);
        return $this->db->insert_id();
    }

    public function update_book($id, $data) {
        $this->db->where('ID', $id);
        return $this->db->update('table_books', $data);
    }

    public function delete_book($id) {
        $this->db->where('ID', $id);
        return $this->db->delete('table_books');
    }

    private function _apply_filters($filter, $search, $rating) {
        if (!empty($search)) {
            if ($filter == 'ID') {
                $this->db->where('table_books.ID', $search);
            } 
            elseif ($filter == 'Genre') {
                $this->db->like('table_genres.GenreName', $search);
            }
            else {
                $this->db->like('table_books.' . $filter, $search);
            }
        }
        if (!empty($rating)) {
            $this->db->where('FLOOR(Rating)', $rating);
        }
    }
}