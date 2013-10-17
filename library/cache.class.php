<?php
class Cache {

	public function get($fileName) {
		$fileName = '../tmp/cache/'.$fileName;
		if (file_exists($fileName)) {
			$handle = fopen($fileName, 'rb');
			$variable = fread($handle, filesize($fileName));
			fclose($handle);
			return unserialize($variable);
		} else {
			return null;
		}
	}
	
	public function set($fileName,$variable) {
		$fileName = '../tmp/cache/'.$fileName;
		$handle = fopen($fileName, 'a');
		fwrite($handle, serialize($variable));
		fclose($handle);
	}

}
