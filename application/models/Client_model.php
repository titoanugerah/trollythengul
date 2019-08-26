<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*
*/
class Client_model extends CI_Model
{

  function __construct()
  {

  }

  //CORE
  public function getDataRow($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->row();
  }

  public function getSomeData($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->result();
  }


  public function getAllData($table)
  {
    return $this->db->get($table)->result();
  }

  public function getNumRow($table, $whereVar, $whereVal)
  {
    return $this->db->get_where($table, $where = array($whereVar => $whereVal))->num_rows();
  }

  public function getNumRow2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->num_rows();
  }

  public function getDataRow2($table, $whereVar1, $whereVal1, $whereVar2, $whereVal2)
  {
    return $this->db->get_where($table, $where = array($whereVar1 => $whereVal1,$whereVar2 => $whereVal2))->row();
  }

  public function deleteData($table, $whereVar, $whereVal)
  {
    return $this->db->delete($table, $where = array($whereVar => $whereVal ));
  }

  public function updateData($table, $whereVar, $whereVal, $setVar, $setVal)
  {
    $this->db->where($where = array($whereVar => $whereVal));
    return $this->db->update($table, $data = array($setVar=> $setVal));
  }

  public function uploadFile($filename,$allowedFile)
  {
    $config['upload_path'] = APPPATH.'../assets/upload/';
    $config['overwrite'] = TRUE;
    $config['file_name']     =  str_replace(' ','_',$filename);
    $config['allowed_types'] = $allowedFile;
    $this->load->library('upload', $config);
    if (!$this->upload->do_upload('fileUpload')) {
      $upload['status']=0;
      $upload['message']= "Mohon maaf terjadi error saat proses upload : ".$this->upload->display_errors();
    } else {
      $upload['status']=1;
      $upload['message'] = "File berhasil di upload";
      $upload['ext'] = $this->upload->data('file_ext');
    }
    $this->session->set_flashdata('message', $upload['message']);
    return $upload;
  }

  public function sentEmail($to, $fullname, $subject, $content)
  {
    $account = $this->getDataRow('webconf', 'id', 1);
    $config = [
    'protocol' => 'sentmail',
    'smtp_host' => $account->host,
    'smtp_user' => $account->email,
    'smtp_pass' => $account->password,
    'smtp_crypto' => $account->crypto,
    'charset' => 'utf-8',
    'crlf' => 'rn',
    'newline' => "\r\n",
    'smtp_port' => $account->port
    ];
    $this->load->library('email', $config);
    $this->email->from($account->email);
    $this->email->to($to);
    $this->email->subject($subject);
    $this->email->message('
    Yth. '.$fullname.'
    Di tempat.

    '.$content.'

    Atas perhatiannya kami ucapkan terima kasih.

    Admin
    ');
    $sent = $this->email->send();
    error_reporting(0);
  }

  public function callRajaOngkirAPI($param)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/".$param,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
    "key: 585ef1d017b0c127167d9350ad10d026"
    ),
    ));
    $response = json_decode(curl_exec($curl))->rajaongkir;
    $err = curl_error($curl);
    if ($response->status->description=='OK') {
      return $response->results;
    } else {
      notify('Gagal', 'Gagal mengambil lokasi dari API : '.curl_error($curl).$response->status->description, 'danger', 'fas fa-bell-slash', 'null');
    }
  }

  public function getCost($origin, $destination, $weight, $courier, $type)
  {
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=".$origin."&destination=".$destination."&weight=".$weight."&courier=".$courier,
    CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key: 585ef1d017b0c127167d9350ad10d026"
    ),
    ));

    $response = json_decode(curl_exec($curl))->rajaongkir;
    // var_dump($response->results[0]->name);die;
    $data['cost'] = $response->results[0]->costs[$type]->cost[0]->value;
    $data['etd'] = $response->results[0]->costs[$type]->cost[0]->etd;
    $data['type'] = $response->results[0]->costs[$type]->service;
    $data['courier_name'] = $response->results[0]->name;
    $err = curl_error($curl);
    if ($response->status->description=='OK') {
      return $data;
    } else {
      notify('Gagal', 'Gagal mengambil lokasi dari API : '.curl_error($curl).$response->status->description, 'danger', 'fas fa-bell-slash', null);
    }
  }
  //functional
  public function createLog($status, $code, $actor, $info = array())
  {
    if ($status==1 && $code=='a') {
      $data = array(
      'id_order' => $info['id_order'],
      'id_detail_order' => $info['id_detail_order'],
      'log' => $this->session->userdata['fullname'].' sebagai pembeli telah melakukan pembayaran via transfer dengan bukti <br> <img src="'.base_url('./assets/upload'.$info['payment_image']).'" style="max-width:300px;">'
      );
    }
    $this->db->insert('log', $data);
  }


  public function createCaptcha()
  {
    $data['A'] = rand(0,10);
    $data['B'] = rand(0,10);
    $data['result'] = $data['A'] + $data['B'];
    return $data;
  }


  public function getCity()
  {
    return $this->callRajaOngkirAPI('city');
  }

  public function getCityDetail($city_id)
  {
    return $this->callRajaOngkirAPI('city?id='.$city_id);
  }

  //APPLICATION
  public function cMyCart()
  {
    if ($this->getNumRow2('order', 'id_customer', $this->session->userdata['id'], 'status', 0)==0) {
      $this->db->insert('order',$content = array('id_customer' => $this->session->userdata['id'], 'status' => 0));
      $data['order'] = $this->getDataRow('view_order', 'id', $this->db->insert_id());
      $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $this->db->insert_id());
      $data['statusDetailOrder'] = 0;
    } else {
      $data['order'] = $this->getDataRow2('view_order', 'id_customer', $this->session->userdata['id'], 'status', 0);
      $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $data['order']->id);
      if ($this->getNumRow('view_detail_order', 'id_order', $data['order']->id)==0) {$data['statusDetailOrder'] = 0;}
      else{$data['statusDetailOrder'] = 1;}
    }
    $data['view_name'] = 'myCart';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function addToCart($id)
  {
    if ($this->getNumRow2('order', 'id_customer', $this->session->userdata['id'], 'status', 0)==0) {
      $this->db->insert('order',$content = array('id_customer' => $this->session->userdata['id'], 'status' => 0, 'unique' => rand(0,999)));
      $id_order = $this->db->insert_id();
    } else {
      $id_order = $this->getDataRow('order', 'id_customer', $this->session->userdata['id'], 'status', 0)->id;
    }
    $merchant = $this->getDataRow('product', 'id', $id);
    $this->db->insert('detail_order', $data = array('id_order' => $id_order, 'id_product' => $id, 'id_merchant' => $merchant->id_merchant, 'qty' => $this->input->post('qty'), 'price' => $merchant->price, 'special_request' => $this->input->post('special_request')));
    notify('Berhasil ditambahkan', 'Barang berhasil ditambahkan ke keranjang','success','fas fa-plus','myCart');
  }


  public function deleteFromCart()
  {
    $this->deleteData('detail_order', 'id', $this->input->post('id'));
    notify('Berhasil dihapus', 'Barang berhasil dihapus dari keranjang','success','fas fa-plus','myCart');
  }

  public function updateDetailOrder()
  {
    $this->updateData('detail_order', 'id', $this->input->post('id'), 'qty', $this->input->post('qty'));
    $this->updateData('detail_order', 'id', $this->input->post('id'), 'special_request', $this->input->post('special_request'));
    notify('Berhasil diupdate', 'Barang berhasil diupdate dari keranjang','success','fas fa-check','myCart');
  }

  public function cPayment($id)
  {
    $data['destination'] = $this->getCity();
    $data['order'] = $this->getDataRow('view_order', 'id', $id);
    $data['promo'] = $this->getDataRow('view_promo', 'promo_code', $data['order']->promo_code);
    // var_dump($data['promo']);die;
    $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_order', $id);
    $data['view_name'] = 'payment';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function setDestination($id)
  {
    $detailCity = $this->getCityDetail($this->input->post('city_id'));
    $data = array(
    'city_id' => $this->input->post('city_id'),
    'shipment_street' => $this->input->post('shipment_street'),
    'courier' => $this->input->post('courier'),
    'shipment_city' => $detailCity->city_name,
    'shipment_province' => $detailCity->province,
    'shipment_postal_code' => $detailCity->postal_code
    );
    $this->db->where($where = array('id' => $id ));
    $this->db->update('order', $data);
    $this->updateData('order', 'id', $id, 'city_id', $this->input->post('city_id'));
    $this->updateData('order', 'id', $id, 'shipment_street', $this->input->post('shipment_street'));
    $this->updateData('order', 'id', $id, 'courier', $this->input->post('courier'));

    foreach ($this->getSomeData('view_detail_order', 'id_order', $id) as $item) {
      $data = $this->getCost($item->merchant_city_id, $item->client_city_id, $item->weight, explode('/',$this->input->post('courier'))[0], explode('/',$this->input->post('courier'))[1]);
      $this->updateData('detail_order', 'id', $item->id, 'shipment_fee', $data['cost']);
      $this->updateData('order', 'id', $id, 'type', $data['type']);
    }
    notify('Berhasil diupdate', 'Lokasi pengiriman berhasil diupdate','success','fas fa-check',null);
  }

  public function addPromo($id)
  {
    if ($this->getNumRow('promo', 'promo_code', $this->input->post('promo_code'))==1) {
      $promo = $this->getDataRow('view_promo', 'promo_code', $this->input->post('promo_code'));
      if ($promo->available<1) {
        notify('Gagal', 'Kuota pada promo ini sudah habis, silahkan masukan kode promo lain', 'danger', 'fas fa-bell-slash', null);
      } elseif ($promo->deadline<1 || $promo->status==0) {
        notify('Gagal', 'Kuota pada promo ini sudah kadaluarsa, silahkan masukan kode promo lain', 'danger', 'fas fa-bell-slash', null);
      } else {
        $this->updateData('order', 'id', $id, 'promo_code', $this->input->post('promo_code'));
        notify('Berhasil ditambahkan', 'Kode promo '.$this->input->post('promo').' berhasil ditambahkan, selamat menikmati potongan harga senilai '.number_format($promo->discount,2,',','.') ,'success','fas fa-check',null);
      }
    } else {
      notify('Gagal', 'Kode yang anda masukan tidak tersedia, silahkan periksa kode promo anda', 'danger', 'fas fa-bell-slash', null);
    }
  }

  public function deletePromo($id)
  {
    $this->updateData('order', 'id', $id, 'promo_code', '');
    notify('Berhasil dihapus', 'Kode promo berhasil dihapus' ,'success','fas fa-check',null);
  }

  public function uploadPayment($id)
  {
    if($this->updateData('order', 'id', $id, 'payment_image', 'payment_'.$id.$this->uploadFile('payment_'.$id, 'jpg|jpeg|bmp|png')['ext'])){
      $this->updateData('order','id', $id, 'status', 1);
      foreach ($this->getSomeData('view_detail_order', 'id_order', $id) as $item) {
        $data['id_order'] = $id;
        $data['id_detail_order'] = $item->id;
        $data['payment_image'] = $item->payment_image;
        $this->createLog(1, 'a', $this->session->userdata['id'], $data);
        $this->updateData('detail_order', 'id', $item->id, 'status', 1);
      }
      notify('Berhasil', 'Pengiriman bukti gambar berhasil dilakukan, selanjutnya silahkan anda bisa pantau pada halaman Pesanan Saya' ,'success','fas fa-check','myOrder');
    }
  }

  public function cMyOrder()
  {
    $data['detailOrder'] = $this->getSomeData('view_detail_order', 'id_customer', $this->session->userdata['id']);
    $data['view_name'] = 'myOrder';
    $data['webconf'] = $this->getDataRow('webconf', 'id', 1);
    return $data;
  }

  public function confirmArrived()
  {
    $data = array(
    'status' => 5,
    'comment' => $this->input->post('comment'),
    'rating' => $this->input->post('rating'),
    );
    $this->db->where($where = array('id' => $this->input->post('id')));
    $this->db->update('detail_order', $data);
    $detail_order= $this->getDataRow('detail_order', 'id', $this->input->post('id'));
    $content = 'Bersamaan dengan ini kami informasikan bahwa pesanan #'.$detail_order->id.' sudah diterima oleh pembeli';
    $this->sentEmail($this->getDataRow('account', 'id', $detail_order->id)->email, $this->getDataRow('account', 'id', $detail_order->id)->fullname, 'Barang sudah sampai', $content);
    notify('Berhasil', 'Barang sudah diterima' ,'success','fas fa-check','myOrder');

  }
}


?>
