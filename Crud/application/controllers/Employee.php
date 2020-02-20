<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

	
	public function index()
	{
		$this->load->view('employee');
	}


	public function insert()
	{
		if (@$_FILES['image'] != '')
            {
            $data            = @array();
            $number_of_files = @sizeof($_FILES['image']['tmp_name']);
            $files           = @$_FILES['image'];
            $errors          = @array();
            if (sizeof($errors) == 0)
             {
                for ($i = 0; $i < $number_of_files; $i++) {
                      // var_dump($_FILES['image']['name']);
                    @$config['allowed_types'] = 'jpg|png|jpeg|gif|mp4|mp3|mov';
                    @$config['overwrite'] = FALSE;
                    $images_name  = uniqid();
                    $config['file_name'] = $images_name;
                    $this->load->library('upload', $config);
                    @$_FILES['up_images']['name'] = @$_FILES['image']['name'][$i];
                    @$_FILES['up_images']['type'] = @$_FILES['image']['type'][$i];
                    @$_FILES['up_images']['tmp_name'] = @$_FILES['image']['tmp_name'][$i];
                    @$_FILES['up_images']['error'] = @$_FILES['image']['error'][$i];
                    @$_FILES['up_images']['size'] = @$_FILES['image']['size'][$i];
                    @$config['upload_path'] = 'html/img/';
                    @$path1[] = base_url() . 'html/img/' . $images_name . '.' . pathinfo($_FILES['up_images']['name'], PATHINFO_EXTENSION);
                    @$images = implode(',', $path1);
                    @$this->upload->initialize($config);
                    if ($this->upload->do_upload('up_images'))
                    {
                        @$data['uploads'][$i] = $this->upload->data();
                           //var_dump($data['uploads'][$i]);
                    }
                    else
                    {
                       @$data['upload_errors'][$i] = $this->upload->display_errors();
                    }
                }
                $images = @implode(',', $path1);
            }
           }
           else
            {
              $images = '';
            }



            $data=array(

            	'firstname' =>$_POST['firstname'],
            	'lastname' =>$_POST['lastname'],
            	'email' =>$_POST['email'],
            	'phone' =>$_POST['phone'],
            	'hobby' =>$_POST['hobby'],
            	'password' =>$_POST['password'],
            	'image' =>$images,
            	'answer' =>$_POST['answer'],
            	'gender' =>$_POST['gender']
            	);

            $i=$this->db->insert('employee',$data);
            if($i)
            {

            ?>


            <script type="text/javascript">
            	alert('success');
            	window.location.href='<?php echo base_url()?>Welcome';
			</script>
            <?php


            }
            else
            {
            	?>
            	<script type="text/javascript">
            		alert('fail');
            		window.location.href='<?php echo base_url();?>Employee';
            	</script>


            	<?php


			}






	}


}
