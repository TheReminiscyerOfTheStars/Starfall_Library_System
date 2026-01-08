<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Books extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Book_model');
        $this->load->library('upload');
        $this->load->helper(['url', 'file', 'text', 'string']);
    }

    public function index() {
        $this->load->view('book_view');
    }

    public function get_genres() {
        $genres = $this->Book_model->get_all_genres();
        echo json_encode($genres);
    }

    public function fetch() {
        $filter = $this->input->post('filter') ?: 'BookName';
        $search = $this->input->post('search');
        $rating = $this->input->post('rating');
        
        $page   = $this->input->post('page') ?: 1;
        $limit  = 25; 
        $start  = ($page - 1) * $limit;

        $total_records = $this->Book_model->count_all_books($filter, $search, $rating);
        $data = $this->Book_model->get_books_paginated($filter, $search, $rating, $limit, $start);

        echo json_encode([
            'data' => $data,
            'pagination' => [
                'current_page' => (int)$page,
                'total_pages'  => ceil($total_records / $limit),
                'total_records'=> $total_records,
                'start_index'  => ($total_records > 0) ? $start + 1 : 0,
                'end_index'    => min($start + $limit, $total_records)
            ]
        ]);
    }

    public function save() {
        error_reporting(0);
        ini_set('display_errors', 0);
        ini_set('memory_limit', '256M');

        $id = $this->input->post('ID');
        $bookName = $this->input->post('BookName');
        $authorName = $this->input->post('AuthorName');
        $publisher = $this->input->post('Publisher');

        if (empty($bookName) || empty($authorName) || empty($publisher)) {
            echo json_encode(['status' => 'error', 'message' => 'Title, Author, and Publisher are required!']);
            return;
        }

        $data = array(
            'BookName'   => $bookName,
            'AuthorName' => $authorName,
            'Genre'      => $this->input->post('Genre'),
            'Publisher'  => $publisher,
            'Rating'     => $this->input->post('Rating')
        );

        $is_new = false;

        if (empty($id)) {
            $data['BookCover'] = 'defaultprofile.png';
            $id = $this->Book_model->insert_book($data);
            $is_new = true;
        }

        if (!empty($_FILES['BookCoverFile']['name'])) {
            
            $ext = strtolower(pathinfo($_FILES['BookCoverFile']['name'], PATHINFO_EXTENSION));
            $allowed = ['jpg', 'jpeg', 'png', 'gif', 'jfif'];
            if(!in_array($ext, $allowed)){
                echo json_encode(['status'=>'error', 'message'=>'Invalid file type.']);
                return;
            }

            $uploadPath = FCPATH . 'assets/company/images/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

            $cleanTitle = url_title($bookName, '_', TRUE);
            $cleanAuthor = url_title($authorName, '_', TRUE);
            $baseName = "{$id}_{$cleanTitle}_{$cleanAuthor}";
            
            $counter = 1;
            $finalFilename = $baseName . '_' . $counter;
            while (file_exists($uploadPath . $finalFilename . '.png') || 
                   file_exists($uploadPath . $finalFilename . '.jpg') || 
                   file_exists($uploadPath . $finalFilename . '.jpeg') ||
                   file_exists($uploadPath . $finalFilename . '.jfif')) {
                $counter++;
                $finalFilename = $baseName . '_' . $counter;
            }

            $config['upload_path']   = $uploadPath;
            $config['allowed_types'] = '*';
            $config['file_name']     = $finalFilename;
            $config['overwrite']     = FALSE;

            $this->upload->initialize($config);

            if ($this->upload->do_upload('BookCoverFile')) {
                $uploadData = $this->upload->data();
                $newCoverName = $this->_convert_to_png($uploadData, $finalFilename);
                if($newCoverName) {
                    $data['BookCover'] = $newCoverName;
                } else {
                    echo json_encode(['status'=>'error', 'message'=>'Image conversion failed.']);
                    return;
                }
            } else {
                echo json_encode(['status'=>'error', 'message'=>$this->upload->display_errors('','')]);
                return;
            }
        }

        $this->Book_model->update_book($id, $data);
        $msg = $is_new ? 'New book published!' : 'Book updated successfully!';
        echo json_encode(['status' => 'success', 'message' => $msg]);
    }

    public function delete() {
        $id = $this->input->post('id');
        $book = $this->Book_model->get_book_by_id($id);
        
        if ($book && !empty($book['BookCover']) && $book['BookCover'] !== 'defaultprofile.png') {
            $p = FCPATH . 'assets/company/images/' . $book['BookCover'];
            if (file_exists($p)) unlink($p);
        }

        $this->Book_model->delete_book($id);
        echo json_encode(['status' => 'success', 'message' => 'Book deleted!']);
    }

    private function _convert_to_png($uploadData, $desiredName) {
        $sourcePath = $uploadData['full_path'];
        $newFileName = $desiredName . '.png';
        $targetPath = $uploadData['file_path'] . $newFileName;

        if (file_exists($targetPath) && $sourcePath !== $targetPath) unlink($targetPath);

        $ext = strtolower(pathinfo($sourcePath, PATHINFO_EXTENSION));
        $image = null;

        switch ($ext) {
            case 'jpg': case 'jpeg': case 'jfif': $image = @imagecreatefromjpeg($sourcePath); break;
            case 'gif': $image = @imagecreatefromgif($sourcePath); break;
            case 'png':
                if ($uploadData['file_name'] !== $newFileName) rename($sourcePath, $targetPath);
                return $newFileName;
        }

        if ($image) {
            imagepng($image, $targetPath);
            imagedestroy($image);
            if(file_exists($sourcePath) && $sourcePath !== $targetPath) unlink($sourcePath);
            return $newFileName;
        }
        return false;
    }
}