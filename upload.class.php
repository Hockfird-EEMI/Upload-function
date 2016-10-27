<?php
class FileUpload {

	// Variables
	private $_dir;
	private $_inputname;
	private $_fileName;

	public function __construct($dir = 'MyUploads', $inputname = 'userfile') {

		$this->setDir($dir);
		$this->setInputName($inputname);

	}

	public function setDir($dir) {
		$this->_dir = $dir;
	}

	public function setInputName($inputname) {
		$this->_inputname = $inputname;
	}

	public function uploadFile() {
		if (!is_dir($this->_dir)) {
			mkdir($this->_dir, 0777, true);
		}

		$totalfiles = count($_FILES[$this->_inputname]['name']);

		for($i=0; $i < $totalfiles; $i++) {

			$tmpFilePath = $_FILES[$this->_inputname]['tmp_name'][$i];

			if ($tmpFilePath != ""){

				$newFilePath = $this->_dir . DIRECTORY_SEPARATOR . $_FILES[$this->_inputname]['name'][$i];

				if(move_uploaded_file($tmpFilePath, $newFilePath)) {

					echo "Upload file <b>" . $_FILES[$this->_inputname]['name'][$i] . "</b> ok <br /><br />";

				}
			}
		}

	}

	public function uploadImage($widthOrHeight = null) {

		$sizes = getimagesize($_FILES[$this->_inputname]['tmp_name'][0]);
		var_dump($sizes);

		$ext = array('jpg' , 'jpeg' , 'gif', 'png' );
		$ext_upload = strtolower(substr(strrchr($_FILES[$this->_inputname]['name'][0], '.'), 1));

		if (!in_array($ext_upload,$ext)) {

			echo 'Le fichier n\'est pas une image.';

		} else {

			$url = $this->_dir . DIRECTORY_SEPARATOR . md5(uniqid(mt_rand())) . "." . $ext_upload;
			if(move_uploaded_file($_FILES[$this->_inputname]['tmp_name'][0], $url))
			{

				echo "Upload ok<br>";
			}
			else
			{
				echo "Upload Nok<br>";
			}

			if (!empty($widthOrHeight) && is_int($widthOrHeight)) {

					if ($ext_upload == 'jpeg' || $ext_upload == 'jpg') {

						$image = imagecreatefromjpeg($url);
						$width = imagesx($image);
						$height = imagesy($image);

						if ($width>$height) {
							//FORMAT HORIZONTAL
							$new_width = $widthOrHeight;
							$new_height = ($new_width * $height) / $width ;

						} else{
							//FORMAT VERTICAL
							$new_height = $widthOrHeight;
							$new_width = ($new_height * $width) / $height ;
						}

						$thumb = imagecreatetruecolor($new_width, $new_height);

						if (imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
						echo "Resampled OK<br>";
						else
						echo "Resampled NOK<br>";

						imagejpeg($thumb, $url);
						chmod ($url,0777);
						imagedestroy($image);

					} elseif ($ext_upload == 'gif') {

						$image = imagecreatefromgif($url);
						$width = imagesx($image);
						$height = imagesy($image);

						if ($width>$height) {
							//FORMAT HORIZONTAL
							$new_width = $widthOrHeight;
							$new_height = ($new_width * $height) / $width ;

						} else{
							//FORMAT VERTICAL
							$new_height = $widthOrHeight;
							$new_width = ($new_height * $width) / $height ;
						}

						$thumb = imagecreatetruecolor($new_width, $new_height);

						if (imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
						echo "Resampled OK<br>";
						else
						echo "Resampled NOK<br>";

						imagegif($thumb, $url);
						chmod ($url,0777);
						imagedestroy($image);

					} elseif ($ext_upload == 'png') {

						$image = imagecreatefrompng($url);
						$width = imagesx($image);
						$height = imagesy($image);

						if ($width>$height) {
							//FORMAT HORIZONTAL
							$new_width = $widthOrHeight;
							$new_height = ($new_width * $height) / $width ;

						} else{
							//FORMAT VERTICAL
							$new_height = $widthOrHeight;
							$new_width = ($new_height * $width) / $height ;
						}

						$thumb = imagecreatetruecolor($new_width, $new_height);

						if (imagecopyresampled($thumb, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height))
						echo "Resampled OK<br>";
						else
						echo "Resampled NOK<br>";

						imagepng($thumb, $url);
						chmod ($url,0777);
						imagedestroy($image);
					}

					else{
						die('Pirate !');
					}
				}
		}


	}


}
