<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
<!-- .................................. -->
<!-- ...........COPYRIGHT ............. -->
<!-- Authors : Hisyam Husein .......... -->
<!-- Email : hisyam.husein@gmail.com .. -->
<!-- About : hisyambsa.github.io ...... -->
<!-- Instagram : @hisyambsa............ -->
<!-- .................................. -->
*/
class Santri_model extends CI_Model
{

    public $table = 't_santri';
    public $id = 'id';
    public $delete_at = 'delete_at';
    public $order = 'DESC';

    function __construct()
    {
        parent::__construct();
    }
    function generate_nis()
    {
        $nomor = "1";
        $tahun = date('Y');
        $this->db->order_by('id', 'desc');
        $data  = $this->db->get('t_santri', 1)->row();
        if ($data) {
            $tahun = substr($data->nis, 0, 4);
            if ($tahun == date('Y')) {
                $nomorTerakhir = substr($data->nis, -5, 5);
                $nomor = $nomorTerakhir + 1;
            }
        }

        return  $tahun . str_pad($nomor, 5, 0, STR_PAD_LEFT);
    }
    // get all
    function get_all($kondisi = NULL)
    {
        if ($kondisi != NULL) {
            $i = 0;
            foreach ($kondisi as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.
                    $this->db->where($kondisi); // looping where
                }
                if (count($kondisi) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
        }

        $this->db->join('provinces', "provinces.id = $this->table.province_id", 'left');
        $this->db->join('regencies', "regencies.id = $this->table.regency_id", 'left');
        $this->db->join('districts', "districts.id = $this->table.district_id", 'left');
        $this->db->join('villages', "villages.id = $this->table.village_id", 'left');

        $this->db->select("$this->table.*, provinces.name as province_name, regencies.name as regency_name,districts.name as district_name,villages.name as village_name");

        $this->db->where($this->delete_at, NULL);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table);
    }
    function get_all_trash($kondisi = NULL)
    {
        if ($kondisi != NULL) {
            $i = 0;
            foreach ($kondisi as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.
                    $this->db->where($kondisi); // looping where
                }
                if (count($kondisi) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
        }
        $this->db->where($this->delete_at, NULL);
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table);
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->delete_at, NULL);
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL, $kondisi = NULL)
    {

        if ($kondisi != NULL) {
            $i = 0;
            foreach ($kondisi as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.
                    $this->db->where($kondisi); // looping where
                }
                if (count($kondisi) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
        } else {
            $this->db->group_start(); // open bracket.
            $this->db->like('id', $q);
            $this->db->or_like('ppdb_id', $q);
            $this->db->or_like('nis', $q);
            $this->db->or_like('nik_santri', $q);
            $this->db->or_like('nama_santri', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('tempat_lahir', $q);
            $this->db->or_like('tanggal_lahir', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('province_id', $q);
            $this->db->or_like('regency_id', $q);
            $this->db->or_like('district_id', $q);
            $this->db->or_like('village_id', $q);
            $this->db->or_like('jenjang', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('no_hp', $q);
            $this->db->or_like('nomor_kartu_keluarga', $q);
            $this->db->or_like('punya_buku_nasab', $q);
            $this->db->or_like('nama_ayah', $q);
            $this->db->or_like('nama_ibu', $q);
            $this->db->or_like('upload_pas_foto', $q);
            $this->db->or_like('upload_kartu_keluarga', $q);
            $this->db->or_like('upload_nasab', $q);
            $this->db->or_like('upload_ijasah', $q);
            $this->db->or_like('golongan_darah', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('timestamp', $q);
            $this->db->or_like('create_by', $q);
            $this->db->or_like('modify', $q);
            $this->db->or_like('modify_by', $q);
            $this->db->or_like('delete_at', $q);
            $this->db->group_end(); //close bracket

            $this->db->where($this->delete_at, NULL);

            $this->db->from($this->table);

            return $this->db->count_all_results();
        }
    }
    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL, $kondisi = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        if ($kondisi != NULL) {
            $i = 0;
            foreach ($kondisi as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.
                    $this->db->where($kondisi); // looping where
                }
                if (count($kondisi) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
        } else {
            $this->db->group_start(); // open bracket.
            $this->db->like('id', $q);
            $this->db->or_like('ppdb_id', $q);
            $this->db->or_like('nis', $q);
            $this->db->or_like('nik_santri', $q);
            $this->db->or_like('nama_santri', $q);
            $this->db->or_like('jenis_kelamin', $q);
            $this->db->or_like('tempat_lahir', $q);
            $this->db->or_like('tanggal_lahir', $q);
            $this->db->or_like('alamat', $q);
            $this->db->or_like('province_id', $q);
            $this->db->or_like('regency_id', $q);
            $this->db->or_like('district_id', $q);
            $this->db->or_like('village_id', $q);
            $this->db->or_like('jenjang', $q);
            $this->db->or_like('email', $q);
            $this->db->or_like('no_hp', $q);
            $this->db->or_like('nomor_kartu_keluarga', $q);
            $this->db->or_like('punya_buku_nasab', $q);
            $this->db->or_like('nama_ayah', $q);
            $this->db->or_like('nama_ibu', $q);
            $this->db->or_like('upload_pas_foto', $q);
            $this->db->or_like('upload_kartu_keluarga', $q);
            $this->db->or_like('upload_nasab', $q);
            $this->db->or_like('upload_ijasah', $q);
            $this->db->or_like('golongan_darah', $q);
            $this->db->or_like('status', $q);
            $this->db->or_like('timestamp', $q);
            $this->db->or_like('create_by', $q);
            $this->db->or_like('modify', $q);
            $this->db->or_like('modify_by', $q);
            $this->db->or_like('delete_at', $q);
            $this->db->group_end(); //close bracket 
        }
        $this->db->limit($limit, $start);

        $this->db->where($this->delete_at, NULL);
        return $this->db->get($this->table)->result();
    }

    // insert data
    function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        return $this->db->update($this->table, $data);
    }
    // update data
    function update_where($kondisi, $data)
    {
        if ($kondisi != NULL) {
            $i = 0;
            foreach ($kondisi as $item) // loop column 
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket.
                    $this->db->where($kondisi); // looping where
                }
                if (count($kondisi) - 1 == $i) { //last loop
                    $this->db->group_end(); //close bracket
                }
                $i++;
            }
            return $this->db->update($this->table, $data);
        }
        return false;
    }

    // soft delete
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $data = array(
            $this->delete_at => strtotime('now')
        );
        return $this->db->update($this->table, $data);
    }

    // force delete data
    function delete_trash($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->delete($this->table);
    }
}

/* End of file Santri_model.php */
/* Location: ./application/models/Santri_model.php */
/* Please DO NOT modify this information : */
/* Generated by Hisyam 2023-04-09 02:19:34 */
/* http://hisyambsa.github.io */